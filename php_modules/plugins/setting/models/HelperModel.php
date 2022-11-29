<?php
/**
 * SPT software - Model
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a basic model
 * 
 */

namespace App\plugins\facts4me\models;

use SPT\JDIContainer\Base; 

class HelperModel extends Base 
{ 
    // Write your code here
    public function bld_psw ()
    {
        $psw_lst[0] = "xxx";
        $psw_lst[1] = "ant";
        $psw_lst[2] = "bat";
        $psw_lst[3] = "bee";
        $psw_lst[4] = "boa";
        $psw_lst[5] = "cat";
        $psw_lst[6] = "cow";
        $psw_lst[7] = "doe";
        $psw_lst[8] = "eel";
        $psw_lst[9] = "elk";
        $psw_lst[10] = "emu";
        $psw_lst[11] = "fox";
        $psw_lst[12] = "hen";
        $psw_lst[13] = "owl";
        $psw_lst[15] = "pig";
        $psw_lst[15] = "ram";
        $psw_lst[16] = "rat";
        $psw_lst[17] = "yak";
        $psw_lst[18] = "zoo";
        $psw_lst[19] = "bear";
        $psw_lst[20] = "bird";
        $psw_lst[21] = "bull";
        $psw_lst[22] = "calf";
        $psw_lst[23] = "crow";
        $psw_lst[24] = "deer";
        $psw_lst[25] = "duck";
        $psw_lst[26] = "fawn";
        $psw_lst[27] = "fish";
        $psw_lst[28] = "frog";
        $psw_lst[29] = "gull";
        $psw_lst[30] = "hawk";
        $psw_lst[31] = "lamb";
        $psw_lst[32] = "lark";
        $psw_lst[33] = "lion";
        $psw_lst[34] = "loon";
        $psw_lst[35] = "lynx";
        $psw_lst[36] = "mice";
        $psw_lst[37] = "mink";
        $psw_lst[38] = "moth";
        $psw_lst[39] = "pony";
        $psw_lst[40] = "seal";
        $psw_lst[41] = "swan";
        $psw_lst[42] = "toad";
        $psw_lst[43] = "wolf";
        $psw_lst[44] = "camel";
        $psw_lst[45] = "eagle";
        $psw_lst[46] = "goose";
        $psw_lst[47] = "horse";
        $psw_lst[48] = "koala";
        $psw_lst[59] = "llama";
        $psw_lst[50] = "moose";
        $psw_lst[51] = "mouse";
        $psw_lst[52] = "otter";
        $psw_lst[53] = "panda";
        $psw_lst[54] = "rhino";
        $psw_lst[55] = "robin";
        $psw_lst[56] = "shark";
        $psw_lst[57] = "tiger";
        $psw_lst[58] = "viper";
        $psw_lst[59] = "whale";
        $psw_lst[60] = "zebra";
        $psw_lst[61] = "zzzz";

        $ran_1 = mt_rand(1,60);
        $time1 = date('S');
        if ($ran_1 > 60 || $ran_1  < 1)
            {
                $ran_1 = 18;
            }
        $psw = $psw_lst[$ran_1] . $time1;
        
        return $psw;
    }

    public function time_zone_list()
    {
        $tz_list = array("EST~Eastern Standard Time US & Canada~-5");
        $tz_list[] = "CST~Central Standard Time US & Canada~-6";
        $tz_list[] = "MST~Mountain Standard Time US & Canada~-7";
        $tz_list[] = "PST~Pacific Standard Time US & Canada~-8";
        $tz_list[] = "AKST~Alaska Standard Time~-9";
        $tz_list[] = "HAST~Hawaii - Aleutian Standard Time~-10";
        $tz_list[] = "AST~Atlantic Standard Time~-4";
        //
        $tz_list[] = "NZST~New Zealand Standard Time~12";
        $tz_list[] = "AEST~Australian Eastern Standard Time~10";
        $tz_list[] = "ACWST~Australian Central Western Standard Time~8.75";
        $tz_list[] = "WST~Western Australia Standard Time~8";
        $tz_list[] = "EET~Eastern Europe Time~2";
        $tz_list[] = "CET~Central Europe Time~1";
        $tz_list[] = "GMT~Greenwich Meantime~0";
        $tz_list[] = "IST~Ireland Standard Time~0";
        $tz_list[] = "WET~Western Europe Time~0";
        $tz_list[] = "EGT~Eastern Greenland Time~-1";
        $tz_list[] = "CGT~Central Greenland Time~-3";
        $tz_list[] = "NST~Newfoundland Standard Time~-3.5";
        return $tz_list;
    }

    public function format_date($date_in)
    {
        //  split date on dash
        //	$temp = split('[-]', $date_in);
        $temp = explode('-', $date_in);
        $yy = $temp[0];
        $mm = $temp[1];
        $dd = $temp[2];
        $disp_date = "$mm/$dd/$yy";
        //	echo "*$date_in*$disp_date* mm: *$mm* dd: *$dd* yy: *$yy*";
        return $disp_date;
    }

    public function format_time($time_in)
    {
        //  split date on :
        //	$temp = split('[:]', $time_in);
        $temp = explode(':', $time_in);
        $hh = $temp[0];
        $mm = $temp[1];
        $ss = $temp[2];
        if ($hh >= 12)
        {
            $hh -= 12;
            if ($hh == "00")
            {
                $hh = "12";
            }
            $disp_time = "$hh:$mm PM";
        }
        else
        {
            if ($hh == "00")
            {
            }
            $disp_time = "$hh:$mm AM";
        }

        return $disp_time;
    }  
    public function edit_time($time_in)
    {
        $time_out = "ERROR";
        $err_flag = "N";

        // split time on ":" and " "
        //	$temp = split('[: ]', $time_in);
        $temp1 = explode(':', $time_in);
        $hh = $temp1[0];
        $temp = explode(' ', $temp1[1]);
        $mm = $temp[0];
        $am_pm = strtoupper($temp[1]);
        //  echo "0 time_out:*$time_out* hh:*$hh*" . strlen($hh) ."*  mm:*$mm*" .strlen($mm) . "*  am_pm:*$am_pm*  time in:*$time_in*\n";
        //  echo "0 temp 0:*$temp[0]*  temp 1:*$temp[1]*  temp 2:*$temp[2]*  temp 3:*$temp[3]*\n";
        if ($am_pm == "PM")
        {
            if ($hh == "12")
            {
                //$t_hh = $hh + 100;
                $t_hh = $hh + 112;
            }
            elseif ($hh < 12)
            {
                $t_hh = $hh + 112;
            }
            else
            {
                $err_flag = "Y";
            }
                $hh = substr($t_hh, 1);
        }
        elseif ($am_pm == "AM")
        {
            if ($hh == "12")
            {
                $t_hh = 100;
            }
            elseif ($hh > "11")
            {
                $err_flag = "Y";
            }
            else
            {
                $t_hh = $hh + 100;
            }
            $hh = substr($t_hh, 1);
        }
        else
        {
            $err_flag = "Y";
        }
        $t_mm = $mm + 100;
        $mm = substr($t_mm, 1);
        if ($err_flag == "N")
        {
            $time_out = "$hh:$mm:00";
        }
        return $time_out;
    }

    function validateDate($date, $format = 'Y-m-d H:i:s')
    {
        $d = \DateTime::createFromFormat($format, $date);
        if ($date == '24:00:00' && $d->format($format) == '00:00:00') return true;
        if ($date == '0000-00-00' && $format == 'Y-m-d') return true;
        return $d && $d->format($format) == $date;
    }

    public function edit_date($date_in)
    {
        $date_out = "ERROR";
        $err_flag = "N";

        // split date on slashes
        //	$temp = split('[/]', $date_in);
        $temp = explode('/', $date_in);
        $mm = $temp[0];
        $dd = $temp[1];
        $yy = $temp[2];
        // echo "0 date_out:*$date_out* mm:*$mm*" . strlen($mm) ."*  dd:*$dd*" .strlen($dd) . "*  yy:*$yy*  date in:*$date_in*\n";
        if (strlen($mm) > 2)   //  assume date in yyyy-mm-dd format
        {
            //  split date on dash
            //	$temp = split('[-]', $date_in);
            $temp = explode('-', $date_in);
            $yy = $temp[0];
            $mm = $temp[1];
            $dd = $temp[2];
            if (strlen($mm) > 2)
            {
                $err_flag = "Y";
            }
            if (strlen($dd) > 2)
            {
                $err_flag = "Y";
            }
        // echo "1a date_out:*$date_out* mm:*$mm*" . strlen($mm) ."*  dd:*$dd*" .strlen($dd) . "*  yy:*$yy*  date in:*$date_in*\n";
        }
        if (strlen($yy) == 4)   //  adjust yeare value
        {
            $year = $yy;
        }
        else
        {
            if (strlen($yy) == 0)
            {
                $year = date('Y');
            }
            elseif (strlen($yy) == 1)
            {
                $year = $yy +2000;
            }
            elseif (strlen($yy) == 2)
            {
                $year = $yy +2000;
            }
            elseif (strlen($yy) == 3)
            {
                $err_flag = "Y";
            }
        // echo "1b date_out:*$date_out* mm:*$mm*" . strlen($mm) ."*  dd:*$dd*" .strlen($dd) . "*  yy:*$yy*  date in:*$date_in*\n";
        }
        if (strlen($mm) == 0)
        {
            $err_flag = "Y";
        // echo "2 date_out:*$date_out* mm:*$mm*" . strlen($mm) ."*  dd:*$dd*" .strlen($dd) . "*  yy:*$yy*  date in:*$date_in*\n";
        }
        elseif (strlen($mm) > 2)
        {
            $err_flag = "Y";
        // echo "2 date_out:*$date_out* mm:*$mm*" . strlen($mm) ."*  dd:*$dd*" .strlen($dd) . "*  yy:*$yy*  date in:*$date_in*\n";
        }
        elseif (strlen($mm) == 1)
        {
            $month = "0" . "$mm";
        }
        else
        {
            $month = "$mm";
        }
        if (strlen($dd) == 0)
        {
            $err_flag = "Y";
        // echo "3 date_out:*$date_out* mm:*$mm*" . strlen($mm) ."*  dd:*$dd*" .strlen($dd) . "*  yy:*$yy*  date in:*$date_in*\n";
        }
        elseif (strlen($dd) > 2)
        {
            $err_flag = "Y";
        // echo "2 date_out:*$date_out* mm:*$mm*" . strlen($mm) ."*  dd:*$dd*" .strlen($dd) . "*  yy:*$yy*  date in:*$date_in*\n";
        }
        elseif (strlen($dd) == 1)
        {
            $day = "0" . "$dd";
        }
        else
        {
            $day = "$dd";
        }
  
        if ($err_flag == "N")
        {
            $date_out = "$year-$month-$day";
        }

        // echo "4 date_out:*$date_out* mm:*$mm*" . strlen($mm) ."*  dd:*$dd*" .strlen($dd) . "*  yy:*$yy*  date in:*$date_in*\n";
        return $date_out;
    }

    public function uploadFile($file, $new, $target)
    {
        if ($file['tmp_name'])
        {
            $uploader = $this->file->setOptions([
                'overwrite' => true,
                'newName' => $new,
                'targetDir' => $target,
            ]);
            $try = $uploader->upload($file);
            return $try;
        }

        return false;
       
    }

    public function enscrypt($str)
    {
        $ciphering = "AES-128-CTR";
        $iv_length = openssl_cipher_iv_length($ciphering);
        $options = 0;
        $encryption_iv = '1234567891011121';
        $encryption_key = "CxXb";
        $encryption = openssl_encrypt($str, $ciphering, $encryption_key, $options, $encryption_iv);

        return $encryption;
    }

    public function descrypt($str)
    {
        $ciphering = "AES-128-CTR";
        $decryption_iv = '1234567891011121';
        $decryption_key = "CxXb";
        $option = 0;
        $decryption = openssl_decrypt($str, $ciphering, $decryption_key, $options = 0, $decryption_iv);

        return $decryption;
    }
}
