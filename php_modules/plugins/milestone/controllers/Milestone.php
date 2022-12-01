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

use SPT\MVC\JDIContainer\MVController;
use SPT\Middleware\Dispatcher as MW;

class Milestone extends Admin 
{
    public function detail()
    {
        $this->isLoggedIn();

        $urlVars = $this->request->get('urlVars');
        $id = (int) $urlVars['id'];

        $existUser = $this->UserEntity->findByPK($id);
        if(!empty($id) && !$existUser) 
        {
            $this->session->set('flashMsg', "Invalid user");
            $this->app->redirect(
                $this->router->url('admin/users')
            );
        }

        $this->app->set('layout', 'backend.user.form');
        $this->app->set('page', 'backend');
        $this->app->set('format', 'html');
    }

    public function list()
    {
        $this->isLoggedIn();
        $this->app->set('page', 'backend');
        $this->app->set('format', 'html');
        $this->app->set('layout', 'backend.milestone.list');
    }

    public function logout()
    {
        $this->user->logout();

        $this->session->set('flashMsg', 'Bye Bye');
        $this->app->redirect(
            $this->router->url('admin/login')
        );
    }

    public function add()
    {
        $this->isLoggedIn();
        $try = MW::fire('validation', ['ValidateUser'], []);
        if (!$try)
        {
            $msg = $this->session->get('validate', '');
            $this->session->set('flashMsg', $msg);
            $this->app->redirect(
                $this->router->url('admin/user/0')
            );
        }

        //check confirm password
        if($this->request->post->get('password', '') != $this->request->post->get('confirm_password', ''))
        {
            $this->session->set('flashMsg', 'Error: Confirm Password Failed');
            $this->app->redirect(
                $this->router->url('admin/user/0')
            );
        }

        // TODO: validate new add
        $newId =  $this->UserEntity->add([
            'name' => $this->request->post->get('name', '', 'string'),
            'username' => $this->request->post->get('username', '' , 'string'),
            'email' => $this->request->post->get('email', '' , 'string'),
            'password' => md5($this->request->post->get('password', '')),
            'status' => $this->request->post->get('status', '') == "" ? 0 : 1,
            'created_by' => $this->user->get('id'),
            'created_at' => date('Y-m-d H:i:s'),
            'modified_by' => $this->user->get('id'),
            'modified_at' => date('Y-m-d H:i:s')
        ]);

        if( !$newId )
        {
            $msg = 'Error: Save Failed';
            $this->session->set('flashMsg', $msg);
            $this->app->redirect(
                $this->router->url('admin/user/0')
            );
        }
        else
        {
            $this->session->set('flashMsg', 'Save Successfully');
            $this->app->redirect(
                $this->router->url('admin/users')
            );
        }
    }

    public function update()
    {
        $ids = $this->validateID(); 
       
        // TODO valid the request input

        if( is_array($ids) && $ids != null)
        {
            // publishment
            $count = 0; 
            $action = $this->request->post->get('published', '', 'string');
        
            if (in_array($this->user->get('id'), $ids) && $action == 'unactive')
            {
                $this->session->set('flashMsg', 'Error: You cannot unactivate your account');
                $this->app->redirect(
                    $this->router->url('admin/users') 
                );
            }

            foreach($ids as $id)
            {
                $toggle = $this->UserEntity->togglePublishment($id, $action);
                $count++;
            }
            $this->session->set('flashMsg', $count.' changed record(s)');
            $this->app->redirect(
                $this->router->url('admin/users')
            );
        }
        if(is_numeric($ids) && $ids)
        {

            $try = MW::fire('validation', ['ValidateUser'], []);
            if (!$try)
            {
                $msg = $this->session->get('validate', '');
                $this->session->set('flashMsg', $msg);
                $this->app->redirect(
                    $this->router->url('admin/user/'. $ids)
                );
            }

            $password = $this->request->post->get('password', '');
            $repassword = $this->request->post->get('confirm_password', '');
            if($password) {
                $user['password'] = $this->request->post->get('password', '');
            }
            if($password == $repassword) 
            {
                $user = [
                    'name' => $this->request->post->get('name', '', 'string'),
                    'username' => $this->request->post->get('username', '' , 'string'),
                    'email' => $this->request->post->get('email', '', 'string'),
                    'status' => $this->request->post->get('status', '') == "" ? 0 : 1,
                    'modified_by' => $this->user->get('id'),
                    'modified_at' => date('Y-m-d H:i:s'),
                    'id' => $ids,
                ];
            }
            else
            {
                $this->session->set('flashMsg', 'Error: Confirm Password Failed');
                $this->app->redirect(
                    $this->router->url('admin/user/'.$ids)
                );
            }

            $passwrd =  $this->request->post->get('password','');
            if($passwrd) $user['password'] = md5($passwrd);
            
            $try = $this->UserEntity->update( $user );

            if($try) 
            {
                $this->app->redirect(
                    $this->router->url('admin/users'), 'Edit Successfully'
                );
            }
            else
            {
                $msg = 'Error: Save Failed';
                $this->session->set('flashMsg', $msg);
                $this->app->redirect(
                    $this->router->url('admin/user/'. $ids)
                );
            }
        }
    }

    public function delete()
    {
        $userID = $this->validateID();
        
        $count = 0;
        if( is_array($userID))
        {
            foreach($userID as $id)
            {
                if( $id == $this->user->get('id') )
                {
                    $this->session->set('flashMsg', 'Error: You can\'t delete yourself.');
                    $this->app->redirect(
                        $this->router->url('admin/users'),
                    );
                }

                //Delete file in source
                if( $this->UserEntity->remove( $id ) )
                {
                    $count++;
                }
            }
        }
        elseif( is_numeric($userID) )
        {
            if( $userID === $this->user->get('id') )
            {
                $this->session->set('flashMsg', 'Error: You can\'t delete yourself.');
                $this->app->redirect(
                    $this->router->url()
                );
            }
            //Delete file in source
            if( $this->UserEntity->remove($userID ) )
            {
                $count++;
            }
        }  
        

        $this->session->set('flashMsg', $count.' deleted record(s)');
        $this->app->redirect(
            $this->router->url('admin/users'), 
        );
    }

    public function validateID()
    {
        $this->isLoggedIn();

        $urlVars = $this->request->get('urlVars');
        $id = (int) $urlVars['id'];

        if(empty($id))
        {
            $ids = $this->request->post->get('ids', [], 'array');
            if(count($ids)) return $ids;

            $this->session->set( 'Invalid user');
            $this->app->redirect(
                $this->router->url('admin/users'),
            );
        }

        return $id;
    }

}