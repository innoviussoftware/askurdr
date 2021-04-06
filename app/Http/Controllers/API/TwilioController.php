<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Twilio\Jwt\AccessToken;
use Twilio\Jwt\Grants\ChatGrant;
use Twilio\Jwt\Grants\VideoGrant;
use Illuminate\Support\Facades\Validator;


class TwilioController extends Controller
{
    
    public function generate_token(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'identity'=>'required',
            'room_name'=>'required'
          ]);
  
          if ($validator->fails()) {
              $errorMessage = implode(',', $validator->errors()->all());
              return response()->json(['errors' => $errorMessage], 422);
          }
        $accountSid = 'ACc854bb7e38224443be49cbb9e321856f';
        $apiKeySid = 'SK718fb7ab87c330a9929d7b5295974c0e';
        $apiKeySecret = 'L0QF7nOA6jTiVpJYoUvxUJhG82Xyitli';
        /*
        $accountSid = ('TWILIO_ACCOUNT_SID');
        $apiKeySid = ('TWILIO_API_KEY');
        $apiKeySecret = ('TWILIO_API_SECRET');
        */
        $identity = $request->identity;
        $room_name = $request->room_name;

         // Create an Access Token
        $token = new AccessToken(
        $accountSid,
        $apiKeySid,
        $apiKeySecret,
        3600,
        $identity,
        $room_name
        );

        // Grant access to Video
        $grant = new VideoGrant();
        $grant->setRoom($room_name);
        $token->addGrant($grant);

        // Serialize the token as a JWT
        /*
        $result=[ 
            "identity" => $identity,
            "token"=> $token->toJWT()
        ];
        return response()->json($result);
        */
        $response = ["identity"=>$identity,"token"=>$token->toJWT()];
        return response()->json($response, 200);
        
    }
    public function ChatCreateTokens(Request $request)
    {
        // Required for all Twilio access tokens
        $twilioAccountSid = 'ACc854bb7e38224443be49cbb9e321856f';
        $twilioApiKey = 'SK718fb7ab87c330a9929d7b5295974c0e';
        $twilioApiSecret = 'L0QF7nOA6jTiVpJYoUvxUJhG82Xyitli';

        // Required for Chat grant
        $serviceSid = 'IS7817abb9355f4082b88d7df67e2d1f2e';
        // choose a random username for the connecting user
        $identity = "john_doe";

        // Create access token, which we will serialize and send to the client
        $token = new AccessToken(
            $twilioAccountSid,
            $twilioApiKey,
            $twilioApiSecret,
            3600,
            $identity
        );

        // Create Chat grant
        $chatGrant = new ChatGrant();
        $chatGrant->setServiceSid($serviceSid);

        // Add grant to token
        $token->addGrant($chatGrant);

        // render token to string
        $response = ['token'=>$token->toJWT()];
        return response()->json($response, 200);
    }
}
