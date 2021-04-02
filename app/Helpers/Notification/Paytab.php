<?php

namespace App\Helpers\Notification;



use Illuminate\Support\Facades\DB;

use App\User;

class Paytab
{
	private $merchant_email;
    private $secret_key;

 //    $merchant_email="robin.innovius@gmail.com";
	// $secret_key="Xatqp10vEoaKhB6dV1qLBRPy5AsFIanGkR6JT7fxvpiM1oZWqqH1hxzm721QcpxxgDgaKwHgWZ2Xo2UOtCQKap6is89EyGbOjsY4";    

   
    public static function authentication(){
        $obj = json_decode($this->runPost('https://www.paytabs.com/apiv2/validate_secret_key', array("merchant_email"=> $merchant_email, "secret_key"=>  $secret_key)),TRUE);
		
		if($obj->response_code == "4000"){
          return TRUE;
        }
        return FALSE;
    }
    
    public static function create_pay_page($values) {
        $values['merchant_email'] = "shahidpatel.innovius@gmail.com";
        $values['secret_key'] = "OuowHCKfQbN2xnxRiZ68O837wcReUeOJIcfqO0GFbtHIReA9dGi2Plamy2AshobZAqqpq64CAMlr1WBfDThsfsONupfLNrLoScOj";
        $values['ip_customer'] = $_SERVER['REMOTE_ADDR'];
        $values['ip_merchant'] = $_SERVER['SERVER_ADDR'];

		$fields_string = "";
        foreach ($values as $key => $value) {
            $fields_string .= $key . '=' . $value . '&';
        }
        $fields_string = rtrim($fields_string, '&');
        $ch = curl_init();
        $ip = $_SERVER['REMOTE_ADDR'];

        $ip_address = array(
            "REMOTE_ADDR" => $ip,
            "HTTP_X_FORWARDED_FOR" => $ip
        );
		curl_setopt($ch, CURLOPT_URL, 'https://www.paytabs.com/apiv2/create_pay_page');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_VERBOSE, true);
        $result = curl_exec($ch);
        curl_close($ch);
        
        return json_decode($result);
    }
    
    
    
    public static function verify_payment($payment_reference){
       	$values['merchant_email'] = $merchant_email;
        $values['secret_key'] = $secret_key;
        $values['payment_reference'] = $payment_reference;

        return json_decode($this->runPost('https://www.paytabs.com/apiv2/verify_payment', $values));
    }
    
    public function runPost($url, $fields) {
        $fields_string = "";
        foreach ($fields as $key => $value) {
            $fields_string .= $key . '=' . $value . '&';
        }
        $fields_string = rtrim($fields_string, '&');
        $ch = curl_init();
        $ip = $_SERVER['REMOTE_ADDR'];

        $ip_address = array(
            "REMOTE_ADDR" => $ip,
            "HTTP_X_FORWARDED_FOR" => $ip
        );
		curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_VERBOSE, true);

        $result = curl_exec($ch);
        curl_close($ch);
        
        return $result;
    }
}

?>

