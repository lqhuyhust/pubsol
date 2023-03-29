<?php
/**
 * SPT software - homeController
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a basic controller
 * 
 */

namespace App\plugins\milestone\controllers;

use SPT\Web\MVVM\ControllerContainer as Controller;
use SPT\Response;

class Version extends Admin 
{
    public function list()
    {
        $this->isLoggedIn();
        $this->validateVersion();
        $version_latest = $this->VersionEntity->list(0, 1, [], 'created_at desc');
        $version_latest = $version_latest ? $version_latest[0] : [];
        $urlVars = $this->request->get('urlVars');
        $request_id = (int) $urlVars['request_id'];
        $list = $this->VersionNoteEntity->list(0,0, ['version_id = '. $version_latest['id'], 'request_id = '. $request_id]);
        $list = $list ? $list : [];

        $this->app->set('format', 'json');
        $this->set('result', $list);
        return ;
    }

    public function add()
    {
        $this->isLoggedIn();
        $this->validateVersion();
        //check title sprint
        $request_id = $this->validateRequestID();

        $tmp_check = $this->checkVersion($request_id);
        if($tmp_check) {
            $this->app->set('format', 'json');
            $this->set('result', 'fail');
            $this->set('result', 'Add Version Failed!');
            return ;
        }

        $log = $this->request->post->get('log', '', 'string');
        $version_latest = $this->VersionEntity->list(0, 1, [], 'created_at desc');
        $version_latest = $version_latest ? $version_latest[0] : [];
        if( !$version_latest )
        {
            $this->app->set('format', 'json');
            $this->set('result', 'fail');
            $this->set('result', 'Error: Invalid Version!');
            return ;
        }
        // TODO: validate new add
        $newId =  $this->VersionNoteEntity->add([
            'version_id' => $version_latest['id'],
            'log' => $log,
            'request_id' => $request_id,
            'created_by' => $this->user->get('id'),
            'created_at' => date('Y-m-d H:i:s'),
            'modified_by' => $this->user->get('id'),
            'modified_at' => date('Y-m-d H:i:s')
        ]);

        if( !$newId )
        {
            $msg = 'Error: Create Change log Failed!';
            $this->app->set('format', 'json');
            $this->set('result', 'fail');
            $this->set('result', $msg);
            return ;
        }
        else
        {
            $this->app->set('format', 'json');
            $this->set('result', 'fail');
            $this->set('result', 'Create Change log Successfully!');
            return ;
        }
    }

    public function update()
    {
        $ids = $this->validateID(); 
        $request_id = $this->validateRequestID();

        $tmp_check = $this->checkVersion($request_id);
        if($tmp_check) {
            $this->app->set('format', 'json');
            $this->set('result', 'fail');
            $this->set('result', 'Update Version Failed!');
            return ;
        }
        // TODO valid the request input

        if( is_array($ids) && $ids != null)
        {
            $this->app->set('format', 'json');
            $this->set('result', 'fail');
            $this->set('result', 'Invalid Version Note');
            return ;
        }
        if(is_numeric($ids) && $ids)
        {
            $log = $this->request->post->get('log', '', 'string');

            $try = $this->VersionNoteEntity->update([
                'log' => $log,
                'modified_by' => $this->user->get('id'),
                'modified_at' => date('Y-m-d H:i:s'),
                'id' => $ids,
            ]);
            
            if($try) 
            {
                $this->app->set('format', 'json');
                $this->set('result', 'ok');
                $this->set('result', 'Update Change Log Successfully');
                return ;
            }
            else
            {
                $this->app->set('format', 'json');
                $this->set('result', 'fail');
                $this->set('result', 'Update Change Log Failed');
                return ;
            }
        }
    }

    public function delete()
    {
        $ids = $this->validateID();
        $request_id = $this->validateRequestID();

        $tmp_check = $this->checkVersion($request_id);
        if($tmp_check) {
            $this->app->set('format', 'json');
            $this->set('result', 'fail');
            $this->set('result', 'Delete Version Failed!');
            return ;
        }

        $count = 0;
        if( is_array($ids))
        {
            foreach($ids as $id)
            {
                //Delete file in source
                if( $this->VersionNoteEntity->remove( $id ) )
                {
                    $count++;
                }
            }
        }
        elseif( is_numeric($ids) )
        {
            if( $this->VersionNoteEntity->remove($ids ) )
            {
                $count++;
            }
        }  
        
        $this->app->set('format', 'json');
        $this->set('result', 'ok');
        $this->set('result', $count.' deleted record(s)');
        return ;
    }

    public function validateID()
    {
        $this->isLoggedIn();
        $this->validateVersion();
        $request_id = $this->validateRequestID();
        $urlVars = $this->request->get('urlVars');
        $id = (int) $urlVars['id'];

        if(empty($id))
        {
            $ids = $this->request->post->get('ids', [], 'array');
            if(count($ids)) return $ids;

            $this->session->set('flashMsg', 'Invalid Task');
            return Response::redirect(
                $this->router->url('detail-request/'. $request_id),
            );
        }

        return $id;
    }

    public function validateRequestID()
    {
        $this->isLoggedIn();

        $urlVars = $this->request->get('urlVars');
        $id = (int) $urlVars['request_id'];

        if(empty($id))
        {
            $this->session->set('flashMsg', 'Invalid Request');
            return Response::redirect(
                $this->router->url('milestones'),
            );
        }

        return $id;
    }

    public function validateVersion()
    {
        if (!$this->container->exists('VersionEntity'))
        {
            $this->session->set('flashMsg', 'Invalid Plugin Version');
            return Response::redirect(
                $this->router->url('admin')
            );
        }
    }

    public function checkVersion($request_id)
    {
        $version_lastest = $this->VersionEntity->list(0, 1, [], 'created_at desc');
        $version_lastest = $version_lastest ? $version_lastest[0]['version'] : '0.0.0';
        $tmp_request = $this->RequestEntity->list(0, 0, ['id = '.$request_id], 0);
        foreach($tmp_request as $item) {
        }
        if(strcmp($item['version_id'], '0') == 0) {
            return false;
        } elseif ($version_lastest > $item['version_id']) {
            return true;
        } else {
            return false;
        }
    }
}