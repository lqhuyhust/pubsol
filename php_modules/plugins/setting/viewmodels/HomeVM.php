<?php

/**
 * SPT software - ViewModel
 * 
 * @project: https://github.com/smpleader/spt-boilerplate
 * @author: Pham Minh - smpleader
 * @description: Just a basic viewmodel
 * 
 */

namespace App\plugins\facts4me\viewmodels;

use SPT\View\VM\JDIContainer\ViewModel;

class HomeVM extends ViewModel
{
    protected $alias = '';
    protected $layouts = [
        'layouts.frontend' => [
            'home',
            'login',
            'contact',
            'about',
            'terms',
            'sub',
            'tell_friend',
            'visitor',
            'renew',
            'topic_list',
            'topics',
            'disp_subject',
            // 'payment',
        ],
    ];

    public function home()
    {

        $this->set('url', $this->router->url());
    }

    public function visitor()
    {
        $this->set('url', $this->router->url(), true);
    }

    public function about()
    {
        $content = $this->PostEntity->findOne(['name Like "about" AND status Like 1']);
        $content = $content ? $content['content'] : '';
        $this->set('content', $content, true);
        $this->set('url', $this->router->url(), true);
    }

    public function terms()
    {
        $content = $this->PostEntity->findOne(['name Like "term" AND status Like 1']);
        $content = $content ? $content['content'] : '';
        $this->set('content', $content, true);
        $this->set('url', $this->router->url(), true);
    }

    public function tell_friend()
    {
        $err_flg = $this->session->get('err_flg', '');
        $err_msg = $this->session->get('err_msg', '');
        $send_mail = $this->session->get('send_mail', '');
        $to_email = $this->session->get('to_email', '');
        $from_email = $this->session->get('from_email', '');
        $mail_error = $this->session->get('mail_error', '');
        $after_submit = $this->session->get('after_submit', '');
        $this->session->set('after_submit', '');
        $this->session->set('send_mail', '');
        $this->session->set('to_email', '');
        $this->session->set('from_email', '');
        $this->session->set('mail_error', '');
        $this->session->set('err_flg', '');
        $this->session->set('err_msg', '');

        $this->set('to_addr', $this->config->to_addr, true);
        $this->set('to_name', 'Facts4Me', true);
        $this->set('send_mail', $send_mail, true);
        $this->set('mail_error', $mail_error, true);
        $this->set('after_submit', $after_submit, true);
        $this->set('to_email', $to_email, true);
        $this->set('from_email', $from_email, true);
        $this->set('err_msg', $err_msg, true);
        $this->set('err_flg', $err_flg, true);
        $this->set('token', $this->app->getToken(), true);
        $this->set('url', $this->router->url(), true);
    }

    public function login()
    {
        $err_flg = $this->session->get('login_error', '');
        $err_msg = $this->session->get('login_error_msg', '');
        $ip_addr = $this->request->get->get('ip_addr', '', 'string');
        if ($ip_addr)
        {
            $user_ip_login = $this->IPLoginEntity->findOne(['ip_addr' => $ip_addr]);
            $user_id = $user_ip_login ? $user_ip_login['u_id'] : 0;
            $check = $this->UserEntity->findByPK($user_id);
            if ($check && $check['u_type'] == 'view' && ($check['s_type'] == 'school' || $check['s_type'] == 'extended_school'))
            {
                $this->set('ip_addr', $ip_addr);
                $this->set('token', $this->app->getToken());
            }
        }
        $this->session->set('login_error', '');
        $this->session->set('login_error_msg', '');

        $this->set('err_msg', $err_msg, true);
        $this->set('err_flg', $err_flg, true);
        $this->set('url', $this->router->url(), true);
    }

    public function contact()
    {
        $err_flg = $this->session->get('err_flg', '');
        $err_msg = $this->session->get('err_msg', '');
        $send_mail = $this->session->get('send_mail', '');
        $c_email = $this->session->get('c_email', '');
        $mail_error = $this->session->get('mail_error', '');
        $after_submit = $this->session->get('after_submit', '');
        
        $name = $this->session->get('name','');
        $school_name = $this->session->get('school_name','');
        $email = $this->session->get('email','');
        $addr1 = $this->session->get('addr1','');
        $addr2 = $this->session->get('addr2','');
        $city = $this->session->get('city','');
        $state = $this->session->get('state','');
        $zip = $this->session->get('zip','');
        $how_found = $this->session->get('howfound','');
        $cont_notes = $this->session->get('cont_notes','');

        $this->session->set('after_submit', '');
        $this->session->set('send_mail', '');
        $this->session->set('c_email', '');
        $this->session->set('mail_error', '');
        $this->session->set('err_flg', '');
        $this->session->set('err_msg', '');

        $this->session->set('name', '');
        $this->session->set('email', '');
        $this->session->set('addr1', '');
        $this->session->set('school_name', '');
        $this->session->set('addr2', '');
        $this->session->set('city', '');
        $this->session->set('state', '');
        $this->session->set('zip', '');
        $this->session->set('howfound', '');
        $this->session->set('cont_notes', '');

        $this->set('name', $name, true);
        $this->set('email', $email, true);
        $this->set('school_name', $school_name, true);
        $this->set('addr1', $addr1, true);
        $this->set('addr2', $addr2, true);
        $this->set('city', $city, true);
        $this->set('state', $state, true);
        $this->set('zip', $zip, true);
        $this->set('howfound', $how_found, true);
        $this->set('cont_notes', $cont_notes, true);


        $this->set('to_addr', $this->config->to_addr, true);
        $this->set('to_name', 'Facts4Me', true);
        $this->set('send_mail', $send_mail, true);
        $this->set('mail_error', $mail_error, true);
        $this->set('after_submit', $after_submit, true);
        $this->set('c_email', $c_email, true);
        $this->set('err_msg', $err_msg, true);
        $this->set('err_flg', $err_flg, true);
        $this->set('key_num', $this->bld_psw());
        $this->set('token', $this->app->gettoken());
        $this->set('url', $this->router->url(), true);
    }

    public function sub()
    {
        $err_flg = 'OK';

        $method = $this->request->header->getRequestMethod();
        if ($method == 'get') {
            $s_type = $this->request->get->get('s_type', '', 'string');
            $s_gift = $this->request->get->get('s_gift', '', 'string');
        } else {
            $s_type = $this->request->post->get('s_type', '', 'string');
            $s_gift = $this->request->post->get('s_gift', '', 'string');
        }

        if (strlen($s_gift) == 0) {
            $s_gift = "no";
        }
        $err_msg = '';
        if (strlen($s_type) == 0) {
            $err_msg .= '<br>A Subscription type MUST be specified!';
            $err_flg = "ERROR";
        }

        if ($s_type != "teacher" && $s_type != "school" && $s_type != "extended_school" && $s_type != "home") {
            $err_msg .= '<br>A Valid Subscription type MUST be specified! *' . $s_type . '*';
            $err_flg = "ERROR";
        }

        $data = [
            'nu_id' => "0",
            'nu_id1' => "NEW",
            'nuserid' => "",
            'nu_email' => "",
            'nu_type' => "view",
            't_count' => "1",
            'u_f_name' => "",
            'u_l_name' => "",
            'phone' => "",
            'school_name' => "",
            'addr1' => "",
            'addr2' => "",
            'city' => "",
            'state' => "",
            'zip' => "",
            'country' => "United States",
            'time_zone' => "CST",
            'start_date' => $this->format_date(date('Y-m-d')),
            'payment_date' => date('Y-m-d'),
            'expire_date' => date('Y-m-d'),
        ];

        if ($s_type == "teacher") {
            $s_type1 = "Individual Teacher/Classroom";
            $start_time = "08:00:00";
            $end_time = "17:00:00";
        } elseif ($s_type == "school") {
            $s_type1 = "Basic School Hours";
            $start_time = "08:00:00";
            $end_time = "17:00:00";
        } elseif ($s_type == "extended_school") {
            $s_type1 = "Extended School Hours";
            $start_time = "00:00:00";
            $end_time = "24:00:00";
        } elseif ($s_type == "home") {
            $s_type1 = "Home/Family";
            $start_time = "00:00:00";
            $end_time = "24:00:00";
        } elseif ($s_type == "other") {
            $s_type1 = "Extended access";
            $start_time = "00:00:00";
            $end_time = "24:00:00";
        }

        $this->set('s_type1', $s_type1);
        $this->set('bg_color', '#339933', true);
        $this->set('start_time', $start_time);
        $this->set('end_time', $end_time);
        $this->set('data', $data);
        $this->set('s_type', $s_type);
        $this->set('s_gift', $s_gift);
        $this->set('err_flg', $err_flg, true);
        $this->set('err_msg', $err_msg, true);
        $this->set('tz_list', $this->time_zone_list());
        $this->set('psw', $this->bld_psw());
        $this->set('url', $this->router->url(), true);
        // for footer 1
        $this->footer1();
    }

    public function bld_psw()
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
        $psw_lst[14] = "asd";
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

        $ran_1 = mt_rand(1, 60);
        $time1 = date('S');
        if ($ran_1 > 60 || $ran_1  < 1) {
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

    public function footer1()
    {
        $ftr_bgcolor = "#f7f7c6";
        $flag = "";
        $u_type = '';
        $this->set('ftr_bgcolor', $ftr_bgcolor, true);
        $this->set('flag', $flag, true);
        $this->set('u_type', $u_type, true);
        $this->set('u_id', 0, true);
    }

    public function renew()
    {
        $err_flg = 'OK';

        $method = $this->request->header->getRequestMethod();
        if ($method == 'get') {
            $req_s_type = $this->request->get->get('s_type', '', 'string');
            $renew_id = $this->request->get->get('renew_id', '', 'string');
        } else {
            $req_s_type = $this->request->post->get('s_type', '', 'string');
            $renew_id = $this->request->post->get('renew_id', '', 'string');
        }

        $err_msg = '';
        if (strlen($req_s_type) == 0) {
            $err_msg .= '<br>A Subscription type MUST be specified!';
            $err_flg = "ERROR";
        }

        if ($req_s_type != "teacher" && $req_s_type != "school" && $req_s_type != "extended_school" && $req_s_type != "home") {
            $err_msg .= '<br>A Valid Subscription type MUST be specified.';
            $err_flg = "ERROR";
        }

        if (strlen($renew_id) == 0) {
            $err_msg .= '<br>Username MUST be specified.';
            $err_flg = "ERROR";
        }
        $data = $this->UserEntity->findOne(['userid' => $renew_id]);

        $data['payment_date'] = date('Y-m-d');
        $data['start_date'] = $this->format_date($data['start_date']);
        if (trim($data['s_type']) == "") {
            $err_msg .= '<br>Please select the correct subscription type and enter your login name.';
            $err_flg = "ERROR";
        } elseif ($data['s_type'] != $req_s_type) {
            $err_msg .= '<br>Current subscription type is "' . $data['s_type'] . '"  not "' . $req_s_type . '."  Please select the correct renew section.';
            $err_flg = "ERROR";
        }

        $s_type = $data['s_type'];
        if ($s_type == "teacher") {
            $s_type1 = "Individual Teacher/Classroom";
            $start_time = "08:00:00";
            $end_time = "17:00:00";
        } elseif ($s_type == "school") {
            $s_type1 = "Basic School Hours";
            $start_time = "08:00:00";
            $end_time = "17:00:00";
        } elseif ($s_type == "extended_school") {
            $s_type1 = "Extended School Hours";
            $start_time = "00:00:00";
            $end_time = "24:00:00";
        } elseif ($s_type == "home") {
            $s_type1 = "Home/Family";
            $start_time = "00:00:00";
            $end_time = "24:00:00";
        } elseif ($s_type == "other") {
            $s_type1 = "Extended access";
            $start_time = "00:00:00";
            $end_time = "24:00:00";
        }

        $this->set('s_type1', $s_type1);
        $this->set('bg_color', '#339933', true);
        $this->set('start_time', $start_time);
        $this->set('end_time', $end_time);
        $this->set('data', $data);
        $this->set('err_flg', $err_flg, true);
        $this->set('err_msg', $err_msg, true);
        $this->set('tz_list', $this->time_zone_list());
        $this->set('psw', $this->bld_psw());
        $this->set('url', $this->router->url(), true);
        // for footer 1
        $this->footer1();
    }

    public function topic_list()
    {
        $topic = $this->TopicEntity->list(0, 0, [], 'topic_name');
        $isLogged = $this->user->get('id') ? true : false;
        $total = $this->TopicEntity->getListTotal();

        $this->set('isLogged', $isLogged);
        $this->set('topic', $topic);
        $this->set('total', $total);
        $this->set('url', $this->router->url(), true);
    }

    public function topics()
    {
        $topic = $this->TopicEntity->list(0, 0, [], 'topic_name');
        $method = $this->request->header->getRequestMethod();

        if ($method == 'get') {
            $topic_id = $this->request->get->get('t', '', 'string');
            $s_term = 'none';
        } else {
            $s_term = $this->request->post->get('s_term', 'none', 'string');
            $topic_id = 0;
        }

        if (!$this->user->get('u_id')) {
            $uid = 'visitor';
            $u_type = 'view';
            $expire_date = '';
        } else {
            $uid = $this->user->get('userid');
            $u_type = $this->user->get('u_type');
            $expire_date = $this->format_date($this->user->get('expire_date'));
        }

        $subs = [];
        $sub_ct = 0;
        $topic_name = '';
        if ($topic_id) {
            $topic = $this->TopicEntity->findByPK($topic_id);
            $topic_name = $topic['topic_name'];
            $subs = $this->TopSubEntity->listSub(0, 0, $topic_id, ['subject.sub_active LIKE "Y"'], 'sub_name');
            $sub_ct = $subs ? count($subs) : -1;
        } elseif ($s_term != 'none') {
            if (strlen($s_term) < 2) {
                $sub_ct = -1;
                $topic_id = 0;
            } else {
                $where[] = '(sub_name like "%' . $s_term . '%" or sub_search like "%' . $s_term . '%")';
                $where[] = 'sub_active Like "Y"';
                $subs = $this->SubEntity->list(0, 0, $where, 'sub_name');
                if (!$subs) {
                    $find_topic = $this->TopicEntity->list(0, 1, ['topic_name like "%' . $s_term . '%" and topic_active="Y"'], 'topic_name');
                    if ($find_topic) {
                        $subs = $this->TopSubEntity->listSub(0, 0, $find_topic['topic_id'], [], 'sub_name');
                    }
                }
                $sub_ct = $subs ? count($subs) : 0;
            }
        }
        $topic_list = $this->TopicEntity->list(0, 0);
        $this->set('s_term', $s_term);
        $this->set('sub_list', $subs);
        $this->set('sub_ct', $sub_ct);
        $this->set('topic_name', $topic_name);
        $this->set('topic_id', $topic_id);
        $this->set('topic_list', $topic_list);
        $this->set('uid', $uid);
        $this->set('u_type', $u_type);
        $this->set('expire_date', $expire_date);
        $this->set('url', $this->router->url(), true);
    }

    public function disp_subject()
    {
        //check user type
        $topic = $this->TopicEntity->list(0, 0, [], 'topic_name');
        $method = $this->request->header->getRequestMethod();

        if ($method == 'get') {
            $topic_id = $this->request->get->get('t', '', 'string');
            $s_term = 'none';
        } else {
            $s_term = $this->request->post->get('s_term', 'none', 'string');
            $topic_id = 0;
        }

        if (!$this->user->get('u_id')) {
            $uid = 'visitor';
            $u_type = 'view';
            $expire_date = '';
        } else {
            $uid = $this->user->get('userid');
            $u_type = $this->user->get('u_type');
            $expire_date = $this->format_date($this->user->get('expire_date'));
        }
        //end check user type

        $subject_id = $this->request->get->get('s_id', '', 'string');
        $subject = $this->SubEntity->findByPK($subject_id);
        if ($subject && $subject['sub_active'] == 'N')
        {
            $this->app->redirect($this->router->url(''));
        }
        if ($subject)
        {
            $subject['sub_text'] = str_replace(['<!DOCTYPE html>', '<html>', '</html>', '<body>', '</body>'], '', $subject['sub_text']);
            if (strpos($subject['sub_text'], "<table") !== false)
            {
                $subject['sub_text'] = strpos( $subject['sub_text'], '</table>') === false ? $subject['sub_text'] . '</table>' : $subject['sub_text'];
            }
        }
        
        $sub_images = [];
        $sub_facts = [];
        $topics = [];
        $sub_ct = 0;
        if ($subject_id) {
            $sub_images = $this->SubImageEntity->list(0, 0, ['subject_id' => $subject_id], 'sort_order');
            $sub_ct = $sub_images ? count($sub_images) : 0;
            $topics = $this->TopSubEntity->listTopic(0, 0, $subject_id, [], 'topic.topic_name', 'topic_name, topic.topic_id');
            $sub_facts = $this->SubFactEntity->list(0, 0, ['subject_id' => $subject_id], 'sort_order');
        }

        // check topic id
        $topic_id = $this->request->get->get('t', '', 'string');
        $t_link = $topic_id ? '?t=' . $topic_id : '';
        
        $this->set('expire_date', $expire_date);
        $this->set('uid', $uid);
        $this->set('u_type', $u_type);
        $this->set('t_link', $t_link);
        $this->set('subject', $subject);
        $this->set('topics', $topics);
        $this->set('sub_images', $sub_images);
        $this->set('sub_facts', $sub_facts);
        $this->set('sub_ct', $sub_ct);
        $this->set('bg_color', '#339933', true);
        $this->set('url', $this->router->url(), true);
    }
    
}
