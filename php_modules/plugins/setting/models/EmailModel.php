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

use PHPMailer\PHPMailer\PHPMailer;
use SPT\JDIContainer\Base;
use Stripe\Stripe as Striper;
use Stripe\Checkout\Session as StriperSession;

class EmailModel extends Base
{
    public function email_check($e_addr)
    {
        // special characters for email testing * array of invalid characters
        $special_chars_email = array(',', '\'', '/', '\\', '`', ';', '[',  ']', '*', '&', '^', '%', '$', '#', '!', '~', '(', ')', '|', '{', '}', '<', '>', '?', ':', '"', '=', ' ');

        if (filter_var($e_addr, FILTER_VALIDATE_EMAIL)) {
            // return true;
        } else {
            return false;
        }
        //starting length of address
        $len = strlen($e_addr);

        //replace invalid characters
        $e_addr = str_replace($special_chars_email, '', $e_addr);

        // if lengths are different ($len smaller), invalid characters found.
        if (strlen($e_addr) != $len) {
            return false;
        }
        return true;
    }

    public function sendMailUser($data)
    {
        $email_host = $this->OptionModel->get('email_host', '');
        $email_username = $this->OptionModel->get('email_username', '');
        $email_password = $this->OptionModel->get('email_password', '');
        
        $message = $this->getMailTemplate($data);
        $reply_email = "smorgan@facts4me.com";
        $reply_name = "Facts4Me Subscription";
        $from_addr = "send_info@facts4me.com";
        $from_name = "Facts4Me Subscription";
        $to_addr = $data['nu_email'];
        $cc_addr1 = "smorgan@facts4me.com";
        $cc_name1 = "Sandy";
        $to_name = $data['gift_name'] != 'None' ? $data['gift_name'] : $data['u_f_name'] . " " . $data['u_l_name'];
        $mail = new PHPMailer(); // Next we create a new object of the PHPMailer called $mail
		$mail->Mailer = 'smtp';		
		//	$mail->ContentType = 'text/plain';		
		$mail->ContentType = 'text/html';		
		$mail->From = "send_info@facts4me.com"; // this is the From adress (the adress the email came from)
		$mail->FromName = "Facts4Me";
		$mail->Host = $email_host;
		$mail->Username = $email_username;
		$mail->Password = $email_password;
		$mail->SMTPAuth = true;
		$mail->AddReplyTo($reply_email, $reply_name);		
		$mail->Subject = $message['subject']; // This is the subject  of the email message.
		$mail->Body = $message['message'];    // This is the actual email message
		$mail->AddAddress($to_addr, $to_name);
		$mail->AddBCC($reply_email, $reply_name);		
		$mail->AddBCC($cc_addr1, $cc_name1);

        $try = $mail->Send();
        return $try;
    }

    public function getMailTemplate($data, $type = '')
    {
        $today = date('Y-m-d');

        $email_template = APP_PATH . 'plugins/facts4me/views/template_email';
        if ($data['s_type'] == "teacher") {
            if ($data['gift_name'] != "None") {
                $email_file_name = "gift_teacher";
            } elseif ($data['renew'] == "Y") {
                $email_file_name = "teacher_renew";
            } else {
                $email_file_name = "teacher";
            }
        }
        if ($data['s_type'] == "school") {
            if ($data['renew'] == "Y") {
                $email_file_name = "basic_school_renew";
            } else {
                $email_file_name = "basic_school";
            }
        }

        if ($data['s_type'] == "extended_school") {
            if ($data['renew'] == "Y") {
                $email_file_name = "extended_school_renew";
            } else {
                $email_file_name = "extended_school";
            }
        }

        if ($data['s_type'] == "home") {
            if ($data['gift_name'] != "None") {
                $email_file_name = "gift_home";
            } elseif ($data['renew'] == "Y") {
                $email_file_name = "home_renew";
            } else {
                $email_file_name = "home";
            }
        }

        if ($data['s_type'] == "teacher" && $data['gift_email'] != 'None') {
            $email_file_name = "gift_teacher_giver";
        }
        if ($data['s_type'] == "home") {
            $email_file_name = "gift_home_giver";
        }

        $email_tmp_id = $this->OptionModel->get('tmp_'.$email_file_name, '');
        $email_tmp = $this->EmailTmpEntity->findByPK($email_tmp_id);
        if ($email_tmp)
        {
            $tmp_message = $email_tmp['e_tmp'];
            $tmp_subject = $email_tmp['e_sub'];
        }
        else
        {
            $tmp_message = file_get_contents($email_template.'/'. $email_file_name. '.htm');
            $tmp_subject = file_get_contents($email_template.'/'. $email_file_name. '.txt');
        }
        $tmp_subject = str_replace("%disp_date%", $this->UserModel->format_date($today), $tmp_subject);
        $tmp_message = str_replace("%disp_date%", $this->UserModel->format_date($today), $tmp_message);

        if ($data['gift_name']) {
            $tmp_subject = str_replace("%gift_name%", $data['gift_name'], $tmp_subject);
            $tmp_message = str_replace("%gift_name%", $data['gift_name'], $tmp_message);
        }

        if ($data['school_name']) {
            $tmp_subject = str_replace("%school_name%", $data['school_name'], $tmp_subject);
            $tmp_message = str_replace("%school_name%", $data['school_name'], $tmp_message);
        }
        if ($data['to_name']) {
            $tmp_subject = str_replace("%to_name%", $data['to_name'], $tmp_subject);
            $tmp_message = str_replace("%to_name%", $data['to_name'], $tmp_message);
        }
        if ($data['u_f_name']) {
            $tmp_subject = str_replace("%u_f_name%", $data['u_f_name'], $tmp_subject);
            $tmp_message = str_replace("%u_f_name%", $data['u_f_name'], $tmp_message);
        }
        if ($data['u_l_name']) {
            $tmp_subject = str_replace("%u_l_name%", $data['u_l_name'], $tmp_subject);
            $tmp_message = str_replace("%u_l_name%", $data['u_l_name'], $tmp_message);
        }
        if ($data['u_psw']) {
            $tmp_message = str_replace("%u_psw%", $data['u_psw'], $tmp_message);
        }
        if ($data['psw']) {
            $tmp_message = str_replace("%psw%", $data['psw'], $tmp_message);
        }
        if ($data['userid']) {
            $tmp_message = str_replace("%userid%", $data['userid'], $tmp_message);
        }
        if ($data['nuserid']) {
            $tmp_message = str_replace("%nuserid%", $data['nuserid'], $tmp_message);
        }
        if ($data['expire_date_new']) {
            $tmp_message = str_replace("%expire_date%", $this->UserModel->format_date($data['expire_date_new']), $tmp_message);
        }
        $subject = $tmp_subject;
        $message = $tmp_message;
        return [
            'subject' => $subject,
            'message' => $message,
        ];
    }

    public function sentConfirmation($payment, $data, $payment_details)
    {
        $email_host = $this->OptionModel->get('email_host', '');
        $email_username = $this->OptionModel->get('email_username', '');
        $email_password = $this->OptionModel->get('email_password', '');
        $sent_mail = $this->OptionModel->get('email_confirmation', '');
        $data['nu_id'] = $data['nu_id'] ? $data['nu_id'] : 'NEW';
        if (!$sent_mail)
        {
            return false;
        }

        $type=[
            'school' => 'School Site License',
            'extended_school' => 'Extended School Hours License',
            'teacher' => 'Individual Teacher Subscription',
            'home' => 'Home School/Family Subscription',
            'extended_staff' => 'Extended Staff Subscription',
            'other' => 'Unknown',
        ];
        $description = $type[$data->s_type];
        $amount = $payment->amount ? round($payment->amount / 100, 2) : 0;
        $message = "
        ========= GENERAL INFORMATION =========
        Merchant : Facts4Me, Inc.
        Date/Time : ". date('d-M-Y h:i:s', $payment->created)."
        ========= ORDER INFORMATION =========
        Description : ".$description."
        Amount : ". $amount ." (USD)
        Payment Method: ". $payment_details->card->brand." xxxx". $payment_details->card->last4."
        ============== Line Items ==============
        ============== RESULTS ==============
        Response : This transaction has been approved.
        Transaction ID : ". $payment->id."
        ==== CUSTOMER BILLING INFORMATION ===
        Customer ID : ". $data->nuserid."
        First Name : ". $data->u_f_name."
        Last Name : ". $data->u_l_name."
        Address : ". $data->addr1."
        City : ". $data->city."
        Country : ". $data->country."
        Phone : ". $data->phone."
        E-Mail : ". $data->nu_email."
        ========== METADATA =========
        nu_id : ". $data->nu_id."
        nuserid : ". $data->nuserid."
        nu_email : ".$data->nu_email. "
        nu_type : ".$data->nu_type. "
        gift_name : ".$data->gift_name. "
        gift_email : ".$data->gift_email. "
        u_psw : ".$data->u_psw. "
        s_type : ".$data->s_type. "
        t_count : ".$data->t_count. "
        grade_level : ".$data->grade_level. "
        u_f_name : ".$data->u_f_name. "
        u_l_name : ".$data->u_l_name. "
        phone : ".$data->phone. "
        school_name : ".$data->school_name. "
        addr1 : ".$data->addr1. "
        addr2 : ".$data->addr2. "
        city : ".$data->city. "
        state : ".$data->state. "
        zip : ".$data->zip. "
        country : ".$data->country. "
        start_date : ".$data->start_date. "
        payment_date : ".$data->payment_date. "
        expire_date_old : ".$data->expire_date_old. "
        expire_date_new : ".$data->expire_date_new. "
        renew : ".$data->renew. "
        ";
        $reply_email = "smorgan@facts4me.com";
        $reply_name = "Facts4Me Subscription";
        $from_addr = "send_info@facts4me.com";
        $from_name = "Facts4Me Subscription";
        $to_addr = $sent_mail;
        $cc_addr1 = "smorgan@facts4me.com";
        $cc_name1 = "Sandy";
        $to_name = $data['gift_name'] != 'None' ? $data['gift_name'] : $data['u_f_name'] . " " . $data['u_l_name'];
        $mail = new PHPMailer(); // Next we create a new object of the PHPMailer called $mail
		$mail->Mailer = 'smtp';		
        $mail->ContentType = 'text/plain';		
		// $mail->ContentType = 'text/html';		
		$mail->From = "send_info@facts4me.com"; // this is the From adress (the adress the email came from)
		$mail->FromName = "Facts4Me";
		$mail->Host = $email_host;
		$mail->Username = $email_username;
		$mail->Password = $email_password;
		$mail->SMTPAuth = true;
		$mail->AddReplyTo($reply_email, $reply_name);		
		$mail->Subject = 'Stripe Receipt'; // This is the subject  of the email message.
		$mail->Body = $message;    // This is the actual email message
		$mail->AddAddress($to_addr, $to_name);
		$mail->AddBCC($reply_email, $reply_name);		
		$mail->AddBCC($cc_addr1, $cc_name1);

        $try = $mail->Send();
        return $try;
    }
}
