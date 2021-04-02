<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Helpers\Notification\SmsAla;
use App\User;
use Hash;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    const SUCCESS = 'success';

    

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {

        
        // try {
        //     $username = User::where('email', $request->national_id)->first();
        //     // dd($username->mobile);
        //     $message = "Your password is : 123456789";
        //     $user = User::whereId($user->id)->update([
        //                 'password' => Hash::make('123456789')
        //             ]);
        //     //$country_code = '+966';
        //     $country_code = $username->countrycode;
        //     $mobileno = $username->mobile;
        //     $pp = SmsALa::SendSms($mobileno,$message,$country_code);
        //     // dd($pp);
        //     // $user->notify(new MailResetPasswordNotification($token, $user));
        // } catch (Exception $e) {
        
        // }
        
        $this->middleware('guest');
    }

    public function sendemail(Request $request)
    {
        $username = User::where('email', $request->email)->first();

        if($username)
        {
            $message = "Your password is : 123456789";
            $user = User::whereId($username->id)->update([
                       'password' => Hash::make('123456789')
            ]);
            $country_code = $username->countrycode;
            $mobileno = $username->mobile;
            $pp = SmsALa::SendSms($mobileno,$message,$country_code);
            $success='Reset password sent to the register mobile';

                    return redirect()->back()
                    ->with(self::SUCCESS, 'Reset password sent to the register mobile');
        }else
        {
            $errors = 'National id does not exists!';
            return redirect()->back()
                    ->withInput($request->all())
                    ->withErrors($errors);
        }
    }

      public function __invoke(Request $request)
    {
       dd('here'); 
        // $this->validateEmail($request);
        // // We will send the password reset link to this user. Once we have attempted
        // // to send the link, we will examine the response then see the message we
        // // need to show to the user. Finally, we'll send out a proper response.
        // $response = $this->broker()->sendResetLink(
        //     $request->only('email')
        // );
        
        // return $response == Password::RESET_LINK_SENT
        //     ? response()->json(['success' => 'Reset link sent to your email.'], 200)
        //     : response()->json(['error' => 'Unable to send reset link'], 401);
    }
}
