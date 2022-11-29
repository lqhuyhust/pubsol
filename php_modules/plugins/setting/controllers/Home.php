<?php

/**
 * SPT software - homeController
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a basic controller
 * 
 */

namespace App\plugins\setting\controllers;

use SPT\MVC\JDIContainer\MVController;
use PHPMailer\PHPMailer\PHPMailer;

class Home extends MVController
{
    public function home()
    {
        if ($this->islogged()) {
            $this->app->redirect(
                $this->router->url('facts_users')
            );
        }
        // write your code here
        $this->app->set('format', 'html');
        $this->app->set('layout', 'frontend.home');
    }

    public function gate()
    {
        if ($this->islogged()) {
            $this->app->redirect(
                $this->router->url('facts_users')
            );
        }
        // write your code here
        $this->app->set('format', 'html');
        $this->app->set('layout', 'frontend.login');
    }

    public function login()
    {
        // write your code here
        if ($this->islogged()) {
            $this->app->redirect(
                $this->router->url('facts_users')
            );
        }

        // check login ip_addr
        $ip_addr = $this->request->post->get('ip_addr', '', 'string');
        $user_ip_login = $this->IPLoginEntity->findOne(['ip_addr' => $ip_addr]);
        $user_id = $user_ip_login ? $user_ip_login['u_id'] : 0;
        $user = $this->UserEntity->findByPK($user_id);
        $token = $this->request->post->get('token', '', 'string');
        $try = $this->app->validateToken($token);
        if ($user && $try && $user['u_type'] == 'view' && ($user['s_type'] == 'school' || $user['s_type'] = 'extended_school'))
        {
            $result = $this->user->login(
                $user['userid'],
                '',
                true
            );
            if ($result) {
                $this->app->redirect(
                    $this->router->url('facts_users')
                );
            } else {
                $this->session->set('flashMsg', 'Username or Password is NOT a valid!');
                $this->app->redirect(
                    $this->router->url('login')
                );
            }
        }
    
        $result = $this->user->login(
            $this->request->post->get('username', '', 'string'),
            $this->request->post->get('pass', '', 'string')
        );

        if ($result) {
            $this->app->redirect(
                $this->router->url('facts_users')
            );
        } else {
            $this->session->set('flashMsg', 'Username or Password is NOT a valid!');
            $this->app->redirect(
                $this->router->url('login')
            );
        }
    }

    public function islogged()
    {
        if ($this->user->get('u_id')) {
            return true;
        }
        return false;
    }

    public function about()
    {
        $this->app->set('format', 'html');
        $this->app->set('layout', 'frontend.about');
    }

    public function terms()
    {
        $this->app->set('format', 'html');
        $this->app->set('layout', 'frontend.terms');
    }

    public function contact()
    {
        $this->app->set('format', 'html');
        $this->app->set('layout', 'frontend.contact');
    }

    public function tellFriend()
    {
        $this->app->set('format', 'html');
        $this->app->set('layout', 'frontend.tell_friend');
    }

    public function tellFriend_mail()
    {
        $token = $this->request->post->get('token', '', 'string');
        if (!$this->app->validateToken($token)) {
            $this->app->redirect($this->router->url());
            exit();
        }
        $from_name = $this->request->post->get('from_name', '', 'string');
        $from_email = $this->request->post->get('from_email', '', 'string');
        $to_email = $this->request->post->get('to_email', '', 'string');
        $c_cont_notes = stripslashes(trim($this->request->post->get('cont_notes', '', 'string')));
        $special_chars_email = array('\'', '/', '\\', '`', ';', '[',  ']', '&', '^', '%', '$', '#', '~', '(', ')', '|', '{', '}', '<', '>', ':', '"', '=');
        $len = strlen($c_cont_notes);
        $c_cont_notes = str_replace($special_chars_email, '', $c_cont_notes);
        if (strlen($c_cont_notes) != $len) {
            $err_msg = " - Found chatacters that are not valid for this message";
            $err_flg = "ERROR";
        }

        if ($err_flg != "ERROR") {
            if (strlen($from_name) < 3) {
                $err_msg .= '<br>A name MUST be specified!';
                $err_flg = "ERROR";
            }

            if (strlen($from_email) < 8) {
                $err_msg .= '<br>A from email address MUST be specified!';
                $err_flg = "ERROR";
            } elseif (!$this->EmailModel->email_check($from_email)) {
                $err_msg .= '<br>A valid from email address MUST be specified!';
                $err_flg = "ERROR";
            }

            if (strlen($to_email) < 8) {
                $err_msg .= '<br>A to email address MUST be specified!';
                $err_flg = "ERROR";
            } elseif (!$this->EmailModel->email_check($to_email)) {
                $err_msg .= '<br>A valid to email address MUST be specified!';
                $err_flg = "ERROR";
            }
            $this->session->set('after_submit', true);

            if ($err_flg != "ERROR") {
                $bcc_addr = "joeb648@comcast.net";
                // $bcc_addr = "jborsche@comcast.net";
                $to_addr = $to_email;
                $subject = "Check out the Facts 4 Me web site";
                $message = "$c_cont_notes\n\n";
                $id_email = $this->OptionModel->get('tmp_tell_friend', '');
                $email_tmp = $this->EmailTmpEntity->findByPK($id_email);
                if ($email_tmp) {
                    $message = $email_tmp['e_tmp'];
                    $subject = $email_tmp['e_sub'];

                    $message = str_replace("%c_cont_notes%", $c_cont_notes, $message);
                    $subject = str_replace("%c_cont_notes%", $c_cont_notes, $subject);
                }
                $reply_email = $from_email;
                $reply_name = $from_name;
                $from_addr = "send_info@facts4me.com";
                $from_name = $from_name;

                $mail = new PHPMailer(); // Next we create a new object of the PHPMailer called $mail
                $mail->Mailer = 'smtp';
                $mail->ContentType = 'text/html';
                $mail->From = "send_info@facts4me.com"; // this is the From adress (the adress the email came from)
                $mail->FromName = "Facts4Me";
                $mail->Host = $this->OptionModel->get('email_host', '');
                $mail->Username = $this->OptionModel->get('email_username', '');
                $mail->Password = $this->OptionModel->get('email_password', '');
                $mail->SMTPAuth = true;
                $mail->AddReplyTo($reply_email, $reply_name);
                $mail->Subject = $subject; // This is the subject  of the email message.
                $mail->Body = $message;
                $mail->AddBCC($reply_email, $reply_name);
                $mail->AddAddress($to_addr);

                $try = $mail->Send();
                // $mail->AddBCC($reply_email, $reply_name);		
                $this->session->set('send_mail', $try);
                $this->session->set('to_email', $to_email);
                $this->session->set('from_email', $from_email);
                if (!$try) {
                    $this->session->set('mail_error', $mail->ErrorInfo);
                }

                $this->session->set('err_flg', $err_flg);
                $this->session->set('err_msg', $err_msg);
            }
        }
        $this->app->redirect($this->router->url('tell_friend'));
    }

    public function visitor()
    {
        $this->app->set('format', 'html');
        $this->app->set('layout', 'frontend.visitor');
    }

    public function sub()
    {
        $this->app->set('format', 'html');
        $this->app->set('layout', 'frontend.sub');
    }

    public function renew()
    {
        $this->app->set('format', 'html');
        $this->app->set('layout', 'frontend.renew');
    }

    public function topic_list()
    {
        $this->app->set('format', 'html');
        $this->app->set('page', 'topic');
        $this->app->set('layout', 'frontend.topic_list');
    }

    public function topics()
    {
        $this->app->set('format', 'html');
        $this->app->set('layout', 'frontend.topics');
        $this->app->set('page', 'topic');
    }

    public function disp_subject()
    {
        $this->app->set('format', 'html');
        $this->app->set('layout', 'frontend.disp_subject');
        $this->app->set('page', 'topic');
    }

    public function facts_users()
    {
        $this->app->set('format', 'html');
        $this->app->set('layout', 'frontend.facts_user');
        $this->app->set('page', 'facts_user');
    }

    public function logout()
    {
        $this->user->logout();
        $this->app->redirect(
            $this->router->url()
        );
    }

    public function contact_mail()
    {
        // invalid token
        $token = $this->request->post->get('token', '', 'string');
        if (!$this->app->validateToken($token)) {
            $this->app->redirect($this->router->url());
            exit();
        }
        $c_name = $this->request->post->get('name', '', 'string');
        $c_email = $this->request->post->get('email', '', 'string');
        $c_phone = $this->request->post->get('phone', '', 'string');
        $school_name = $this->request->post->get('school_name', '', 'string');
        $c_addr1 = $this->request->post->get('addr1', '', 'string');
        $c_addr2 = $this->request->post->get('addr2', '', 'string');
        $c_city = $this->request->post->get('city', '', 'string');
        $c_state = $this->request->post->get('state', '', 'string');
        $c_zip = $this->request->post->get('zip', '', 'string');
        $c_ck_num = trim($this->request->post->get('ck_num', '', 'string'));
        $c_num = trim($this->request->post->get('my_num', '', 'string'));
        $c_how = $this->request->post->get('howfound', '', 'string');
        $c_cont_notes = $this->request->post->get('cont_notes', '', 'string');
        
        $c_cont_notes = stripslashes($c_cont_notes);
        $err_msg = "";

        if (strlen($c_name) < 3) {
            $err_msg = '<br>A name MUST be specified!';
            $err_flg = "ERROR";
        }

        if (stristr($c_cont_notes, '<a ') === FALSE) {
        } else {
            $err_msg .= '<br>Invalid information in comment section';
            $err_flg = "ERROR";
        }

        if (!$this->EmailModel->email_check($c_email)) {
            $err_msg .= '<br>A valid Email address MUST be specified!';
            $err_flg = "ERROR";
        }

        if (strlen($c_email) < 8) {
            $err_msg .= '<br>An email address MUST be specified!';
            $err_flg = "ERROR";
        }

        if ($c_num != $c_ck_num) {
            $err_msg .= '<br>The key value specified does not match!';
            $err_flg = "ERROR";
        }
        $this->session->set('name', $c_name);
        $this->session->set('email', $c_email);
        $this->session->set('addr1', $c_addr1);
        $this->session->set('school_name', $school_name);
        $this->session->set('addr2', $c_addr2);
        $this->session->set('zip', $c_zip);
        $this->session->set('state', $c_state);
        $this->session->set('city', $c_city);
        $this->session->set('howfound', $c_how);
        $this->session->set('cont_notes', $c_cont_notes);

        $bcc_addr1 = "jborsche@comcast.net";
        $to_addr = "info@facts4me.com";
        $cc_addr1 = "$c_email";
        $reply_to = "$c_email";
        $sub = "Facts4me Information Request";
        $hdr = "Reply-To: $reply_to \r\n" . "bcc: $bcc_addr1 \r\n" . "From: $c_email";
        $id_email = $this->OptionModel->get('tmp_contact', '');
        $email_tmp = $this->EmailTmpEntity->findByPK($id_email);
        if ($email_tmp) {
            $body = $email_tmp['e_tmp'];
            $sub = $email_tmp['e_sub'];

            if ($c_name) {
                $body = str_replace("%c_name%", $c_name, $body);
                $sub = str_replace("%c_name%", $c_name, $sub);
            }

            if ($c_email) {
                $body = str_replace("%c_email%", $c_email, $body);
                $sub = str_replace("%c_email%", $c_email, $sub);
            }

            if ($school_name) {
                $body = str_replace("%school_name%", $school_name, $body);
                $sub = str_replace("%school_name%", $school_name, $sub);
            }

            if ($c_addr1) {
                $body = str_replace("%c_addr1%", $c_addr1, $body);
                $sub = str_replace("%c_addr1%", $c_addr1, $sub);
            }

            if ($c_addr2) {
                $body = str_replace("%c_addr2%", $c_addr2, $body);
                $sub = str_replace("%c_addr2%", $c_addr2, $sub);
            }

            if ($c_zip) {
                $body = str_replace("%c_zip%", $c_zip, $body);
                $sub = str_replace("%c_zip%", $c_zip, $sub);
            }

            if ($c_state) {
                $body = str_replace("%c_state%", $c_state, $body);
                $sub = str_replace("%c_state%", $c_state, $sub);
            }

            if ($c_city) {
                $body = str_replace("%c_city%", $c_city, $body);
                $sub = str_replace("%c_city%", $c_city, $sub);
            }

            if ($c_how) {
                $body = str_replace("%c_how%", $c_how, $body);
                $sub = str_replace("%c_how%", $c_how, $sub);
            }

            $body = str_replace("%c_cont_notes%", $c_cont_notes, $body);
            $sub = str_replace("%c_cont_notes%", $c_cont_notes, $sub);
        } else {
            $body = "\n"
                . "\nInformation about Facts 4 Me has been requested by $c_name \n"
                . "the following information was entered on the contact form:\n\n"
                . "Name: $c_name\n"
                . "Email Address: $c_email\n"
                . "Address: $c_addr1\n"
                . "         $c_addr2\n"
                . "         $c_city, $c_state  $c_zip\n\n"
                //        . "Phone number: $c_phone\n\n"
                . "Found web site by: $c_how\n\n"
                . "The following information or question was entered:\n"
                . "$c_cont_notes\n"
                . "\n";
        }

        $bcc_addr1 = "None";
        $bcc_name1 = "None";
        $reply_email = $c_email;
        $reply_name = $c_name;
        $email_receive = $this->OptionModel->get('email_receive', '');
        $to_addr = $email_receive ? $email_receive : $this->config->to_addr ;
        $to_name = "Facts4Me";
        // Create php mailer
        $mail = new PHPMailer(); // Next we create a new object of the PHPMailer called $mail
        $mail->Mailer = 'smtp';
        $mail->ContentType = 'text/html';
        $mail->From = "send_info@facts4me.com"; // this is the From adress (the adress the email came from)
        $mail->FromName = "Facts4Me";
        $mail->Host = $this->OptionModel->get('email_host', '');
        $mail->Username = $this->OptionModel->get('email_username', '');
        $mail->Password = $this->OptionModel->get('email_password', '');
        $mail->SMTPAuth = true;
        $mail->AddReplyTo($reply_email, $reply_name);
        $mail->Subject = $sub; // This is the subject  of the email message.
        $mail->Body = $body;    // This is the actual email message

        if ($bcc_addr1 != "None") {
            $mail->AddBCC($bcc_addr1, $bcc_name1);
        }
        $mail->AddAddress($to_addr, $to_name);

        $try = $mail->Send();
        // $mail->AddBCC($reply_email, $reply_name);		
        $this->session->set('send_mail', $try);
        $this->session->set('c_email', $c_email);
        $this->session->set('after_submit', true);
        if (!$try) {
            $this->session->set('mail_error', $mail->ErrorInfo);
        }

        $this->session->set('err_flg', $err_flg);
        $this->session->set('err_msg', $err_msg);

        $this->app->redirect($this->router->url('contact'));
    }
}
