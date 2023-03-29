<?php
/**
 * SPT software - homeController
 *
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a basic controller
 *
 */

namespace App\plugins\note\controllers;

use SPT\Web\MVVM\ControllerContainer as Controller;
use SPT\Response;

class Tag extends Admin {
    public function list()
    {
        $this->isLoggedIn();

        $name = $this->request->get->get('search', '', 'string');

        $where = [];

        if( !empty($name) )
        {
            $where[] = "(`name` LIKE '%".$name."%' )";
        }

        $data = $this->TagEntity->list(0,100, $where);
        $this->app->set('format', 'json');
        $this->set('status' , 'success');
        $this->set('data' , $data);
        $this->set('message' , '');
        return;
    }

    public function add()
    {
        $name = $this->request->post->get('name', '', 'string');

        if (empty($name)){

            $this->app->set('format', 'json');
            $this->set('status' , 'fail');
            $this->set('data' , '');
            $this->set('message' , 'Name invalid');
            return;
        }

        $findOne = $this->TagEntity->findOne(['name = "'. $name. '"']);
        if (!empty($findOne)){
            $this->app->set('format', 'json');
            $this->set('status' , 'fail');
            $this->set('data' , '');
            $this->set('message' , 'Error: Title is already in use!');
            return;
        }

        $newId =  $this->TagEntity->add([
            'name' => $name,
        ]);

        if ($newId){
            $this->app->set('format', 'json');
            $this->set('status' , 'success');
            $this->set('data' , ['id' => $newId, 'name' => $name]);
            $this->set('message' , 'Create Tag sucess');
            return;
        } else {
            $this->app->set('format', 'json');
            $this->set('status' , 'fail');
            $this->set('data' , '');
            $this->set('message' , 'Error: Create Tag fail!');
            return; 
        }
    }
}