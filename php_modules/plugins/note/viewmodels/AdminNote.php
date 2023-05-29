<?php

/**
 * SPT software - ViewModel
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: A simple View Model
 * 
 */

namespace App\plugins\note\viewmodels;

use SPT\View\VM\JDIContainer\ViewModel;
use SPT\View\Gui\Form;

class AdminNote extends ViewModel
{
    public static function register()
    {
        return [
            'layouts.backend.note.form',
            'layouts.backend.note.preview',
        ];
    }
    
    public function form()
    {
        $request = $this->container->get('request');
        $NoteEntity = $this->container->get('NoteEntity');
        $NoteHistoryEntity = $this->container->get('NoteHistoryEntity');
        $UserEntity = $this->container->get('UserEntity');
        $TagEntity = $this->container->get('TagEntity');
        $NoteModel = $this->container->get('NoteModel');
        $AttachmentEntity = $this->container->get('AttachmentEntity');
        $router = $this->container->get('router');
        $type = $this->request->get->get('type', 'html');
        $permission = $this->container->exists('PermissionModel') ? $this->container->get('PermissionModel') : null;

        $urlVars = $request->get('urlVars');
        $id = (int) $urlVars['id'];
        $version = $request->get->get('version', 0);

        $data = $id ? $NoteEntity->findByPK($id) : [];
        $data_version = [];
        if ($data)
        {
            $data['description'] = $NoteModel->replaceContent($data['description'], false);
            if ($version)
            {
                $data_version = $NoteHistoryEntity->findByPK($version);
                if ($data_version)
                {
                    $user_tmp = $UserEntity->findByPK($data_version['created_by']);
                    $data_version['created_by'] = $user_tmp ? $user_tmp['name'] : '';
                    $data = json_decode($data_version['meta_data'], true);
                    $data['id'] = $id;
                    $data['title'] = $data['title'] . ' - '. $data_version['created_at']. ' - by '. $data_version['created_by'];
                }
            }

            $data['description_sheetjs'] = base64_encode(strip_tags($data['description']));
            $versions = $NoteHistoryEntity->list(0, 0, ['note_id' => $data['id']], 'id desc');
            $versions = $versions ? $versions : [];

            foreach($versions as &$item)
            {
                $user_tmp = $UserEntity->findByPK($item['created_by']);
                $item['created_by'] = $user_tmp ? $user_tmp['name'] : '';
            }

            $data['versions'] = $versions;
            $data['type'] = !$data['type'] ? 'html' : $data['type'];
        }
        
        $data_tags = [];
        if (!empty($data['tags'])){
            $where[] = "(`id` IN (".$data['tags'].") )";
            $data_tags = $TagEntity->list(0, 1000, $where);
        }
        $attachments = $AttachmentEntity->list(0, 0, ['note_id = '. $id]);
        
        if ($data && $data['type'] == 'presenter')
        {
            $data['description_presenter'] = $data['description'];
        }

        $allow_tag = $permission ? $permission->checkPermission(['tag_manager', 'tag_create']) : true;

        $allow_type = ['html', 'sheetjs', 'presenter'];
        $type = in_array($type, $allow_type) ? $type : 'html';

        $type = $data ? $data['type'] : $type;

        $form = new Form($this->getFormFields(), $data);
        return [
            'id' => $id,
            'form' => $form,
            'data' => $data,
            'type' => $type,
            'data_tags' => $data_tags,
            'allow_tag' => $allow_tag ? 'true' : 'false',
            'data_version' => $data_version,
            'version' => $version,
            'attachments' => $attachments,
            'title_page_edit' => $data && $data['title'] ? $data['title'] : 'New Note',
            'url' => $router->url(),
            'link_list' => $data_version ? $router->url('note/'. $id) : $router->url('notes'),
            'link_form' => $router->url('note'),
            'link_preview' => $id ? $router->url('note/preview/'. $id) : '',
            'link_form_attachment' => $router->url('attachment'),
            'link_form_download_attachment' => $router->url('download/attachment'),
            'link_tag' => $router->url('tag/search'),
        ];
        
    }

    public function preview()
    {
        $request = $this->container->get('request');
        $NoteEntity = $this->container->get('NoteEntity');
        $NoteHistoryEntity = $this->container->get('NoteHistoryEntity');
        $UserEntity = $this->container->get('UserEntity');
        $TagEntity = $this->container->get('TagEntity');
        $NoteModel = $this->container->get('NoteModel');
        $AttachmentEntity = $this->container->get('AttachmentEntity');
        $router = $this->container->get('router');

        $urlVars = $request->get('urlVars');
        $id = (int) $urlVars['id'];
        $version = $request->get->get('version', 0);

        $data = $id ? $NoteEntity->findByPK($id) : [];
        $data_version = [];
        if ($data)
        {
            $data['description'] = $NoteModel->replaceContent($data['description'], false);
            if ($version)
            {
                $data_version = $NoteHistoryEntity->findByPK($version);
                if ($data_version)
                {
                    $user_tmp = $UserEntity->findByPK($data_version['created_by']);
                    $data_version['created_by'] = $user_tmp ? $user_tmp['name'] : '';
                    $data = json_decode($data_version['meta_data'], true);
                    $data['id'] = $id;
                    $data['title'] = $data['title'] . ' - '. $data_version['created_at']. ' - by '. $data_version['created_by'];
                }
            }

            $data['description_sheetjs'] = base64_encode(strip_tags($data['description']));
            $versions = $NoteHistoryEntity->list(0, 0, ['note_id' => $data['id']], 'id desc');
            $versions = $versions ? $versions : [];

            foreach($versions as &$item)
            {
                $user_tmp = $UserEntity->findByPK($item['created_by']);
                $item['created_by'] = $user_tmp ? $user_tmp['name'] : '';
            }

            $data['versions'] = $versions;
            $data['type'] = !$data['type'] ? 'html' : $data['type'];

            $tag_tmp = $data['tags'] ? explode(',', $data['tags']) : [];
            $data['tags'] = [];
            foreach($tag_tmp as $tag)
            {
                $tmp = $TagEntity->findByPK($tag);
                if ($tmp)
                {
                    $data['tags'][] = $tmp['name'];
                }
            }
            $data['tags'] = implode(', ', $data['tags']);
        }
        
        $data_tags = [];
        if (!empty($data['tags'])){
            $where[] = "(`id` IN (".$data['tags'].") )";
            $data_tags = $TagEntity->list(0, 1000, $where);
        }
        $attachments = $AttachmentEntity->list(0, 0, ['note_id = '. $id]);
        
        if ($data && $data['type'] == 'presenter')
        {
            $data['description_presenter'] = $data['description'];
        }

        $form = new Form($this->getFormFields(), $data);
        $view_mode = $data ? 'true' : '';
        $title_page = $data['title'];
        $button_header = '<a href="'. $router->url('notes').'" class="btn btn-outline-secondary">
                            Cancel
                        </a>
                        <a href="'. $router->url('note/'. $id).'" class="btn ms-2 btn-outline-success">
                            Edit
                        </a>';

        return [
            'id' => $id,
            'form' => $form,
            'data' => $data,
            'button_header' => $button_header,
            'view_mode' => $view_mode,
            'data_tags' => $data_tags,
            'data_version' => $data_version,
            'version' => $version,
            'attachments' => $attachments,
            'title_page' => $title_page,
            'url' => $router->url(),
            'link_list' => $data_version ? $router->url('note/'. $id) : $router->url('notes'),
            'link_form' => $router->url('note'),
            'link_form_attachment' => $router->url('attachment'),
            'link_form_download_attachment' => $router->url('download/attachment'),
            'link_tag' => $router->url('tag/search'),
        ];
        
    }

    public function getFormFields()
    {
        $fields = [
            'description' => [
                'tinymce',
                'showLabel' => false,
                'formClass' => 'd-none',
            ],
            'description_sheetjs' => [
                'sheetjs',
                'showLabel' => false,
                'formClass' => 'field-sheetjs',
            ],
            'description_presenter' => [
                'presenter',
                'showLabel' => false,
                'formClass' => 'field-presenter',
            ],
            'note' => [
                'textarea',
                'showLabel' => false,
                'placeholder' => 'Notice',
                'formClass' => 'form-control',
            ],
            'file' => [
                'file',
                'showLabel' => false,
                'formClass' => 'form-control',
            ],
            'title' => [
                'text',
                'showLabel' => false,
                'placeholder' => 'New Title',
                'formClass' => 'form-control border-0 border-bottom fs-2 py-0',
                'required' => 'required',
            ],
            'tags' => [
                'text',
                'showLabel' => false,
                'placeholder' => 'Tags',
                'formClass' => 'form-control',
            ],
            'token' => ['hidden',
                'default' => $this->container->get('token')->value(),
            ],
        ];

        return $fields;
    }
}
