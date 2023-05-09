<?php
/**
 * SPT software - Model
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a basic model
 * 
 */

namespace App\plugins\calendar\models;

use SPT\JDIContainer\Base; 

class CalendarModel extends Base
{ 
    // Write your code here
    public function getWeek($date, $format = 'Y-m-d')
    {
        $the_day_of_week = date("w",strtotime($date)); //sunday is 0
        $first_day_of_week = date($format,strtotime( $date )-60*60*24*($the_day_of_week) );
        $array = [];
        for ($i=0; $i <= 6 ; $i++) { 
                $array[] = date($format,strtotime($first_day_of_week)+60*60*24*$i );
        }

        return $array;
    }
}
