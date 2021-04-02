<?php



namespace App\Helpers\Notification;



use Illuminate\Support\Facades\DB;

use App\User;



class PushNotification

{

    public static function SendPushNotification($msg, $data, $device_ids)

    {

        $fields = array(

                'registration_ids' => $device_ids,

                'data' => $data,

                'notification' => $msg,

                'content_available' => true,

            );

         // $headers = array(

         //        'Authorization: key=AAAARdcQZVA:APA91bGH-tG2aWuKr2kdTY7EoHISqqZ8I9vFtM8iHOqmev2XwKrSKXRyq9oGYtXq6MHUbqPQjXZyLO5THpb2bALeCpp3wN6zVmxRiJengvKhPdJimyeTGuhKBz-cyjRsNEL7qBNTBj0r',

         //        'Content-Type: application/json'

         //    );

        $headers = array(

                'Authorization: key=AAAAdxV2YRs:APA91bER0F1UPnLvPOGjQVm-N_4XWm-5cQfu40Qh-5iC9rxCgR3KeqrJG8pnu4_aqjnd6dp-g_NfEzC99PODZhrqxg6QZ2FB8_QWDo_dmejcnZeOh-muhXsl6OHYVW10T2Z5ljmkSERL',

                'Content-Type: application/json'

            );

        

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');

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

