<?php
/**
 * SPT software - homeController
 *
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a basic controller
 *
 */

namespace App\plugins\report_timeline\controllers;

use DTM\report\libraries\ReportController;
use SPT\Web\ControllerMVVM;

class report extends ReportController 
{
    public function detail()
    {
        $this->app->set('layout', 'backend.report.form');
        $this->app->set('page', 'backend');
        $this->app->set('format', 'html');
    }

    public function preview()
    {
        $this->app->set('layout', 'backend.report.preview');
        $this->app->set('page', 'backend');
        $this->app->set('format', 'html');
    }

    public function add()
    {
        //check title sprint
        $save_close = $this->request->post->get('save_close', '', 'string');
        if (!$title)
        {
            $this->session->set('flashMsg', 'Error: Title is required! ');
            return $this->app->redirect(
                $this->router->url('new-report/timeline')
            );
        }

        $data = [
            'title' => $title,
            'status' => 1,
            'milestones' => implode(',', $milestone),
            'tags' => implode(',', $tags),
        ];
        
        $try = $this->TimelineModel->add($data);
        
        if( !$newId )
        {
            $this->session->set('flashMsg', $this->TimelineModel);
            return $this->app->redirect(
                $this->router->url('new-report/timeline')
            );
        }
        else
        {
            // save struct
            $this->session->set('flashMsg', 'Created Successfully!');
            $link = $save_close ? 'reports' : 'timeline-diagram/'. $newId;
            return $this->app->redirect(
                $this->router->url($link)
            );
        }
    }

    public function update()
    {
        $ids = $this->validateID();

        // TODO valid the request input

        if(is_numeric($ids) && $ids)
        {
            $title = $this->request->post->get('title', '', 'string');
            $milestone = $this->request->post->get('milestone', [], 'array');
            $tags = $this->request->post->get('tags', [], 'array');
            $save_close = $this->request->post->get('save_close', '', 'string');

            if (!$title)
            {
                $this->session->set('flashMsg', 'Error: Title is required! ');
                return $this->app->redirect(
                    $this->router->url('timeline-diagram/0')
                );
            }

            $config = [
                'milestones' => implode(',', $milestone),
                'tags' => implode(',', $tags),
            ];
            $try = $this->DiagramEntity->update([
                'title' => $title,
                'config' => json_encode($config),
                'modified_by' => $this->user->get('id'),
                'modified_at' => date('Y-m-d H:i:s'),
                'id' => $ids,
            ]);
            
            if($try)
            {
                $this->session->set('flashMsg', 'Updated successfully');
                $link = $save_close ? 'reports' : 'timeline-diagram/'. $ids;
                return $this->app->redirect(
                    $this->router->url($link)
                );
            }
            else
            {
                $msg = 'Error: Updated failed';
                $this->session->set('flashMsg', $msg);
                return $this->app->redirect(
                    $this->router->url('timeline-diagram/'. $ids)
                );
            }
        }
    }

    public function delete()
    {
        $ids = $this->validateID();

        $count = 0;
        if( is_array($ids))
        {
            foreach($ids as $id)
            {
                //Delete file in source
                if( $this->DiagramEntity->remove( $id ) )
                {
                    $count++;
                }
            }
        }
        elseif( is_numeric($ids) )
        {
            if( $this->DiagramEntity->remove($ids ) )
            {
                $count++;
            }
        }


        $this->session->set('flashMsg', $count.' deleted record(s)');
        return $this->app->redirect(
            $this->router->url('reports'),
        );
    }

    public function validateID()
    {
        

        $urlVars = $this->request->get('urlVars');
        $id = (int) $urlVars['id'];

        if(empty($id))
        {
            $ids = $this->request->post->get('ids', [], 'array');
            if(count($ids)) return $ids;

            $this->session->set('flashMsg', 'Invalid timeline diagram');
            return $this->app->redirect(
                $this->router->url('reports'),
            );
        }

        return $id;
    }
}
