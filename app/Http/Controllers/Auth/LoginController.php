<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;
use App\DoctorAvailability;
use Lang;

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

    protected $redirectfront = 'front/index';
       

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
       
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = User::find(Auth::user()->id);
            
            if ($user->roles()->first()->id == '1' || $user->roles()->first()->id == '6'){
                return redirect($this->redirectTo);
            }
            // elseif($user->roles()->first()->id == '3' ||$user->roles()->first()->id == '2'){
            elseif($user->roles()->first()->id == '2'){
                $previous_session = $user->session_id;
                if ($previous_session) {
                    \Session::getHandler()->destroy($previous_session);
                }

                Auth::user()->session_id = \Session::getId();
                Auth::user()->device_id = '';
                Auth::user()->save();
                $userTokens = $user->tokens;
                    foreach($userTokens as $token) {
                       // $token->revoke();
                        $token->delete();
                    }
                $user->token = $user->createToken('MyApp')->accessToken;
                DoctorAvailability::where('patient_id',Auth::user()->id)->orWhere('doctor_id',Auth::user()->id)->update(['status'=>'0']);
                return redirect($this->redirectfront);
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

    public function sendFailedLoginResponse(Request $request) {
        
        return redirect()->back()
                        ->withInput($request->only($this->username(), 'remember'))
                        ->withErrors([
                            $this->username() => Lang::get('auth.failed'),
        ]);

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
        // dd($request->get($email));

        // return filter_var($request->get($email), FILTER_VALIDATE_EMAIL) ? $email : 'username';
        return $request->get($email) ? $email : 'username';
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
        $messages = ["{$this->username()}.exists" => trans('auth.exists')];

        $this->validate($request, [
            $this->username() => "required|exists:users,{$field},status,1",
            'password' => 'required',
        ], $messages);
    }
    public function logout(Request $request)
    {
        $sender_id = auth()->user()->id;

        $da=DoctorAvailability::where('patient_id',$sender_id)->orWhere('doctor_id',$sender_id)->update(['status'=>'1']);
        
        Auth::logout();
        
        return redirect('/');
    }
}
