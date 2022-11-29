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
use Stripe\Stripe as Striper;
use Stripe\Checkout\Session as StriperSession;

class PaymentModel extends Base 
{ 
    // Write your code here
    public function edit_date($date_in)
    {
        $date_out = "ERROR";
        $err_flag = "N";

        $temp = explode('/', $date_in);
        $mm = $temp[0];
        $dd = $temp[1];
        $yy = $temp[2];
        if (strlen($mm) > 2)   //  assume date in yyyy-mm-dd format
        {
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
        }
        if (strlen($mm) == 0)
        {
            $err_flag = "Y";
        }
        elseif (strlen($mm) > 2)
        {
            $err_flag = "Y";
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
        // echo "<br>3 date_out:*$date_out* mm:*$mm*" . strlen($mm) ."*  dd:*$dd*" .strlen($dd) . "*  yy:*$yy*  date in:*$date_in*\n";
        }
        elseif (strlen($dd) > 2)
        {
            $err_flag = "Y";
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

        return $date_out;
    }

    public function hmac ($key, $data)
    {
        if( phpversion() >= '5.1.2' )
        { 
            $fingerprint_1 = hash_hmac("md5", $data, $key); 
        }
        else 
        { 
            $fingerprint_1 = bin2hex(mhash(MHASH_MD5, $data, $key)); 
        }
        return ($fingerprint_1);
    }

    public function paymentInit($name, $amount, $current_code, $data = [])
    {
        $amount = round($amount*100,2);
        $secret_key = $this->OptionModel->get('stripe_secret_key', '');
        Striper::setApiKey($secret_key);
        try 
        { 
            $item = [
                'line_items' => [
                    [
                        'price_data' => [ 
                            'product_data' => [ 
                                'name' => $name, 
                                'description' => $name,
                            ], 
                            'unit_amount' => $amount, 
                            'currency' => $current_code, 
                        ],
                        'quantity' => 1, 
                    ]
                ], 
                'mode' => 'payment',
                'metadata' => [ 
                ], 
                'success_url' => $this->router->url('payment').'?sessionId={CHECKOUT_SESSION_ID}', 
                'cancel_url' => $this->router->url(), 
                // 'receipt_email' => 'smpdebug1@gmail.com',
            ];
            foreach($data as $key => $value)
            {
                $item['metadata'][$key] = $value;
            }

            $checkout_session = StriperSession::create($item); 
        } 
        catch(\Exception $e) 
        {  
            $api_error = $e->getMessage();  
        }
         
        if(empty($api_error) && $checkout_session){ 
            return [
                'status' => 1, 
                'message' => 'Checkout Session created successfully!', 
                'sessionId' => $checkout_session->id 
            ]; 
        }else{
            return array( 
                'status' => 0, 
                'error' => array( 
                    'message' => 'Checkout Session creation failed! '.$api_error    
                ) 
            ); 
        }
    }

    public function getLogPayment($payment, $data, $payment_details)
    {
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

        return $message;
    }
}
