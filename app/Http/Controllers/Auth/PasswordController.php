<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use DB;
use Auth;
use Hash;
use App\User;
use App\EmailTemplate;
use App\Notifications\MailResetPasswordNotification;
use Validator;
use Illuminate\Support\Facades\Password;

class PasswordController extends Controller
{
    public function sendPasswordResetToken(Request $request)
    {
        $user = User::where ('email', $request->email)->first();
        if ( !$user ) return redirect()->back()->withErrors(['error' => 'Email address not exists']);

        DB::table('password_resets')->where('email', $request->email)->delete();

        //create a new token to be sent to the user.
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => str_random(60), //change 60 to any length you want
            'created_at' => date('Y-m-d h:i:s')
        ]);

        $tokenData = DB::table('password_resets')
        ->where('email', $request->email)->first();

       $token = $tokenData->token;
       $email = $request->email; // or $email = $tokenData->email;

       $link = url("/password/reset/?token=" . $token);
       

       $user_roles = $user->roles()->first();
       if($user_roles->id == 4 || $user_roles->id == 6){
            $code = 5;  // Customer & Tenants
        }
        elseif($user_roles->id == 5){
            $code = 6;  // Provider
        }else{
            $code = 4;   // Admin
        }

     //  if(EmailTemplate::where('code',$code)->where('status',1)->count() > 0){
           try {
            $user->notify(new MailResetPasswordNotification($token,$user));           
           } catch (Exception $e) {
               
           }
       //}
       
       return redirect()->back()->with('status','Sent link at your email address');

    }

    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
                    'password' => 'bail|required|min:6',
                    'password_confirmation' => 'bail|required||min:6|same:password'
        ],[
                    'password_confirmation.same'=>'Confirm password and password is not matched',
        ]);
        $errors = $validator->errors();
        if ($validator->fails()) {
            return redirect()->back()
                            ->withInput($request->all())
                            ->withErrors($errors);
            exit;
        }
        
         $password = $request->password;
         $token = $request->token;
         $email=request('email');
           
         $tokenData = DB::table('password_resets')
         ->where('token', $token)->first();
       
        if($tokenData==null)
        {
            return redirect()->back()->with('danger','Reset link expired');
        }
        $user = User::where('email', $tokenData->email)->first();
        if($email==$user->email)
        {
             $user->password = Hash::make($password);
             $user->update();              
             Auth::login($user);
             DB::table('password_resets')->where('email', $user->email)->delete();            
             return redirect()->route('logout')->with('success','Password Changed Successfully');
        }
        else
        {
            return redirect()->back()->with('danger','Email is invalid');
        }
    }

    public function showPasswordResetForm($token)
    {
        return view('auth.passwords.reset',['token'=>$token]);
    }

    public function broker()
    {
        return Password::broker('sellers');
    }
}
