<?php

namespace App\Helpers\SinchHelper;

use Illuminate\Support\Facades\DB;
use App\User;

class SinchTicketGenerator
{
    // public static $applicationKey = "37c64563-a2f6-467a-8c6f-bc7f562ba079";
    // public static $applicationSecret = "IB25MC/6/EuJOLbHAlIYNg==";

    
    public static $applicationKey = "9a5ebeec-eba8-44fe-8151-70231f4dfbc7";
    public static $applicationSecret = "5xeb+rx23kiLPApsRsKK/A==";

    public static function generateTicket($username)
    {

        $userTicket = [
            'identity' => [
                'type'      => 'username',
                'endpoint'  => $username,
            ],
            'expiresIn'         => 3600,
            'applicationKey'    => self::$applicationKey,
            'created'           => date('c'),
        ];
        $userTicketJson = preg_replace('/\s+/', '', json_encode($userTicket));

        $userTicketBase64 = self::base64Encode($userTicketJson);

        $digest = self::createDigest($userTicketJson);

        $signature = self::base64Encode($digest);

        $userTicketSigned = $userTicketBase64.':'.$signature;

        return $userTicketSigned;
    }

    private static function base64Encode($data)
    {
        return trim(base64_encode($data));
    }

    private static function createDigest($data)
    {
        return hash_hmac('sha256', $data, base64_decode(self::$applicationSecret), true);
    }
}
