<?php
/**
 * SPT software - ViewModel
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: A simple View Model
 * 
 */

namespace App\plugins\facts4me\viewmodels; 

use SPT\View\VM\JDIContainer\ViewModel; 
use SPT\View\Gui\Form;

class AdminEmailVM extends ViewModel
{
    protected $alias = 'AdminEmailVM';
    protected $layouts = [
        'layouts.backend.email' => [
            'form'
        ]
    ];

    public function form()
    {
        $urlVars = $this->request->get('urlVars');
        $id = (int) $urlVars['id'];
        $this->set('id', $id, true);

        $data = $id ? $this->EmailTmpEntity->findByPK($id) : [];

        $short_code = [
            '%disp_date%' => 'Payment date',
            '%gift_name%' => 'Gift name',
            '%to_name%' => 'To name',
            '%u_f_name%' => 'User First Name',
            '%u_l_name%' => 'User Last Name',
            '%userid%' => 'Username',
            '%nuserid%' => 'New username',
            '%school_name%' => 'School Name',
            '%expire_date%' => 'Expired date',
            '%c_email%' => 'Email in contact form',
            '%c_name%' => 'Name in contact form',
            '%c_addr1%' => 'Address 1 in contact form',
            '%c_addr2%' => 'Address 2 in contact form',
            '%c_city%' => 'City in contact form',
            '%c_state%' => 'State/Province in contact form',
            '%c_zip%' => 'Postal Code in contact form',
            '%c_how%' => '"How did youfind our site?" in contact form',
            '%c_cont_notes%' => 'Messsage contact (tell friend) in contact (tell friend) form',
        ];

        $form = new Form($this->getFormFields(), $data);

        $title_page = $id ? 'Update Email Template' : 'New Email Template';
        $this->view->set('short_code', $short_code, true);
        $this->view->set('form', $form, true);
        $this->view->set('title_page', $title_page, true);
        $this->view->set('data', $data, true);
        $this->view->set('url', $this->router->url(), true);
        $this->view->set('link_list', $this->router->url('admin/email_tmps'));
        $this->view->set('link_form', $this->router->url('admin/email_tmp'));
    }

    public function getFormFields()
    {
        $fields = [
            'id' => ['hidden'],
            'e_name' => [
                'text',
                'placeholder' => 'Enter...',
                'showLabel' => false,
                'formClass' => 'form-control',
                'required' => 'required'
            ],
            'e_sub' => [
                'text',
                'placeholder' => 'Enter...',
                'showLabel' => false,
                'formClass' => 'form-control',
                'required' => 'required'
            ],
            'e_tmp' => [
                'tinymce',
                'showLabel' => false,
                'formClass' => 'form-control',
            ],
            'token' => ['hidden',
                'default' => $this->app->getToken(),
            ],
        ];

        return $fields;
    }
}