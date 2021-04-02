<?php
namespace App\Helpers\Notification;

use Illuminate\Support\Facades\DB;
use App\User;

class SmsAla
{
	
		
	public static function SendSms($number,$message,$countrycode)
    {
        $countrycode=isset($countrycode)?$countrycode:'92';
        
        $fields = array(
                'api_id'=>'API229794177915',
                'api_password'=>'eclinic@123123',
                'phonenumber' =>$countrycode.$number,
                'textmessage' => $message,
                'sms_type'=>'T',
                'encoding'=>'T',
                'sender_id'=>'AskUrDr'
                
            );
        // 'sender_id'=>'TSTALA'
        $headers = array(
        //         'Authorization: key=AAAARdcQZVA:APA91bGH-tG2aWuKr2kdTY7EoHISqqZ8I9vFtM8iHOqmev2XwKrSKXRyq9oGYtXq6MHUbqPQjXZyLO5THpb2bALeCpp3wN6zVmxRiJengvKhPdJimyeTGuhKBz-cyjRsNEL7qBNTBj0r',
                 'Content-Type: application/json'
             );
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://api.smsala.com/api/SendSMS');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
			
}

?>
