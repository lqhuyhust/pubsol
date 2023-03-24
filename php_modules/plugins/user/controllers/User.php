<?php
/**
 * SPT software - homeController
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a basic controller
 * 
 */

namespace App\plugins\user\controllers;

class User extends Admin 
{
    public function gate()
    {
        if( $this->user->get('id') )
        {
            return $this->response->redirect(
                $this->app->url('users')
            );
        }
        $this->app->set('format', 'html');
        $this->app->set('layout', 'backend.user.login');
        $this->app->set('page', 'backend-full');
    }

    public function login()
    {
        $result = $this->user->login(
            $this->request->post->get('username', '', 'string'),
            $this->request->post->get('password', '', 'string')
        );

        if ( $result )
        {
            if($result['status'] != 1) 
            {
                $this->session->set('flashMsg', 'Error: User has been block');
                $this->user->logout();
                return $this->response->redirect(
                    $this->app->url('login')
                );
            }
            else
            {
                $this->session->set('flashMsg', 'Hello!!!');
                $redirect_after_login = $this->config->exists('redirect_after_login') ? $this->config->redirect_after_login : ''; 
                return $this->response->redirect(
                    $this->app->url($redirect_after_login)
                );
            }
        }
        else
        {
            $this->session->set('flashMsg', 'Username and Password invalid.');
            return $this->response->redirect(
                $this->app->url('login')
            );
        }
    }

    public function detail()
    {
        $this->isLoggedIn();

        $urlVars = $this->request->get('urlVars');
        $id = (int) $urlVars['id'];

        $existUser = $this->UserEntity->findByPK($id);
        if(!empty($id) && !$existUser) 
        {
            $this->session->set('flashMsg', "Invalid user");
            return $this->response->redirect(
                $this->app->url('users')
            );
        }

        $this->app->set('layout', 'backend.user.form');
        $this->app->set('page', 'backend');
        $this->app->set('format', 'html');
    }

    public function profile()
    {
        $this->isLoggedIn();

        $this->app->set('layout', 'backend.user.profile');
        $this->app->set('page', 'backend');
        $this->app->set('format', 'html');
    }

    public function saveProfile()
    {
        $this->isLoggedIn();
        $id = $this->user->get('id'); 
        $save_close = $this->request->post->get('save_close', '', 'string');
       
        // TODO valid the request input
        $try = $this->UserModel->validate($id);
        if (!$try)
        {
            $msg = $this->session->get('validate', '');
            $this->session->set('flashMsg', $msg);
            return $this->response->redirect(
                $this->app->url('profile')
            );
        }

        $password = $this->request->post->get('password', '');
        $repassword = $this->request->post->get('confirm_password', '');
        
        if($password == $repassword) 
        {
            $user = [
                'name' => $this->request->post->get('name', '', 'string'),
                'username' => $this->request->post->get('username', '' , 'string'),
                'email' => $this->request->post->get('email', '', 'string'),
                'modified_by' => $this->user->get('id'),
                'modified_at' => date('Y-m-d H:i:s'),
                'id' => $id,
            ];
        }
        else
        {
            $this->session->set('flashMsg', 'Error: Confirm Password Invalid');
            return $this->response->redirect(
                $this->app->url('user/'.$id)
            );
        }

        if($password) $user['password'] = md5($passwrd);
        
        $try = $this->UserEntity->update( $user );

        if($try) 
        {
            $this->session->set('flashMsg', 'Updated Successfully');
            $link = $save_close ? '' : 'profile';
            return $this->response->redirect(
                $this->app->url($link)
            );
        }
        else
        {
            $msg = 'Error: Updated Fail';
            $this->session->set('flashMsg', $msg);
            return $this->response->redirect(
                $this->app->url('profile')
            );
        }
    }

    public function list()
    {
        $this->isLoggedIn();
        $this->app->set('page', 'backend');
        $this->app->set('format', 'html');
        $this->app->set('layout', 'backend.user.list');
    }

    public function logout()
    {
        $this->user->logout();

        $this->session->set('flashMsg', 'Bye Bye');
        return $this->response->redirect(
            $this->app->url('login')
        );
    }

    public function add()
    {
        $this->isLoggedIn();
        $save_close = $this->request->post->get('save_close', '', 'string');
        $try = MW::fire('validation', ['ValidateUser'], []);
        if (!$try)
        {
            $msg = $this->session->get('validate', '');
            $this->session->set('flashMsg', $msg);
            return $this->response->redirect(
                $this->app->url('user/0')
            );
        }

        //check confirm password
        if($this->request->post->get('password', '') != $this->request->post->get('confirm_password', ''))
        {
            $this->session->set('flashMsg', 'Error: Confirm Password Invalid');
            return $this->response->redirect(
                $this->app->url('user/0')
            );
        }

        // TODO: validate new add
        $newId =  $this->UserEntity->add([
            'name' => $this->request->post->get('name', '', 'string'),
            'username' => $this->request->post->get('username', '' , 'string'),
            'email' => $this->request->post->get('email', '' , 'string'),
            'password' => md5($this->request->post->get('password', '')),
            'status' => $this->request->post->get('status', 0),
            'created_by' => $this->user->get('id'),
            'created_at' => date('Y-m-d H:i:s'),
            'modified_by' => $this->user->get('id'),
            'modified_at' => date('Y-m-d H:i:s')
        ]);

        if( !$newId )
        {
            $msg = 'Error: Created Fail';
            $this->session->set('flashMsg', $msg);
            return $this->response->redirect(
                $this->app->url('user/0')
            );
        }
        else
        {
            $this->UserGroupModel->addUserMap($newId);
            $this->session->set('flashMsg', 'Created Successfully');
            $link = $save_close ? 'users' : 'user/'. $newId;
            return $this->response->redirect(
                $this->app->url($link)
            );
        }
    }

    public function update()
    {
        $ids = $this->validateID(); 
        $save_close = $this->request->post->get('save_close', '', 'string');
       
        // TODO valid the request input
        $groups = $this->request->post->get('groups', [], 'array');
        $access = $this->UserModel->getAccessByGroup($groups);

        if(is_numeric($ids) && $ids)
        {
            if ($ids == $this->user->get('id') && (!in_array('user_manager', $access) || !in_array('usergroup_manager', $access)))
            {
                $this->session->set('flashMsg', 'Error: You can\'t delete your access group');
                return $this->response->redirect(
                    $this->app->url('user/'. $ids)
                );
            }

            $try = MW::fire('validation', ['ValidateUser'], []);
            if (!$try)
            {
                $msg = $this->session->get('validate', '');
                $this->session->set('flashMsg', $msg);
                return $this->response->redirect(
                    $this->app->url('user/'. $ids)
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
                    'status' => $this->request->post->get('status', 0),
                    'modified_by' => $this->user->get('id'),
                    'modified_at' => date('Y-m-d H:i:s'),
                    'id' => $ids,
                ];
            }
            else
            {
                $this->session->set('flashMsg', 'Error: Confirm Password Invalid');
                return $this->response->redirect(
                    $this->app->url('user/'.$ids)
                );
            }

            $passwrd =  $this->request->post->get('password','');
            if($passwrd) $user['password'] = md5($passwrd);
            
            $try = $this->UserEntity->update( $user );

            if($try) 
            {
                $this->UserGroupModel->updateUserMap($user);
                $this->session->set('flashMsg', 'Updated Successfully');
                $link = $save_close ? 'users' : 'user/'. $ids;
                return $this->response->redirect(
                    $this->app->url($link)
                );
            }
            else
            {
                $msg = 'Error: Save Failed';
                $this->session->set('flashMsg', $msg);
                return $this->response->redirect(
                    $this->app->url('user/'. $ids)
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
                    return $this->response->redirect(
                        $this->app->url('users'),
                    );
                }

                //Delete file in source
                if( $this->UserEntity->remove( $id ) )
                {
                    $this->UserGroupModel->removeByUser($id);
                    $count++;
                }
            }
        }
        elseif( is_numeric($userID) )
        {
            if( $userID === $this->user->get('id') )
            {
                $this->session->set('flashMsg', 'Error: You can\'t delete yourself.');
                return $this->response->redirect(
                    $this->app->url()
                );
            }
            //Delete file in source
            if( $this->UserEntity->remove($userID ) )
            {
                $this->UserGroupModel->removeByUser($userID);
                $count++;
            }
        }  
        

        $this->session->set('flashMsg', $count.' deleted record(s)');
        return $this->response->redirect(
            $this->app->url('users'), 
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

            $this->session->set('flashMsg', 'Invalid user');
            return $this->response->redirect(
                $this->app->url('users'),
            );
        }

        return $id;
    }

}