<?php
/**
 * SPT software - frontend controller
 *
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: a controller for a page
 *
 */

namespace App\plugins\page_contact\controllers;

use SPT\Web\ControllerMVVM;

class front extends ControllerMVVM
{
    public function display()
    {
        $this->app->set('layout', 'contact');
    }

    public function submit()
    {
        $page = $this->PageEntity->findOne(['page_type' => 'contact']);
        $link = $page ? $page['slug'] : '';

        $data = [
            'title' => $this->request->post->get('title', '', 'string'),
            'slug' => $this->request->post->get('slug', '', 'string'),
            'data' => $this->request->post->get('data', '', 'string'),
            'template_id' => $this->request->post->get('template_id', '', 'string'),
        ];

        $try = $this->PageContactModel->send($data);
        
        if (!$try)
        {
            $this->session->set('flashMsg', 'Error: '. $this->PageContactModel->getError());
        }
        else{
            $this->session->set('flashMsg', 'Thank you for contacting us');
        }

        return $this->app->redirect(
            $this->router->url($link)
        );
    }
}