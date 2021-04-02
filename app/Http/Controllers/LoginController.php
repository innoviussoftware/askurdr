<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = 'admin/home';

       

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function authenticated(Request $request)
    {
        // if (Auth::attempt(['username' => $request->email, 'password' => $request->password])) {
        //     // Authentication passed...
        //     $user = User::find(Auth::user()->id);
        //     if ($user->roles()->first()->id == '1' || $user->roles()->first()->id == '2' || $user->roles()->first()->id == '3') {
        //         $user->logged_in_ip = $_SERVER['REMOTE_ADDR'];
        //         $user->save();
        //         return redirect($this->redirectTo);
        //     } else {
        //         Auth::logout();
        //         return redirect('/');
        //     }
        // }
        
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = User::find(Auth::user()->id);
            
            // if ($user->roles()->first()->id != '4' || $user->roles()->first()->id != '5' || $user->roles()->first()->id != '6'){
            
            if ($user->roles()->first()->id == '1'){
                return redirect($this->redirectTo);
            }else{
                Auth::logout();
                return redirect('/');
            }
        } else {
            $this->guard()->logout();
            $request->session()->flush();
            $request->session()->regenerate();
            return $this->sendFailedLoginResponse($request);
        }
    }


    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        $field = $this->field($request);

        return [
            $field => $request->get($this->username()),
            'password' => $request->get('password'),
            'status' => '1',
        ];
    }

    /**
     * Determine if the request field is email or username.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    public function field(Request $request)
    {
        $email = $this->username();
        return filter_var($request->get($email), FILTER_VALIDATE_EMAIL) ? $email : 'username';
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateLogin(Request $request)
    {
        $field = $this->field($request);
        //$messages = ["{$this->username()}.exists" => trans('form_errors.account_activation_msg')];
        $messages = ['email.required' => 'Please enter email address',
                    'password.required' => 'Please enter password'];
        

        $this->validate($request, [
            $this->username() => "required|exists:users,{$field},status,1",
            'password' => 'required',
        ], $messages);
    }
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }
}
