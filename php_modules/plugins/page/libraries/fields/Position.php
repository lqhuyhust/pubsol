<?php
/**
 * SPT software - Gui Field
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Easily display data object property
 * 
 */

namespace App\plugins\page\libraries\fields;

class Position extends \SPT\Web\Gui\FieldType\Input
{
    public $hub;
    public $data;

    public function __construct( $id, $params )
    {
        parent::__construct( $id, $params );

        $this->hub = isset( $params['hub']) ? $params['hub'] : ''; 
        $this->data = isset( $params['data']) ? $params['data'] : ''; 
    }
}