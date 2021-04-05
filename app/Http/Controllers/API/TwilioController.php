<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Twilio\Jwt\AccessToken;
use Twilio\Jwt\Grants\ChatGrant;

class TwilioController extends Controller
{
    public function ChatCreateTokens(Request $request)
    {
        dd(auth()->user());
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
