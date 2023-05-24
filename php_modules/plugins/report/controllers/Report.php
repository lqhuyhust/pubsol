<?php
namespace App\plugins\report\controllers;

use SPT\Web\MVVM\ControllerContainer as Controller;

class Report extends Controller 
{
    public function list()
    {
        $this->app->set('page', 'backend');
        $this->app->set('format', 'html');
        $this->app->set('layout', 'backend.diagram.list');
    }

    public function update()
    {
        $id = $this->request->post->get('id', '', 'string');
        $find = $this->DiagramEntity->findByPK($id);
        if (!$find)
        {
            $this->session->set('flashMsg', 'Invalid Report');
            return $this->app->redirect(
                $this->router->url('reports'),
            );
        }

        $try = $this->DiagramEntity->update([
            'id' => $id,
            'status' => $find['status'] ? 0 : 1,
        ]);

        $msg = $try ? 'Update Successfull' : 'Update Fail';
       
        $this->session->set('flashMsg', $msg);
        return $this->app->redirect(
            $this->router->url('reports'),
        );
    }

    public function delete()
    {
        $ids = $this->validateID();
        $types = $this->ReportModel->getTypes();
        $count = 0;
        if( is_array($ids))
        {
            foreach($ids as $id)
            {
                //Delete file in source
                $find = $this->DiagramEntity->findByPK($id);
                if ($find)
                {
                    $type = isset($types[$find['report_type']]) ? $types[$find['report_type']] : [];
                }

                if (isset($type['remove_object']))
                {
                    $remove_object = $this->container->get($type['remove_object']);
                    
                }
                
                if (is_object($remove_object))
                {
                    if ($remove_object->remove($id))
                    {
                        $count++;
                    }
                }
                else
                {
                    if( $this->DiagramEntity->remove( $id ) )
                    {
                        $count++;
                    }
                }
            }
        }
        elseif( is_numeric($ids) )
        {
            $id = $ids;
            $find = $this->DiagramEntity->findByPK($id);
            if ($find)
            {
                $type = isset($types[$find['report_type']]) ? $types[$find['report_type']] : [];
            }

            if (isset($type['remove_object']))
            {
                $remove_object = $this->container->get($type['remove_object']);
                
            }
            if (is_object($remove_object))
            {
                if ($remove_object->remove($id))
                {
                    $count++;
                }
            }
            else
            {
                if( $this->DiagramEntity->remove( $id ) )
                {
                    $count++;
                }
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
        $id = $urlVars ? (int) $urlVars['id'] : [];

        if(empty($id))
        {
            $ids = $this->request->post->get('ids', [], 'array');
            if(count($ids)) return $ids;

            $this->session->set('flashMsg', 'Invalid Report');
            return $this->app->redirect(
                $this->router->url('reports'),
            );
        }

        return $id;
    }
}