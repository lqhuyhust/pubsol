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

class PaymentVM extends ViewModel
{
    protected $alias = '';
    protected $layouts = [
        'layouts' => [
            'admin.process_cc',
            'frontend.payment',
        ],
    ];

    public function process_cc()
    {
	    $today = date('Y-m-d');
        if (!$this->user->get('u_id'))
        {
            $uid = 'visitor';
            $u_type = 'view';
            $expire_date = '';
        }
        else
        {
            $uid = $this->user->get('userid');
            $u_type = $this->user->get('u_type');
        }

        $err_flg = "OK";
        $err_msg = "";

        $nu_id = $this->request->post->get('nu_id', '', 'string');
        $nu_id1 = $this->request->post->get('nu_id', '', 'string');
        $pay_amt = $this->request->post->get('pay_amt', 0, 'int');
        $pay_type = $this->request->post->get('pay_type', '', 'string');

        if ($pay_type == "special")
        {
            $row = $this->UserEntity->findOne(['u_id' => $nu_id]); 
        }
        else
        {
            $row = $this->UserEntity->findOne(['userid' => $nu_id]); 
            $n_id = $row['id'];
            $nu_id1 = $row['id'];
            $s_type = $row['s_type'];

            if (!$row) 
            {
                $err_msg .= '<br>Please contact Facts 4 Me to renew your subscription';
                $err_msg .= '<br>Username not found';
                $err_flg = "ERROR";
            }

            if ($s_type == $pay_type)
            {
            // if stype matches pay type the user matches payment amount and type
            }
             else
            {
                if  ($s_type == "extended_staff" || $s_type == "extended_school" || $s_type == "other") 
                {
                    $err_msg .= '<br>Your subscription type of &quot;' . $s_type . '&quot; cannot be renewed on line';
                    $err_msg .= '<br>Please contact Facts 4 Me to renew your subscription';
                    $err_flg = "ERROR";
                }
                elseif ($pay_type == "school" && $s_type != "school" )
                {
                    $err_msg .= '<br>Your subscription is NOT a School Site License';
                    $err_flg = "ERROR";
                }
                elseif ($pay_type == "teacher" && $s_type != "teacher" )
                {
                    $err_msg .= '<br>Your subscription is NOT an Individual Teacher Subscription';
                    $err_flg = "ERROR";
                }
                elseif ($pay_type == "home" && $s_type != "home" )
                {
                    $err_msg .= '<br>Your subscription type is *' . $s_type . '* NOT a Home School/Family Subscription';
                    $err_flg = "ERROR";
                }
                else
                {
                    $err_msg .= '<br>Your subscription type is ' . $s_type . ' Which can not be renewed on line';
                    $err_msg .= '<br>Please contact Facts 4 Me to renew your subscription';
                    $err_flg = "ERROR";
                }
            }
        }

        $nuserid = $row['userid'];
        $nu_email = $row['u_email'];
        $nu_type = $row['u_type'];
        $gift_name = "None";
        $gift_email = "None";
        $u_psw = $row['psw'];
        $s_type = $row['s_type'];
        $t_count = $row['t_count'];
        $grade_level = $row['grade_level'];
        $u_f_name = $row['u_f_name'];
        $u_l_name = $row['u_l_name'];
        $phone = $row['phone'];
        $school_name = trim($row['school_name']);
        if (strlen($school_name) == 0)
        {
            $school_name = "None";
        }
        $addr1 = $row['addr1'];
        $addr2 = $row['addr2'];
        $city = $row['city'];
        $state = $row['state'];
        $zip = $row['zip'];
        $country = $row['country'];
        $time_zone = $row['time_zone'];
        $start_time = $row['start_time'];
        $end_time = $row['end_time'];
        $start_date = $row['start_date'];
        $payment_date = $row['payment_date'];
        $expire_date = $row['expire_date'];
        if ($expire_date < $today)
		{
		    $expire_date = $today; 
		}
        $u_psw = $row['psw'];

        $x_Description = "* * Unknown * *";
        $des_tmp = [
            'school' => "School Site License",
            'teacher' => "Individual Teacher Subscription",
            'home' => "Home School/Family Subscription",
            'other' => "Special Subscription",
            'extended_staff' => "Extended Staff Subscription",
            'extended_school' => 'Extended School Subscription',
        ];
        $x_Description = $des_tmp[$s_type] ?  $des_tmp[$s_type] : $x_Description;

        $x_Amount = $pay_amt;
        if (strlen($pay_amt) == 0)
        {
            $err_msg .= '<br>A payment amount MUST be specified!';
            $err_flg = "ERROR";
        }
        elseif ($pay_amt <= "0")
        {
            $err_msg .= '<br>A payment amount MUST be specified!';
            $err_flg = "ERROR";
        }

        if (strlen($nu_id) == 0)
        {
            $err_msg .= '<br>A User MUST be specified!';
            $err_flg = "ERROR";
        }
        elseif ($nu_id == "0")
        {
            $err_msg .= '<br>A user to update MUST be specified!';
            $err_flg = "ERROR";
        }

        if (strlen($nu_email) == 0)
        {
            $err_msg .= '<br>An email address MUST be specified!';
            $err_flg = "ERROR";
        }

        if (strlen($nuserid) == 0)
        {
            $nuserid = $nu_email;
        }

        if (strlen($phone) == 0)
        {
            $err_msg .= '<br>A Phone Number MUST be specified!';
            $err_flg = "ERROR";
        }

        if (strlen($u_psw) == 0)
        {
            $err_msg .= '<br>A password MUST be specified!';
            $err_flg = "ERROR";
        }

        if (strlen($u_f_name) == 0)
        {
            $err_msg .= '<br>A first name MUST be specified!!';
            $err_flg = "ERROR";
        }

        if (strlen($u_l_name) == 0)
        {
            $err_msg .= '<br>A last name MUST be specified!!';
            $err_flg = "ERROR";
        }

        if (strlen($addr1) == 0)
        {
            $err_msg .= '<br>An address MUST be specified!!';
            $err_flg = "ERROR";
        }

        if (strlen($city) == 0)
        {
            $err_msg .= '<br>A city MUST be specified!!';
            $err_flg = "ERROR";
        }

        if (strlen($state) == 0)
        {
            $err_msg .= '<br>A state MUST be specified!!';
            $err_flg = "ERROR";
        }

        if (strlen($zip) == 0)
        {
            $err_msg .= '<br>A zip or postal code MUST be specified!!';
            $err_flg = "ERROR";
        }

        if (strlen($country) == 0)
        {
            $err_msg .= '<br>A country MUST be specified!!';
            $err_flg = "ERROR";
        }

        if (strlen($time_zone) == 0)
        {
            $err_msg .= '<br>A time zone MUST be specified!!';
            $err_flg = "ERROR";
        }

        if (strlen($start_date) == 0)
        {
            $err_msg .= '<br>A start date MUST be specified!!';
            $err_flg = "ERROR";
        }

        if (strlen($expire_date) == 0)
        {
            $err_msg .= '<br>An end date MUST be specified!!';
            $err_flg = "ERROR";
        }
        else
        {
            $e_date = $this->PaymentModel->edit_date($expire_date);
            if ($e_date == "ERROR")
            {
                $err_msg .= '<br>An end date of ' . $expire_date . ' is not a valid date!';
                $err_flg = "ERROR";
            }
            else
            {
                $expire_date = $e_date;
            }
        }

        if (strlen($payment_date) == 0)
        {
            $err_msg .= '<br>A payment date MUST be specified!!';
            $err_flg = "ERROR";
        }
        else
        {
            $p_date = $this->PaymentModel->edit_date($payment_date);
            if ($p_date == "ERROR")
            {
                $err_msg .= '<br>A payment date of ' . $payment_date . ' is not a valid date!';
                $err_flg = "ERROR";
            }
            else
            {
                $payment_date = $p_date;
            } 
        }

        $auto_info = $this->AutoEntity->findOne(['auto_id' => 1]);
        $tstamp = time();
        srand(time());
        $sequence = rand(1, 1000);
        $fingerprint = $this->PaymentModel->hmac($auto_info['value2'], $auto_info['value1'] . "^" . $sequence . "^" . $tstamp . "^" . $x_Amount . "^USD");
        
        $temp = explode("-", $expire_date);
        $t_yr = date('Y');
        $t_yr = $temp[0] + 1;
        $expire_date_new = $t_yr . "-" . $temp[1] . "-" . $temp[2];
        $session = $this->PaymentModel->paymentInit($x_Description, $x_Amount, 'usd', [
            'nu_id' => $nu_id,
            'nuserid' => $row['userid'],
            'nu_email' => $row['u_email'],
            'nu_type' => $row['u_type'],
            'gift_name' => 'None',
            'gift_email' => 'None',
            'u_psw' => $row['psw'],
            's_type' => $row['s_type'],
            't_count' => $row['t_count'],
            'u_f_name' => $row['u_f_name'],
            'u_l_name' => $row['u_l_name'],
            'payment_date' => $payment_date,
            'expire_date_old' => $expire_date,
            'expire_date_new' => $expire_date_new,
            'renew' => 'Y',
        ]);
        $this->set('x_Description', $x_Description, true);
        $this->set('session_payment', $session, true);
        $this->set('nuserid', $nuserid, true);
        $this->set('nu_id', $nu_id, true);
        $this->set('start_time', $start_time, true);
        $this->set('end_time', $end_time, true);
        $this->set('u_f_name', $u_f_name, true);
        $this->set('u_l_name', $u_l_name, true);
        $this->set('x_Amount', $x_Amount, true);
        $this->set('auto_info', $auto_info, true);
        $this->set('nu_email', $nu_email, true);
        $this->set('nu_type', $nu_type, true);
        $this->set('gift_name', $gift_name, true);
        $this->set('gift_email', $gift_email, true);
        $this->set('u_psw', $u_psw, true);
        $this->set('s_type', $s_type, true);
        $this->set('t_count', $t_count, true);
        $this->set('grade_level', $grade_level, true);
        $this->set('phone', $phone, true);
        $this->set('school_name', $school_name, true);
        $this->set('addr1', $addr1, true);
        $this->set('addr2', $addr2, true);
        $this->set('city', $city, true);
        $this->set('state', $state, true);
        $this->set('zip', $zip, true);
        $this->set('country', $country, true);
        $this->set('start_date', $start_date, true);
        $this->set('today', $today, true);
        $this->set('expire_date', $expire_date, true);

        $publish_key = $this->OptionModel->get('stripe_publish_key', '');
        $secret_key = $this->OptionModel->get('stripe_secret_key', '');
        $this->set('secret_key', $secret_key, true);
        $this->set('publish_key', $publish_key, true);
        $this->set('token', $this->app->getToken(), true);
        $this->set('err_msg', $err_msg, true);
        $this->set('err_flg', $err_flg, true);
        $this->set('bg_color', '#339933', true);
        $this->set('u_id', $this->user->get('u_id'), true);
        $this->set('uid', $uid, true);
        $this->set('u_type', $u_type, true);
        $this->set('url', $this->router->url(), true);
    }

    public function payment()
    {
        $err_flg = "OK";
        $err_msg = "";
        $status_payment = $this->session->get('status_payment', '');
        $statusMsg = $this->session->get('statusMsg', '');
        $price_special = $this->request->post->get('price_special', '', 'string');
        if ($status_payment)
        {
            $err_flg = 'ERROR';
            $err_msg = $statusMsg;
            $this->session->set('status_payment', '');
            $this->session->set('statusMsg', '');
            $this->set('goBack', $this->router->url(), true);
        }
        elseif (!$price_special)
        {
            $nu_id = $this->request->post->get('nu_id', '', 'string');
            $nu_id1 = $this->request->post->get('nu_id1', '', 'string');
            $nuserid = trim($this->request->post->get('nuserid', '', 'string'));
            $nu_email = $this->request->post->get('nu_email', '', 'string');
            $nu_type = $this->request->post->get('nu_type', '', 'string');

            $renew = $this->request->post->get('renew', '', 'string');
            if ($renew != "Y")
            {
                $renew = "N";
            }

            $gift_name = $this->request->post->get('gift_name', '', 'string');
            $gift_email = $this->request->post->get('gift_email', '', 'string');
            $u_psw = $this->request->post->get('u_psw', '', 'string');
            $s_type = $this->request->post->get('s_type', '', 'string');
            $t_count = $this->request->post->get('t_count', '', 'string');
            $grade_level = $this->request->post->get('grade_level', '', 'string');
            $u_f_name = $this->request->post->get('u_f_name', '', 'string');
            $u_l_name = $this->request->post->get('u_l_name', '', 'string');
            $phone = $this->request->post->get('phone', '', 'string');
            $school_name = $this->request->post->get('school_name', '', 'string');
            $addr1 = $this->request->post->get('addr1', '', 'string');
            $addr2 = $this->request->post->get('addr2', '', 'string');
            $city = $this->request->post->get('city', '', 'string');
            $state = $this->request->post->get('state', '', 'string');
            $zip = $this->request->post->get('zip', '', 'string');
            $country = $this->request->post->get('country', '', 'string');
            $time_zone = $this->request->post->get('t_zone', '', 'string');
            $start_time = $this->request->post->get('start_time', '', 'string');
            $end_time = $this->request->post->get('end_time', '', 'string');
            $terms = $this->request->post->get('terms', '', 'string');
            $start_date = $this->request->post->get('start_date', '', 'string');
            $payment_date = $this->request->post->get('payment_date', '', 'string');
            $expire_date = $this->request->post->get('expire_date', '', 'string');
            $del_user = $this->request->post->get('del_user', '', 'string');


            $pay_amt = "20.00";
            if ($s_type == "school")
            {
                $pay_amt = "50.00";
                $x_Description = "School Site License";
            }
            if ($s_type == "extended_school")
            {
                $pay_amt = "150.00";
                $x_Description = "Extended School Hours License";
            }
            if ($s_type == "teacher")
            {
                $pay_amt = "20.00";
                $x_Description = "Individual Teacher Subscription";
            }
            if ($s_type == "home")
            {
                $pay_amt = "20.00";
                $x_Description = "Home School/Family Subscription";
            }

            $x_Amount = $pay_amt;
            if (strlen($nu_id) == 0)
            {
                $err_msg .= '<br>A Username MUST be specified!';
                $err_flg = "ERROR";
            }
            if ($nu_id1 != "NEW")
            {
                if (!is_numeric($nu_id1))
                {
                    $err_msg .= '<br>A valid Username MUST be specified!';
                    $err_flg = "ERROR";
                }
            }

            if (strlen($nu_email) == 0)
            {
                $err_msg .= '<br>An email address MUST be specified!';
                $err_flg = "ERROR";
            }

            if (strlen($nuserid) == 0)
            {
                $nuserid = $nu_email;
            }

            if (strlen($phone) == 0)
            {
                $err_msg .= '<br>A Phone Number MUST be specified!';
                $err_flg = "ERROR";
            }

            if (strlen($u_psw) == 0)
            {
                $err_msg .= '<br>A password MUST be specified!';
                $err_flg = "ERROR";
            }

            if (strlen($u_f_name) == 0)
            {
                $err_msg .= '<br>A first name MUST be specified!!';
                $err_flg = "ERROR";
            }

            if (strlen($u_l_name) == 0)
            {
                $err_msg .= '<br>A last name MUST be specified!!';
                $err_flg = "ERROR";
            }

            if (strlen($addr1) == 0)
            {
                $err_msg .= '<br>An address MUST be specified!!';
                $err_flg = "ERROR";
            }

            if (strlen($city) == 0)
            {
                $err_msg .= '<br>A city MUST be specified!!';
                $err_flg = "ERROR";
            }

            if (strlen($state) == 0)
            {
                $err_msg .= '<br>A state MUST be specified!!';
                $err_flg = "ERROR";
            }

            if (strlen($zip) == 0)
            {
                $err_msg .= '<br>A zip or postal code MUST be specified!!';
                $err_flg = "ERROR";
            }

            if (strlen($country) == 0)
            {
                $err_msg .= '<br>A country MUST be specified!!';
                $err_flg = "ERROR";
            }

            if (strlen($time_zone) == 0)
            {
                $err_msg .= '<br>A time zone MUST be specified!!';
                $err_flg = "ERROR";
            }

            if ($terms != "on")
            {
                $err_msg .= '<br>You MUST accept the terms to continue!!';
                $err_flg = "ERROR";
            }

            if (strlen($start_date) == 0)
            {
                $err_msg .= '<br>A start date MUST be specified!!';
                $err_flg = "ERROR";
            }
            else
            {
                $s_date = $this->UserModel->edit_date($start_date);
                if ($s_date == "ERROR")
                {
                    $err_msg .= '<br>A start date of ' . $start_date . ' is not a valid date!';
                    $err_flg = "ERROR";
                }
                else
                {
                    $start_date = $s_date;
                }
            }

            if (strlen($expire_date) == 0)
            {
                $err_msg .= '<br>An end date MUST be specified!!';
                $err_flg = "ERROR";
            }
            else
            {
                $e_date = $this->UserModel->edit_date($expire_date);
                if ($e_date == "ERROR")
                {
                    $err_msg .= '<br>An end date of ' . $expire_date . ' is not a valid date!';
                    $err_flg = "ERROR";
                }
                else
                {
                    $expire_date = $e_date;
                }
            }

            if (strlen($payment_date) == 0)
            {
                $err_msg .= '<br>A payment date MUST be specified!!';
                $err_flg = "ERROR";
            }
            else
            {
                $p_date = $this->UserModel->edit_date($payment_date);
                if ($p_date == "ERROR")
                {
                    $err_msg .= '<br>A payment date of ' . $payment_date . ' is not a valid date!';
                    $err_flg = "ERROR";
                }
                else
                {
                    $payment_date = $p_date;
                }
            }

            $is_user = $nu_id;
            if ($nu_id == "NEW" || $nu_id == '0')
            {
                $check = $this->UserEntity->findOne(['userid' => $nuserid]);
                if ($check)
                {
                    $err_msg .= '<br>Username "' . $nuserid . '" is already in the system - please select another name!';
                    $err_flg = "ERROR";
                }
                elseif ($err_flg != 'ERROR')
                {
                }
            }
            $user_tmp = $this->UserEntity->findByPK($is_user);
            $this->set('user', $user_tmp);
            
            if ($user_tmp || $nu_id == "NEW" || $nu_id == '0')
            {
                $today = date('Y-m-d');
                $temp = explode("-", $expire_date);
                $t_yr = date('Y');
                $t_yr = $temp[0] + 1;
                $expire_date_new = $t_yr . "-" . $temp[1] . "-" . $temp[2];
                $session = $this->PaymentModel->paymentInit($x_Description, $x_Amount, 'usd', [
                    'x_cust_id' => $nu_email,
                    'nu_id' => $nu_id,
                    'nuserid' => $nuserid,
                    'nu_email' => $nu_email,
                    'nu_type' => $nu_type,
                    'cust_id' => $nu_email,
                    'gift_name' => $gift_name,
                    'gift_email' => $gift_email,
                    'u_psw' => $u_psw,
                    's_type' => $s_type,
                    't_count' => $t_count,
                    'grade_level' => $grade_level,
                    'u_f_name' => $u_f_name,
                    'u_l_name' => $u_l_name,
                    'phone' => $phone,
                    'school_name' => $school_name,
                    'addr1' => $addr1,
                    'addr2' => $addr2,
                    'city' => $city,
                    'zip' => $zip,
                    'state' => $state,
                    'country' => $country,
                    'time_zone' => $time_zone,
                    'start_date' => $start_date,
                    'start_time' => $start_time,
                    'end_time' => $end_time,
                    'payment_date' => $payment_date,
                    'expire_date_old' => $expire_date,
                    'expire_date_new' => $expire_date_new,
                    'renew' => $renew,
                ]);
            }
            

            if (!$session['status'])
            {
                $err_msg = 'ERROR';
                $err_msg .= '<br>Payment session can`t open';
            }

            $this->set('session_payment', $session, true);
            $this->set('x_Description', $x_Description, true);
            $this->set('nuserid', $nuserid, true);
            $this->set('nu_id', $nu_id, true);
            $this->set('u_f_name', $u_f_name, true);
            $this->set('u_l_name', $u_l_name, true);
            $this->set('x_Amount', $x_Amount, true);
            $this->set('nu_email', $nu_email, true);
            $this->set('nu_type', $nu_type, true);
            $this->set('gift_name', $gift_name, true);
            $this->set('gift_email', $gift_email, true);
            $this->set('u_psw', $u_psw, true);
            $this->set('s_type', $s_type, true);
            $this->set('t_count', $t_count, true);
            $this->set('grade_level', $grade_level, true);
            $this->set('phone', $phone, true);
            $this->set('school_name', $school_name, true);
            $this->set('addr1', $addr1, true);
            $this->set('addr2', $addr2, true);
            $this->set('city', $city, true);
            $this->set('state', $state, true);
            $this->set('zip', $zip, true);
            $this->set('renew', $renew, true);
            $this->set('country', $country, true);
            $this->set('start_date', $start_date, true);
            $this->set('today', $today, true);
            $this->set('expire_date', $expire_date, true);
        }
        else
        {
            $nu_id = $this->request->post->get('user', '', 'string');
            $price = (int) $this->request->post->get('price', '', 'string');
            $user_renew = $this->UserEntity->findByPK($nu_id);
            $renew = 'Y';

            $user_tmp = $this->UserEntity->findByPK($nu_id);
            if (!$user_tmp)
            {
                $err_msg .= '<br>A Username MUST be specified!!';
                $err_flg = "ERROR";
            }

            $pay_amt = $price. ".00";
            if ($user_tmp['s_type'] == "school")
            {
                $x_Description = "School Site License";
            }
            if ($user_tmp['s_type'] == "extended_school")
            {
                $x_Description = "Extended School Hours License";
            }
            if ($user_tmp['s_type'] == "teacher")
            {
                $x_Description = "Individual Teacher Subscription";
            }
            if ($user_tmp['s_type'] == "home")
            {
                $x_Description = "Home School/Family Subscription";
            }
            if ($user_tmp['s_type'] == "other")
            {
                $x_Description = "Extended access";
            }

            $x_Amount = $pay_amt;

            if (strlen($user_tmp['start_date']) == 0)
            {
                $err_msg .= '<br>A start date MUST be specified!!';
                $err_flg = "ERROR";
            }
            else
            {
                $s_date = $this->UserModel->edit_date($user_tmp['start_date']);
                if ($s_date == "ERROR")
                {
                    $err_msg .= '<br>A start date of ' . $user_tmp['start_date'] . ' is not a valid date!';
                    $err_flg = "ERROR";
                }
                else
                {
                    $user_tmp['start_date'] = $s_date;
                }
            }

            $user_tmp['payment_date'] = date('m/d/Y');
            $user_tmp['payment_date'] = $user_tmp['expire_date'] ? $user_tmp['expire_date'] : date('Y-m-d') ;
            $is_user = $nu_id;
            
            $this->set('user', $user_tmp);
            
            if ($user_tmp)
            {
                $today = date('Y-m-d');
                
                $temp = explode("-", $user_tmp['expire_date']);
                $t_yr = date('Y');
                $t_yr = $temp[0] + 1;
                $expire_date_new = $t_yr . "-" . $temp[1] . "-" . $temp[2];
                $session = $this->PaymentModel->paymentInit($x_Description, $x_Amount, 'usd', [
                    'x_cust_id' => $user_tmp['u_email'],
                    'nu_id' => $user_tmp['u_id'],
                    'nuserid' => $user_tmp['userid'],
                    'nu_email' => $user_tmp['u_email'],
                    'nu_type' => $user_tmp['u_type'],
                    'cust_id' => $user_tmp['u_email'],
                    'gift_name' => $user_tmp['gift_name'],
                    'gift_email' => '',
                    'u_psw' => $user_tmp['psw'],
                    's_type' => $user_tmp['s_type'],
                    't_count' => $user_tmp['t_count'],
                    'grade_level' => $user_tmp['grade_level'],
                    'u_f_name' => $user_tmp['u_f_name'],
                    'u_l_name' => $user_tmp['u_l_name'],
                    'phone' => $user_tmp['phone'],
                    'school_name' => $user_tmp['school_name'],
                    'addr1' => $user_tmp['addr1'],
                    'addr2' => $user_tmp['addr2'],
                    'city' => $user_tmp['city'],
                    'zip' => $user_tmp['zip'],
                    'state' => $user_tmp['state'],
                    'country' => $user_tmp['country'],
                    'time_zone' => $user_tmp['time_zone'],
                    'start_date' => $user_tmp['start_date'],
                    'start_time' => $user_tmp['start_time'],
                    'end_time' => $user_tmp['end_time'],
                    'payment_date' => $user_tmp['payment_date'],
                    'expire_date_old' => $user_tmp['expire_date'],
                    'expire_date_new' => $expire_date_new,
                    'renew' => 'Y',
                ]);
            }
            

            if (!$session['status'])
            {
                $err_msg = 'ERROR';
                $err_msg .= '<br>Payment session can`t open';
            }

            $this->set('session_payment', $session, true);
            $this->set('x_Description', $x_Description, true);
            $this->set('nuserid', $user_tmp['userid'], true);
            $this->set('nu_id', $user_tmp['u_id'], true);
            $this->set('u_f_name', $user_tmp['u_f_name'], true);
            $this->set('u_l_name', $user_tmp['u_l_name'], true);
            $this->set('x_Amount', $x_Amount, true);
            $this->set('nu_email', $user_tmp['u_email'], true);
            $this->set('nu_type', $user_tmp['u_type'], true);
            $this->set('gift_name', $user_tmp['gift_name'], true);
            $this->set('gift_email', '', true);
            $this->set('u_psw', $user_tmp['psw'], true);
            $this->set('s_type', $user_tmp['s_type'], true);
            $this->set('t_count', $user_tmp['t_count'], true);
            $this->set('grade_level', $user_tmp['grade_level'], true);
            $this->set('phone', $user_tmp['phone'], true);
            $this->set('school_name', $user_tmp['school_name'], true);
            $this->set('addr1', $user_tmp['addr1'], true);
            $this->set('addr2', $user_tmp['addr2'], true);
            $this->set('city', $user_tmp['city'], true);
            $this->set('state', $user_tmp['state'], true);
            $this->set('zip', $user_tmp['zip'], true);
            $this->set('renew', 'Y', true);
            $this->set('country', $user_tmp['country'], true);
            $this->set('start_date', $user_tmp['start_date'], true);
            $this->set('today', $today, true);
            $this->set('expire_date', $user_tmp['expire_date'], true);
        }
        // user infor
        if (!$this->user->get('u_id'))
        {
            $uid = 'visitor';
            $u_type = 'view';
        }
        else
        {
            $uid = $this->user->get('userid');
            $u_type = $this->user->get('u_type');
        }

        if ($err_msg != 'ERROR')
        {
            $publish_key = $this->OptionModel->get('stripe_publish_key', '');
            $secret_key = $this->OptionModel->get('stripe_secret_key', '');
            $this->set('secret_key', $secret_key, true);
            $this->set('publish_key', $publish_key, true);
        }
        $this->set('token', $this->app->getToken(), true);

        $this->set('err_msg', $err_msg, true);
        $this->set('err_flg', $err_flg, true);
        $this->set('bg_color', '#339933', true);
        $this->set('u_id', $this->user->get('u_id'), true);
        $this->set('uid', $uid, true);
        $this->set('u_type', $u_type, true);
        $this->set('url', $this->router->url(), true);
    }
}
