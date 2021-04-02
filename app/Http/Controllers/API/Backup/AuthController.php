<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Hash;
use Validator;
use App\User;
use App\Role;
use App\Clinic;
use App\DocumentType;
use App\DoctorAvailability;
use App\Speciality;
use App\Language;
use App\MasterAdminSetting;
use App\Medicine;
use App\Investigation;
use App\Notification;
use App\Paymentplan;
use App\Payment_details;
use App\Messages;
use App\Testregister;
use App\DoctorClinic;
use DB;

use Carbon\Carbon;
use App\Notifications\WelcomeUser;
use App\Notifications\Activation;
use App\Notifications\MailResetPasswordNotification;
use App\Helpers\Notification\SmsAla;
use App\Helpers\Notification\ICD_API_Client;
use Laravel\Passport\Token;
use App\DoctorSpeciality;
use App\DoctorLanguage;
use App\Chathistory;
use App\Chat;
use App\Payment_history;


class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Auth Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application.
    | The controller uses a trait to conveniently provide its functionality to
    | your applications.
    */

    public function Login(Request $request)
    {
        
        if(request('language') == 'ar'){
            $validator = Validator::make($request->all(), [
                'nationalid'=>'required',
                'password'=>'required',
                'device_id'  => 'required',
              // 'language'  => 'required',
            ],
            [
                'nationalid.required'=>'الحقل الوطني مطلوب',
                'password.required'=>'حقل كلمة المرور مطلوب',
                'device_id.required'=>'حقل معرف الجهاز مطلوب.'
            ]);
        }else{
            $validator = Validator::make($request->all(), [
              'nationalid'=>'required',
              'password'=>'required',
              'device_id'  => 'required',
              // 'language'  => 'required',
            ],
            [
                'nationalid.required'=>'The nationalid field is required.',
                'password.required'=>'The password field is required.',
                'device_id.required'=>'The device id field is required.'
            ]);
        }

        if ($validator->fails()) {
            $errorMessage = implode(',', $validator->errors()->all());
            return response()->json(['errors' => $errorMessage], 422);
        } else {
            if (Auth::attempt(['email' => request('nationalid'), 'password' => request('password')])) {
                $user = Auth::user();
                $role = $user->roles->first()->name;
                    if ($user->status == 0) {
                        return response()->json(['errors'=>'The account you are trying to login is not activated or it has been removed.'], 422);
                    }
                    if ($role == 'admin' && $role == 'pharmacy' && $role == 'labs') {
                         return response()->json(['errors'=>'The account you are trying to login is not exists.'], 422);   
                    }
                    if ($role == 'patient') 
                    {
                        $role = 'patient';
                        $doctor_available = DoctorAvailability::where('patient_id',$user->id)->first();  
                        if($doctor_available == null)
                        {
                                $da = DoctorAvailability::create([
                                        'patient_id' => $user->id,
                                        'status' => 0]);
                                // $user->patientavailability;                   
                        }
                        else
                        {
                                $doctor_available = DoctorAvailability::where('patient_id',$user->id)->update(['status'=>0]);
                                // $user->patientavailability;
                        }
                    }
                    if ($role == 'doctor') 
                    {
                        $role = 'doctor';
                        $doctor_available = DoctorAvailability::where('doctor_id',$user->id)->first();  
                        if($doctor_available == null)//if doesn't exist: create
                        {
                                $da = DoctorAvailability::create([
                                        'doctor_id' => $user->id,
                                        'status' => 0
                                ]);    
                                // $user->doctoravailability;                   
                        }
                        else
                        {
                                $doctor_available = DoctorAvailability::where('doctor_id',$user->id)->update(['status'=>0]);
                                $user->doctoravailability;
                        }
                    }
                    unset($user->roles);
                    $user->role = $role;
                    if(request('language') == 'ar'){
                       $user->first_name = $user->ar_first_name;
                    }
                    $userTokens = $user->tokens;
                    foreach ($userTokens as $token) {
                        // $token->revoke();
                        $token->delete();
                    }
                    $user->token = $user->createToken('MyApp')->accessToken;
                    $user_update = User::whereId($user->id)->update(['device_id'=>request('device_id')]);
                    $user->device_id = request('device_id');

                    // if(isset($user->token))
                    // {
                    //     if($user->token!=$user->device_id)
                    //     {
                    //         return response()->json(['errors' => 'Invalid Token.'],208);
                    //     }    
                    // }
                    
                    return response()->json(['data'=>$user], 200);
            } else {
                if(request('language') == 'ar'){
                 return response()->json(['errors'=>'الرقم القومي أو كلمة المرور غير صالحة'], 422);       
                }
                return response()->json(['errors'=>'National id or password is invalid.'], 422);
            }
        }
    }

    /* New Login Api*/
     public function NewLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
          'email'=>'required|email',
          'password'=>'required',
          'device_id'  => 'required',
        ]);

        if ($validator->fails()) {
            $errorMessage = implode(',', $validator->errors()->all());
            return response()->json(['errors' => $errorMessage], 422);
        } else {
            if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
                $user = Auth::user();
                $role = $user->roles->first()->name;

                    if ($user->status == 0) {
                        return response()->json(['errors'=>'The account you are trying to login is not activated or it has been removed.'], 422);
                    }

                    if ($role == 'admin' && $role == 'pharmacy' && $role == 'labs') {
                         return response()->json(['errors'=>'The account you are trying to login is not exists.'], 422);   
                    }

                    if ($role == 'patient') 
                    {
                        $role = 'patient';
                        $doctor_available = DoctorAvailability::where('patient_id',$user->id)->first();  
                        if($doctor_available == null)
                        {
                                $da = DoctorAvailability::create([
                                        'patient_id' => $user->id,
                                        'status' => 0]);   
                                $user->patientavailability;                   
                        }
                        else
                        {
                                $doctor_available = DoctorAvailability::where('patient_id',$user->id)->update(['status'=>0]);
                                $user->patientavailability;
                        }
                    }
                    if ($role == 'doctor') 
                    {
                        $role = 'doctor';
                        $doctor_available = DoctorAvailability::where('doctor_id',$user->id)->first();  
                        if($doctor_available == null)//if doesn't exist: create
                        {
                                $da = DoctorAvailability::create([
                                        'doctor_id' => $user->id,
                                        'status' => 0
                                ]);    
                                $user->doctoravailability;                   
                        }
                        else
                        {
                                $doctor_available = DoctorAvailability::where('doctor_id',$user->id)->update(['status'=>0]);
                                $user->doctoravailability;
                        }
                    }
                    unset($user->roles);
                    $user->role = $role;
                    $user->token = $user->createToken('MyApp')->accessToken;
                    $user_update = User::whereId($user->id)->update(['device_id'=>request('device_id')]);
                    $user->device_id = request('device_id');
                    
                    // if(isset($user->token))
                    // {
                    //     if($user->token!=$user->device_id)
                    //     {
                    //         return response()->json(['errors' => 'Invalid Token.'],208);
                    //     }    
                    // }
                    
                    return response()->json(['data'=>$user], 200);
            } else {
                return response()->json(['errors'=>'Email or password is invalid.'], 422);
            }
        }
    }

    public function SendOtp(Request $request)

    {
        if(request('language') == 'ar'){

            $validator = Validator::make(array_map('trim', $request->all()), [
              'country_code'=>'required|numeric',
              'mobile'  => 'required|numeric|regex:/([0-9])+/'
            ],
            [
                'country_code.required'=>'أدخل رمز البلد',
                'country_code.numeric'=>'أدخل رقم رمز البلد',
                'mobile.required'=>'أدخل رقم الجوال',
                'mobile.regex'=>'الرجاء إدخال رقم',
                'mobile.numeric'=>'أدخل رقم الجوال'
            ]);
        }else{
            $validator = Validator::make(array_map('trim', $request->all()), [
              'country_code'=>'required|numeric',
              'mobile'  => 'required|numeric|regex:/([0-9])+/'
            ],
            [
                'country_code.required'=>'Enter the country code.',
                'country_code.numeric'=>'Enter the country code number',
                'mobile.required'=>'Enter the mobile number.',
                'mobile.regex'=>'please enter digit number',
                'mobile.numeric'=>'Enter the mobile number.'
            ]);
        }
        if ($validator->fails()) {
            $errorMessage = implode(',', $validator->errors()->all());
            return response()->json(['errors' => $errorMessage], 422);
        } else {
            // dd("ASdds");    
            $otp = rand(1000, 9999);
            $is_exist = User::where('mobile', request('mobile'))->where('status', 1)->count();
            if($is_exist > 0){
                $data['is_exist'] = 1;
                $data['otp'] = $otp;
                error_reporting(E_ERROR | E_WARNING | E_PARSE);
                $message = 'Your One Time Password for Askurdr is '.$otp;
                // $mobileno = request('mobile');
                $country_code = request('country_code');
                // $country_code = +91;
                $mobileno = request('mobile');
                $pp = SmsALa::SendSms($mobileno,$message,$country_code);
                return response()->json(['data' => $data], 200);
            }
            // echo "ASDasd";exit;
            $data['is_exist'] = 0;
            $data['otp'] = $otp;
            $mobile = request('country_code').request('mobile');
            //Send OTP
            error_reporting(E_ERROR | E_WARNING | E_PARSE);
            $message = 'Your One Time Password for Askurdr is '.$otp;
            // $mobileno = request('mobile');
            $country_code = request('country_code');
            // $country_code = +966;
            $mobileno = request('mobile');
            $pp = SmsALa::SendSms($mobileno,$message,$country_code);
            // Twilio::message('+'.$mobile, 'Your Omnee Authentication OTP is '.$otp);
            return response()->json(['data'=>$data], 200);

        }

    }
    public function Register(Request $request)

    {
        if(request('language') == 'ar'){
            $validator = Validator::make($request->all(), [
               'first_name'  => 'required|max:64',
               'last_name'  => 'required|max:64',
               'date_of_birth'=>'required',
               'password'  => 'required',
               'mobile'  => 'required',
               'gender'=>'required',
               'national_id'=>'required|min:10|max:10',
               'language'  => 'required',
            ],
            [
                'first_name.required'=>'حقل الاسم الأول مطلوب.',
                'last_name.required'=>'حقل الاسم الأخير مطلوب.',
                'date_of_birth.required'=>'تاريخ حقل الميلاد مطلوب.',
                'password.required'=>'حقل كلمة المرور مطلوب',
                'mobile.required'=>'حقل المحمول مطلوب.',
                'gender.required'=>'مجال الجنس مطلوب',
                'national_id.required'=>'حقل الهوية الوطنية مطلوب',
                'national_id.min'=>'يجب أن يكون الرقم القومي 10 أحرف على الأقل',
                'national_id.max'=>'قد لا يكون الرقم القومي أكبر من 10 أحرف.',
                'national_id.max'=>'حقل اللغة مطلوب'
            ]);
        }else{
            $validator = Validator::make($request->all(), [
               'first_name'  => 'required|max:64',
               'last_name'  => 'required|max:64',
               'date_of_birth'=>'required',
               'password'  => 'required',
               'mobile'  => 'required',
               'gender'=>'required',
               'national_id'=>'required|min:10|max:10',
               'language'  => 'required',
             ]);
        }
        if ($validator->fails()) {
            $errorMessage = implode(',', $validator->errors()->all());
            return response()->json(['errors' => $errorMessage], 422);
        } else {
            $is_exist = User::where('national_id', request('national_id'))->count();
            if($is_exist > 0){
                if(request('language') == 'ar'){
                  return response()->json(['errors' => 'الهوية الوطنية موجودة بالفعل'], 404);  
                }else{
                  return response()->json(['errors' => 'National id is already exists'], 404);
                }
            }

            $job_max_id = User::max('id');
            $emr_number = str_pad($job_max_id + 1, 7, '0', STR_PAD_LEFT);
            $masteradminsetting = MasterAdminSetting::where('id',1)->first();
            
            // return response()->json(['user'=>request('date_of_birth')], 200);

            if(!empty(request('date_of_birth'))){
                $dateOfBirth = request('date_of_birth');
                $today = date("Y-m-d");
                $diff = date_diff(date_create($dateOfBirth), date_create($today));
                $agecal = $diff->format('%y');
            }else{
                $agecal = 0;
            }
            $user = new User();
            $user->first_name = request('first_name');
            $user->last_name = request('last_name');
            $user->email = request('national_id');
            $user->device_id = request('device_id');
            $user->mobile = request('mobile');
            $user->password = Hash::make(request('password'));
            $user->gender = strtolower(request('gender'));
            $user->date_of_birth = request('date_of_birth');
            $user->age = $agecal;
            $user->national_id = request('national_id');
            $user->emr_number = $emr_number;
            $user->wallet_money = $masteradminsetting->price;
            $user->status=1;
            $user->countrycode=request('country_code');
            $user->save();
            $user->attachRole(3); // 3 = Patient
            $message = 'Thank you for registrating with Askurdr application.';
            //$country_code = +966;
            $country_code = request('country_code');
            $mobileno = request('mobile');
            $pp = SmsALa::SendSms($mobileno,$message,$country_code);
            // try {
            //     //$user->notify(new WelcomeUser($user));
            //     $user->notify(new Activation($user));
            // } catch (Exception $e) {

            // }

            if(request('language') == 'ar'){
            $user = User::find($user->id,['id','ar_first_name', 'last_name','mobile','gender','date_of_birth','device_id','national_id','status']);
            }else{
                $user = User::find($user->id,['id','first_name', 'last_name','mobile','gender','date_of_birth','device_id','national_id','status']);
            }

            $user->token = $user->createToken('MyApp')->accessToken;
            return response()->json(['user'=>$user->toArray()], 200);
        }

    }

    public function me()
    {

        $user = auth()->user();
        if ($user) {
            $user = User::whereId($user->id)->first();
            $user['discountprice'] = $user->fees * $user->discount /100; 
            
            
            // DB::raw('users.fees * users.discount /100  as discountprice')
            $userrole = auth()->user()->roles;
            if($userrole['0']->name == "doctor")
            {
                $user['availability'] = DoctorAvailability::where('doctor_id',$user->id)->first();
                $doctor = DoctorLanguage::where('user_id',$user->id)->get();
                $language = '';
                foreach ($doctor as $key => $value) {
                    $language .= $value->language->name.',';
                }
                $user['speak_language'] = rtrim($language, ',');
                $user['ask_doctor_id'] = $user->ask_id;
            }else{
                $user['availability'] = DoctorAvailability::where('patient_id',$user->id)->first();
                $user['speak_language'] = '';
            }
            if($user->paymentdetails == null){
                unset($user->paymentdetails);
                $user->paymentdetails = (object) array();
            }

            if(request('language') == 'ar'){
              $user->first_name =  $user->ar_first_name;
            }
            return response()->json(['user'=>$user], 200);
        } else {

            if(request('language') == 'ar'){
                return response()->json(['المستخدم ليس موجود'], 404);  
            }else{
                return response()->json(['User not found'], 404);
            }
        }
    }

    public function patientdetail(Request $request)
    {
        $user = auth()->user();
        if ($user) {
            $user = User::whereId(request('patient_id'))->first();
            return response()->json(['user'=>$user], 200);
        } else {
            return response()->json(['User not found'], 404);
        }
    }

    public function changepassword(Request $request)
    {
        if(request('language') == 'ar'){
            $validator = Validator::make($request->all(), [
               'old_password'  => 'required',
               'password'  => 'required',
             ],[
                'password.required'=>'حقل كلمة المرور مطلوب',
                'old_password.required'=>'حقل كلمة المرور القديم مطلوب'   
             ]);
        }else{
            $validator = Validator::make($request->all(), [
               'old_password'  => 'required',
               'password'  => 'required',
             ]);
        }

        if ($validator->fails()) {
            $errorMessage = implode(',', $validator->errors()->all());
            return response()->json(['errors' => $errorMessage], 422);
        } else {
            $user = auth()->user();

            $password1 = Hash::check($request->old_password, $user->password);
            if($password1 > 0)
            {

                if ($user) {
                    $user = User::whereId($user->id)->update([
                    'password' => Hash::make(request('password'))
                  ]);
                    return response()->json(['success' => true], 200);
                } else {
                    return response()->json(['User not found'], 404);
                }
            }
            else
            {
                if(request('language') == 'ar'){
                    return response()->json(['errors' => 'كلمة المرور القديمة خاطئة'], 404);
                }else{
                    return response()->json(['errors' => 'Old password wrong'], 404);
                }
            }   

        }
    }

    public function editprofile(Request $request)
    {
        $validator = Validator::make($request->all(), [
           'first_name'  => 'required|max:64',
           'last_name'  => 'required|max:64',
           // 'post_mail' => 'required',
           'mobile'  => 'required',
           // 'language'=>'required',
         ]);

        if ($validator->fails()) {
            $errorMessage = implode(',', $validator->errors()->all());
            return response()->json(['errors' => $errorMessage], 422);
        } else {

            $user = auth()->user();

            $profile = '';
            if(request('profile_pic'))
            {
                $img = request('profile_pic');
                $custom_file_name = 'patient-'.time().'.'.$img->getClientOriginalExtension();
                $profile = $img->storeAs('users', $custom_file_name);
            }

            $user = User::find($user->id);
            $user->first_name = request('first_name');
            $user->last_name = request('last_name');
            // $user->post_mail = request('post_mail');
            $user->mobile = request('mobile');
            // $user->language = request('language');
            if(request('profile_pic'))
            {
                $user->profile_pic = $profile;
            }
            // $user->insurance_company_name = request('insurance_company_name');
            // $user->insurance_policy_no = request('insurance_policy_no');
            // $user->insurance_id=request('insurance_id');
            $user->save();

            
            $user = User::find($user->id);
            $user->token = $user->createToken('MyApp')->accessToken;
            return response()->json(['user'=>$user->toArray()], 200);
        }
    }

    public function forgotpassword(Request $request)
    {

        $user = User::where('email', $request->national_id)->first();
        if (!$user) {
            if(request('language') == 'ar'){
            return response()->json(['message' => 'الهوية الوطنية غير موجودة.','success'=>false], 404);
            }else{
            return response()->json(['message' => 'National id not exists.','success'=>false], 404);
            }
        }

        DB::table('password_resets')->where('email', $request->national_id)->delete();

        //create a new token to be sent to the user.
        DB::table('password_resets')->insert([
              'email' => $request->national_id,
              'token' => str_random(60), //change 60 to any length you want
              'created_at' => date('Y-m-d h:i:s')
          ]);

        $tokenData = DB::table('password_resets')
          ->where('email', $request->national_id)->first();

        $token = $tokenData->token;
        $email = $request->national_id; // or $email = $tokenData->email;

        $user_roles = $user->roles()->first();
        if ($user_roles->id == 4 || $user_roles->id == 6) {
            $code = 5;  // Customer & Tenants
        }
        if ($user_roles->id == 5) {
            $code = 6;  // Provider
        }

        try {
            $username = User::where('email', $request->national_id)->first();
            // dd($username->mobile);
            $message = "Your password is : 123456789";
            $user = User::whereId($user->id)->update([
                        'password' => Hash::make('123456789')
                    ]);
            //$country_code = '+966';
            $country_code = $username->countrycode;
            $mobileno = $username->mobile;
            $pp = SmsALa::SendSms($mobileno,$message,$country_code);
            // dd($pp);
            // $user->notify(new MailResetPasswordNotification($token, $user));
        } catch (Exception $e) {
        
        }
        if(request('language') == 'ar'){
            return response()->json(['message' => 'إعادة تعيين كلمة المرور المرسلة إلى السجل المحمول.','success'=> true], 200);
        }else{
            return response()->json(['message' => 'Reset password sent to the register mobile.','success'=> true], 200);
        }
    }

    public function adminsetting()
    {
        
        $setting = MasterAdminSetting::first();
        if(request('language') == 'ar'){
            $setting->mobile = $setting->ar_mobile;
            $setting->email = $setting->ar_email;
            $setting->description = $setting->ar_description;
            // unset($setting->ar_email);
            // unset($setting->ar_mobile);
        }
        return response()->json(['admin_setting' => $setting,'success'=> true], 200);   
    }
	
	public function clinicList(Request $request)
	{
		
		$clinic = Clinic::where('status',1)->get();
        if(request('language') == 'ar'){
    		foreach ($clinic as $key => $value) {
                $value->name = $value->ar_name;
            }
        }
		return response()->json($clinic, 200);
	}
	
	public function documentTypeList(Request $request)
	{
		$documentType=DocumentType::where('status',1)->get();
        if(request('language') == 'ar'){
            foreach ($documentType as $key => $value) {
                $value->name = $value->ar_name;
            }
        }
		return response()->json($documentType, 200);
	}
	
	 public function specialityList(Request $request)
    {
        $speciality=Speciality::all();
        if(request('language') == 'ar'){
            foreach ($speciality as $key => $value) {
                $value->name = $value->ar_name;
            }
        }
        return response()->json(['data' => $speciality], 200);
    }

    public function specialitydoctoreList(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
           'speciality_id'  => 'required',
           // 'language'  => 'required'
        ]);
        if ($validator->fails()) {
            $errorMessage = implode(',', $validator->errors()->all());
            return response()->json(['errors' => $errorMessage], 422);
        } else {
            if(request('consultant') == 1){
                $consultant = array(1);
            }elseif(request('consultant') == 2){
                $consultant = array(2);
            }else{
                $consultant = array(1,2);
            }  
            
            
        if(request('language') == 'ar'){
            if(request('consultant') == 2){
                $DoctorSpeciality=DoctorSpeciality::select('doctor_speciality.*','users.ask_id as ask_doctor_id','users.ar_first_name as first_name','users.national_id','users.fees','users.last_name','users.mobile','users.profile_pic','users.gender','users.fees','users.discount','doctor_availability.status','doctor_education.course','doctor_experience.year',
                DB::raw('users.fees * users.discount /100  as discountprice')
                )
                ->join('users', 'doctor_speciality.user_id', '=', 'users.id')
                ->join('doctor_availability', 'doctor_speciality.user_id', '=', 'doctor_availability.doctor_id')
                ->join('doctor_education', 'doctor_speciality.user_id', '=', 'doctor_education.user_id')
                ->join('doctor_experience', 'doctor_speciality.user_id', '=', 'doctor_experience.user_id')
                ->where('speciality_id',$request->speciality_id)->whereIn('consultant',$consultant)->orderBy('id', 'DESC')->get();
                foreach ($DoctorSpeciality as $key => $value) {
                    $doctorid = $value->user_id;
                    if($doctorid){
                        $language = DoctorLanguage::where('user_id',$doctorid)->get();
                        if($language){
                            $lan = '';
                            foreach ($language as $lkey => $lvalue) {
                                $lan .=  $lvalue->language->name.',';
                            }
                            $lan = rtrim($lan, ',');
                            $value['speak_language'] = $lan;
                        }
                    }
                }
            }else{
                $DoctorSpeciality=DoctorSpeciality::select('doctor_speciality.*','users.ask_id as ask_doctor_id','users.ar_first_name as first_name','users.national_id','users.fees','users.last_name','users.mobile','users.profile_pic','users.gender','users.fees','users.discount','doctor_availability.status','doctor_education.course','doctor_experience.year',
                DB::raw('users.fees * users.discount /100  as discountprice')
                )
                ->join('users', 'doctor_speciality.user_id', '=', 'users.id')
                ->join('doctor_availability', 'doctor_speciality.user_id', '=', 'doctor_availability.doctor_id')
                ->join('doctor_education', 'doctor_speciality.user_id', '=', 'doctor_education.user_id')
                ->join('doctor_experience', 'doctor_speciality.user_id', '=', 'doctor_experience.user_id')
                ->where('speciality_id',$request->speciality_id)
                ->whereIn('consultant',$consultant)
               // ->orwhereIn('specialist',$specialist)
                ->orderBy('id', 'DESC')->get();
                
                foreach ($DoctorSpeciality as $key => $value) {
                    $doctorid = $value->user_id;
                    if($doctorid){
                        $language = DoctorLanguage::where('user_id',$doctorid)->get();
                        if($language){
                            $lan = '';
                            foreach ($language as $lkey => $lvalue) {
                                $lan .=  $lvalue->language->name.',';
                            }
                            $lan = rtrim($lan, ',');
                            $value['speak_language'] = $lan;
                        }
                    }
                }
            }
            
        }else{
            
            if(request('consultant') == 2){
                $DoctorSpeciality=DoctorSpeciality::select('doctor_speciality.*','users.ask_id as ask_doctor_id','users.first_name','users.national_id','users.fees','users.last_name','users.mobile','users.profile_pic','users.gender','users.fees','users.discount','doctor_availability.status','doctor_education.course','doctor_experience.year',
                DB::raw('users.fees * users.discount /100  as discountprice')
                )
                ->join('users', 'doctor_speciality.user_id', '=', 'users.id')
                // ->join('doctor_language','users.id', '=',  'doctor_language.user_id')
                ->join('doctor_availability', 'doctor_speciality.user_id', '=', 'doctor_availability.doctor_id')
                ->join('doctor_education', 'doctor_speciality.user_id', '=', 'doctor_education.user_id')
                ->join('doctor_experience', 'doctor_speciality.user_id', '=', 'doctor_experience.user_id')
                ->where('speciality_id',$request->speciality_id)->whereIn('consultant',$consultant)->orderBy('id', 'DESC')->get();
                foreach ($DoctorSpeciality as $key => $value) {
                    $doctorid = $value->user_id;
                    if($doctorid){
                        $language = DoctorLanguage::where('user_id',$doctorid)->get();
                        if($language){
                            $lan = '';
                            foreach ($language as $lkey => $lvalue) {
                                $lan .=  $lvalue->language->name.',';
                            }
                            $lan = rtrim($lan, ',');
                            $value['speak_language'] = $lan;
                        }
                    }
                }
            }else
            {
                $DoctorSpeciality=DoctorSpeciality::select('doctor_speciality.*','users.ask_id as ask_doctor_id','users.first_name','users.national_id','users.fees','users.last_name','users.mobile','users.profile_pic','users.gender','users.fees','users.discount','doctor_availability.status','doctor_education.course','doctor_experience.year',
                DB::raw('users.fees * users.discount /100  as discountprice')
                )
                ->join('users', 'doctor_speciality.user_id', '=', 'users.id')
                // ->join('doctor_language','users.id', '=',  'doctor_language.user_id')
                ->join('doctor_availability', 'doctor_speciality.user_id', '=', 'doctor_availability.doctor_id')
                ->join('doctor_education', 'doctor_speciality.user_id', '=', 'doctor_education.user_id')
                ->join('doctor_experience', 'doctor_speciality.user_id', '=', 'doctor_experience.user_id')
                ->where('speciality_id',$request->speciality_id)
                ->whereIn('consultant',$consultant)
               // ->orwhereIn('specialist',$specialist)
                ->orderBy('id', 'DESC')->get();
                
                foreach ($DoctorSpeciality as $key => $value) {
                    $doctorid = $value->user_id;
                    if($doctorid){
                        $language = DoctorLanguage::where('user_id',$doctorid)->get();
                        
                        if($language){
                            $lan = '';
                            foreach ($language as $lkey => $lvalue) {
                                $lan .=  $lvalue->language->name.',';
                            }
                            $lan = rtrim($lan, ',');
                            $value['speak_language'] = $lan;
                        }
                    }
                }
            }
        }


        // $doctor_available = DoctorAvailability::where('patient_id',$user_id)->update(['status'=>1,'updated_at'=>date('Y-m-d h:i:s')]);

        return response()->json(['data' => $DoctorSpeciality], 200);
        } 

    }


    public function specialitydoctorelistwithfilter(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
           'gender'  => 'required',
           'speciality_id'  => 'required',
           // 'language'  => 'required'
        ]);
        if ($validator->fails()) {
            $errorMessage = implode(',', $validator->errors()->all());
            return response()->json(['errors' => $errorMessage], 422);
        } else {
        if(request('consultant') == 1){
            $consultant = array(1);
        }elseif(request('consultant')==2){
            $consultant = array(2);
        }else{
            $consultant = array(1,2);
        }
        if($request->gender == 'all'){
            if(request('language') == 'ar'){
            $DoctorSpeciality=DoctorSpeciality::select('doctor_speciality.*','users.ask_id as ask_doctor_id','users.ar_first_name as first_name','users.national_id','users.last_name','users.mobile','users.profile_pic','users.gender','users.fees','users.discount','doctor_availability.status','doctor_education.course','doctor_experience.year','users.doctor_code as group_code',
                DB::raw('users.fees * users.discount /100  as discountprice')
                )->join('users', 'doctor_speciality.user_id', '=', 'users.id')
            ->leftjoin('doctor_availability', 'doctor_speciality.user_id', '=', 'doctor_availability.doctor_id')
            ->leftjoin('doctor_education', 'doctor_speciality.user_id', '=', 'doctor_education.user_id')
            ->leftjoin('doctor_experience', 'doctor_speciality.user_id', '=', 'doctor_experience.user_id')
            ->where('speciality_id',$request->speciality_id)->whereIn('consultant',$consultant)->orderBy('id', 'DESC')->get(); 
                foreach ($DoctorSpeciality as $key => $value) {
                    $doctorid = $value->user_id;
                    if($doctorid){
                        $language = DoctorLanguage::where('user_id',$doctorid)->get();
                        if($language){
                            $lan = '';
                            foreach ($language as $lkey => $lvalue) {
                                $lan .=  $lvalue->language->name.',';
                            }
                            $lan = rtrim($lan, ',');
                            $value['speak_language'] = $lan;
                        }
                    }
                }
            }else{
            $DoctorSpeciality=DoctorSpeciality::select('doctor_speciality.*','users.ask_id as ask_doctor_id','users.first_name','users.national_id','users.last_name','users.mobile','users.profile_pic','users.gender','users.fees','users.discount','doctor_availability.status','doctor_education.course','doctor_experience.year','users.doctor_code as group_code',
                DB::raw('users.fees * users.discount /100  as discountprice')
                )->join('users', 'doctor_speciality.user_id', '=', 'users.id')
            ->leftjoin('doctor_availability', 'doctor_speciality.user_id', '=', 'doctor_availability.doctor_id')
            ->leftjoin('doctor_education', 'doctor_speciality.user_id', '=', 'doctor_education.user_id')
            ->leftjoin('doctor_experience', 'doctor_speciality.user_id', '=', 'doctor_experience.user_id')
            ->where('speciality_id',$request->speciality_id)->whereIn('consultant',$consultant)->orderBy('id', 'DESC')->get(); 
            foreach ($DoctorSpeciality as $key => $value) {
                $doctorid = $value->user_id;
                if($doctorid){
                    $language = DoctorLanguage::where('user_id',$doctorid)->get();
                    if($language){
                        $lan = '';
                        foreach ($language as $lkey => $lvalue) {
                            $lan .=  $lvalue->language->name.',';
                        }
                        $lan = rtrim($lan, ',');
                        $value['speak_language'] = $lan;
                    }
                }
            }
            } 
        }else{
            if(request('language') == 'ar'){
            $DoctorSpeciality=DoctorSpeciality::select('doctor_speciality.*','users.ask_id as ask_doctor_id','users.ar_first_name as first_name','users.national_id','users.last_name','users.mobile','users.profile_pic','users.gender','users.fees','users.discount','doctor_availability.status','doctor_education.course','doctor_experience.year','users.doctor_code as group_code',DB::raw('users.fees * users.discount /100  as discountprice')
            )->join('users', 'doctor_speciality.user_id', '=', 'users.id')
            ->leftjoin('doctor_availability', 'doctor_speciality.user_id', '=', 'doctor_availability.doctor_id')
            ->leftjoin('doctor_education', 'doctor_speciality.user_id', '=', 'doctor_education.user_id')
            ->join('doctor_experience', 'doctor_speciality.user_id', '=', 'doctor_experience.user_id')
            ->where('speciality_id',$request->speciality_id)->where('gender',$request->gender)->whereIn('consultant',$consultant)->orderBy('id', 'DESC')->get();
            foreach ($DoctorSpeciality as $key => $value) {
                $doctorid = $value->user_id;
                if($doctorid){
                    $language = DoctorLanguage::where('user_id',$doctorid)->get();
                    if($language){
                        $lan = '';
                        foreach ($language as $lkey => $lvalue) {
                            $lan .=  $lvalue->language->name.',';
                        }
                        $lan = rtrim($lan, ',');
                        $value['speak_language'] = $lan;
                    }
                }
            }
            }else{
            $DoctorSpeciality=DoctorSpeciality::select('doctor_speciality.*','users.ask_id as ask_doctor_id','users.first_name','users.national_id','users.last_name','users.mobile','users.profile_pic','users.gender','users.fees','users.discount','doctor_availability.status','doctor_education.course','doctor_experience.year','users.doctor_code as group_code',DB::raw('users.fees * users.discount /100  as discountprice')
            )->join('users', 'doctor_speciality.user_id', '=', 'users.id')
            ->leftjoin('doctor_availability', 'doctor_speciality.user_id', '=', 'doctor_availability.doctor_id')
            ->leftjoin('doctor_education', 'doctor_speciality.user_id', '=', 'doctor_education.user_id')
            ->join('doctor_experience', 'doctor_speciality.user_id', '=', 'doctor_experience.user_id')
            ->where('speciality_id',$request->speciality_id)->where('gender',$request->gender)->whereIn('consultant',$consultant)->orderBy('id', 'DESC')->get();
            foreach ($DoctorSpeciality as $key => $value) {
                $doctorid = $value->user_id;
                if($doctorid){
                    $language = DoctorLanguage::where('user_id',$doctorid)->get();
                    if($language){
                        $lan = '';
                        foreach ($language as $lkey => $lvalue) {
                            $lan .=  $lvalue->language->name.',';
                        }
                        $lan = rtrim($lan, ',');
                        $value['speak_language'] = $lan;
                    }
                }
            }
            }
        }
        return response()->json(['data' => $DoctorSpeciality], 200);
        } 

    }

    public function getPhysicanDiagnosis(Request $request)
    {
        $text=request('text');

        $availableTutorials = [];

        $uri = 'https://id.who.int/icd/entity/search?q='.$text;


        $icd_api_client = new ICD_API_Client($uri);
        
        $response = $icd_api_client->get();
        // dd($response);
        // if($response)
        // {

        //     $array = $response->destinationEntities;


        //     foreach ($array as  $value) {

        //         $sub_array = [];

        //         $sub_array['label'] = strip_tags($value->title);

        //         $sub_array['value'] = $value->id;

        //         $availableTutorials[] = $sub_array;

        //     }
            
        // }
        if($response)
        {

            $array = $response->destinationEntities;


            foreach ($array as  $value) {

                $sub_array = [];

                $sub_array['label'] = strip_tags($value->title);

                $sub_array['value'] = $value->id;

                $availableTutorials[] = $sub_array;

            }
            
        }
        return response()->json($availableTutorials);
    }

    public function medicinesList(Request $request)
    {
        $medicine=Medicine::where('status',1)->get();
        foreach ($medicine as $key => $value) {
            // $value->name = str_replace("|","",$value->name);
            $value->name = trim(substr($value->name, 0, strpos($value->name, "|")));
        }
        
        return response()->json($medicine, 200);
    }

    public function InvestigationList(Request $request)
    {
        $investigation=Investigation::where('status',1)->get();
        if(request('language') == 'ar'){
            foreach ($investigation as $key => $value) {
                $value->testname_english = $value->testname_arabic;
            }
        }
        return response()->json($investigation, 200);

    }
	
    public function logout(Request $request)
    {
        $user_id=request('user_id');

        $type=request('type');

        if($type==0)
        {
            
            $user=User::whereId($user_id)->update(['device_id'=>'']);

            $doctor_available = DoctorAvailability::where('patient_id',$user_id)->update(['status'=>1,'updated_at'=>date('Y-m-d h:i:s')]);

            return response()->json(['success' => true], 200);
        }

        if($type==1)
        {
            $user=User::whereId($user_id)->update(['device_id'=>'']);

            $doctor_available = DoctorAvailability::where('doctor_id',$user_id)->update(['status'=>1,'updated_at'=>date('Y-m-d h:i:s')]);

            return response()->json(['success' => true], 200);
        }
    }

    public function generate_otp(Request $request)
    {
        $validator = Validator::make($request->all(), [
           'mobileno'  => 'required',
         ]);

        if ($validator->fails()) {
            $errorMessage = implode(',', $validator->errors()->all());
            return response()->json(['errors' => $errorMessage], 422);
        }else{

            $mobileno = $request->mobileno;

            $random_string = rand(1000,9999);

            $message="Your One Time Password For E Clinic is ".$random_string;

            $country_code=request('country_code');
            
            SmsALa::SendSms($mobileno,$message,$country_code);

            return response()->json(['otp' => $random_string]);
        } 
    }

    public function getpackage(Request $request)
    {
        $package=Paymentplan::where('status',1)->get();

        return response()->json($package, 200);
    }
    public function payment_plan(Request $request)
    {
                $package_id=request('package_id');

                $user_id=request('user_id');

                $type=request('type');

                if($type==1) //selfpayment
                {
                    $payment_status=request('payment_status');
					$order_id=request('order_id');
					$transaction_id=request('transaction_id');
                    $payment_plan=Paymentplan::where('id',$package_id)->where('status',1)->get();

                    if(count($payment_plan)> 0)
                    {
                        if($payment_plan[0]->type=='yearly')
                        {
                            $years=isset($payment_plan[0]->years)?$payment_plan[0]->years:'';
                            $dt = Carbon::now();
                            $plan_start_date = date('Y-m-d', strtotime($dt));
                            $plan_enddate=$dt->addYear($years);
                            $plan_end_date = date('Y-m-d', strtotime($plan_enddate));

                            $payment_details=new Payment_details();
                            $payment_details->user_id=$user_id;
                            $payment_details->package_id=$package_id;
                            $payment_details->type=$type;
                            $payment_details->plan_startdate=$plan_start_date;
                            $payment_details->plan_enddate=$plan_end_date;
                            $payment_details->payment_status=$payment_status;
							$payment_details->order_id=$order_id;
							$payment_details->transaction_id=$transaction_id;
                            $payment_details->insurance_photo='';
                            $payment_details->insurance_number='';
                            $payment_details->insurance_name='';
                            $payment_details->save();
                            $payment_details->id;
                            $user=User::where('id',$user_id)->update(['payment_type'=>$type,'paymentdetails_id'=>$payment_details->id]);
                            return response()->json($payment_details, 200);

                        }

                        if($payment_plan[0]->type=='monthly')
                        {
                            $months=isset($payment_plan[0]->months)?$payment_plan[0]->months:'';
                            $dt = Carbon::now();
                            $plan_start_date = date('Y-m-d', strtotime($dt));
                            $plan_enddate=$dt->addMonths($months);
                            $plan_end_date = date('Y-m-d', strtotime($plan_enddate));

                            $payment_details=new Payment_details();
                            $payment_details->user_id=$user_id;
                            $payment_details->package_id=$package_id;
                            $payment_details->type=$type;
                            $payment_details->plan_startdate=$plan_start_date;
                            $payment_details->plan_enddate=$plan_end_date;
                            $payment_details->payment_status=$payment_status;
							$payment_details->order_id=$order_id;
							$payment_details->transaction_id=$transaction_id;
                            $payment_details->insurance_photo='';
                            $payment_details->insurance_number='';
                            $payment_details->insurance_name='';

                            $payment_details->save();
                            $payment_details->id;
                            $user=User::where('id',$user_id)->update(['payment_type'=>$type,'paymentdetails_id'=>$payment_details->id]);
                            return response()->json($payment_details, 200);
                        }
                    }
                }

                if($type==2)//insurance
                {

                        $insurance_company_name=request('insurance_company_name');
                        $insurance_company_number=request('insurance_company_number');

                        if(request('insurance_photos'))
                        {

                            $insurance_photo = request('insurance_photos');   

                            $insurance_photos = [];

                            foreach ($insurance_photo as $key => $r) {
                                $img = $r;
                                $custom_file_name = 'user-'.$key.time().'.'.$img->getClientOriginalExtension();
                                $profile = $img->storeAs('insurance_report', $custom_file_name);
                                $insurance_photos[] = $profile;
                            }

                            $insurance_file_data = implode(' | ', $insurance_photos);
                        }

                        $payment_details=new Payment_details();
                        $payment_details->user_id=$user_id;
                        $payment_details->package_id=$package_id;
                        $payment_details->type=$type;
                        $payment_details->plan_startdate=isset($payment_plan)?$plan_start_date:'';
                        $payment_details->plan_enddate=isset($payment_plan)?$plan_end_date:'';
                        $payment_details->payment_status=isset($payment_plan)?$payment_status:'';
						$payment_details->order_id=isset($payment_plan)?$order_id:'';
						$payment_details->transaction_id=isset($payment_plan)?$transaction_id:'';
                        $payment_details->insurance_photo=isset($insurance_file_data)?$insurance_file_data:'';
                        $payment_details->insurance_number=$insurance_company_number;
                        $payment_details->insurance_name=$insurance_company_name;
                        $payment_details->save();
                        $payment_details->id;

                        $user=User::where('id',$user_id)->update(['payment_type'=>$type,'paymentdetails_id'=>$payment_details->id]);
                        return response()->json($payment_details, 200);
                }

    }

    

    

    public function createChat(Request $request)
    {
        $senderId=request('sender_id');

        $receiverId=request('receiver_id');

        $node = request('node');        

        $chat  = Messages::where('id', $node)->first();

        $chat2 = Messages::where('id', $node)->first();

        $chat_node=$chat['id'];

        $chat_node2=$chat2['id'];

        if($node==$chat_node)
        {
            return response()->json(['success'=>'node already exists'],200);
        }
        elseif($node==$chat_node2)
        {
            return response()->json(['success'=>'node already exists'],200);
        }
        else
        {
            $chat = Messages::create([
                'id'=>$node,
                'sender_id' => $senderId,
                'receiver_id' => $receiverId
            ]);   
            
            return response()->json(['success'=>'node added'], 200);
        }
    }

    public function storeQuickBloxId(Request $request)
    {
        $quickblox_id=request('quickblox_id');

        $user_id = auth()->user()->id;

        $user_update = User::whereId($user_id)->update(['quickblox_id'=>$quickblox_id]);

        $user=User::whereId($user_id)->get();

        return response()->json(['data'=>$user], 200);
    }


    public function addcallhistorylist(Request $request)
    {

        $validator = Validator::make($request->all(), [
           'userid'  => 'required',
           'doctor_id'  => 'required',
           'calltype'  => 'required'
        ]);

        if ($validator->fails()) {
            $errorMessage = implode(',', $validator->errors()->all());
            return response()->json(['errors' => $errorMessage], 422);
        }else{   
            $user_id = auth()->user()->id;
            //payment history
            if(request('total_call_time') != ''){
                $doctdata  = User::where('id', request('doctor_id'))->first();
                $userdata  = User::where('id', request('userid'))->first();
                $feesdedution = 0;
                $payprice = 0;
                if($doctdata){
                  if($doctdata->commision < $doctdata->fees){
                    $doctorclinic = DoctorClinic::where('user_id',request('doctor_id'))->first();
                    if($doctorclinic){
                        $clinicid = $doctorclinic->clinic_id;
                        $clinicdata = Clinic::where('id',$clinicid)->first();
                        $oldwalletclinic = $clinicdata->wallet_money; 
                        $addwalletmoney = $oldwalletclinic + $doctdata->commision;
                        // dd($oldwalletclinic);
                        $clinic_update = Clinic::whereId($clinicid)->update(['wallet_money'=> $addwalletmoney]);
                        // $doctdata->fees  =  $doctdata->fees - $doctdata->commision;

                    }
                  }
                }

                if($userdata){
                  // dd("asdsa");  
                    if(!empty($doctdata->discount)){
                        // $doctororignalfees = $doctdata->fees;
                        $doctororignalfees = $doctdata->fees;
                        // $doctdata->fees = $doctdata->fees - $doctdata->commision;
                        $disprice =  $doctdata->fees * $doctdata->discount / 100;
                        $payprice = $doctdata->fees - $disprice;
                        $feesdedution = $userdata->wallet_money - $payprice;
                        $withoutcommisionadded = $doctdata->wallet_money + $payprice;
                        $feesadded = $withoutcommisionadded - $doctdata->commision;
                        // dd($feesadded);
                        // echo "<br>".$disprice;
                        // echo "<br>".$payprice;
                        // echo "<br>".$feesdedution;

                        // if($userdata->wallet_money > $payprice){

                        if($userdata->wallet_money > $payprice){
                        // if($userdata->wallet_money > $payprice){
                            // $disprice =  $doctdata->fees * $doctdata->discount / 100;
                            // $payprice = $doctdata->fees - $disprice;
                            // $feesdedution = $userdata->wallet_money - $payprice;
                            // $feesadded = $doctdata->wallet_money + $payprice;  // doctore wallet add
                        }else{
                           return response()->json(['data'=>"Your wallet amount is low."], 200);
                           exit;
                        }
                        // dd("Asdsd");
                    }else{
                        // dd("ASDsd");
                        // dd($doctdata->fees);
                        $doctororignalfees = $doctdata->fees;
                        if($doctdata->fees <= $userdata->wallet_money){
                            $doctdata->fees = $doctdata->fees - $doctdata->commision;
                            $payprice = $doctdata->fees;
                            $feesdedution = $userdata->wallet_money - $doctororignalfees; // user wallet  deductin
                            $feesadded = $doctdata->wallet_money + $doctdata->fees;  // doctore wallet add
                        }else{
                            return response()->json(['data'=>"Your wallet amount is low."], 200);
                            exit;
                        }
                    }
                    $user_update = User::whereId(request('userid'))->update(['wallet_money'=>$feesdedution]);
                    $doctor_update = User::whereId(request('doctor_id'))->update(['wallet_money'=>$feesadded]);
                }    
                $payment_history = new Payment_history;
                $payment_history->user_id = request('userid');      // user
                $payment_history->user_id2 = request('doctor_id');  // doctor
                $payment_history->price = $payprice;
                $payment_history->message = "Pay fees of doctor SAR".$payprice;
                $payment_history->save();
            }else{
                $doctdata  = User::where('id', request('doctor_id'))->first();
                $userdata  = User::where('id', request('userid'))->first();
                if($userdata){
                    if($doctdata){
                        if($doctdata->fees < $userdata->wallet_money){

                        }else{
                            return response()->json(['data'=>"Please add money to wallet."], 200);
                        }
                    }
                }
            }

            $chathistory = new Chathistory;
            $chathistory->userid = request('userid');
            $chathistory->doctor_id = request('doctor_id');
            $chathistory->calltype = request('calltype');
            $chathistory->total_call_time = request('total_call_time');
            $chathistory->save();
            $Chathistoryadd = Chathistory::select('call_history.*','users.first_name','users.ar_first_name','users.last_name','users.mobile','users.profile_pic','users.gender')->join('users', 'call_history.doctor_id', '=', 'users.id')->where('call_history.id',$chathistory->id)->orderBy('call_history.id', 'DESC')->get();
            return response()->json(['data'=>$Chathistoryadd], 200);
        }
    }


    public function getcallhistorylist(Request $request)
    {
        $user_id = auth()->user()->id;
        // dd($user_id);
        // $Chathistory = Chathistory::where('id',$package_id)->where('userid',$user_id)->get();
        // $chathistory->save();
        // $Chathistory=Chathistory::select('call_history.*','users.first_name','users.last_name','users.mobile','users.profile_pic','users.gender')->join('users', 'call_history.doctor_id', '=', 'users.id')
        // ->orWhere('call_history.userid',$user_id)
        // ->orWhere('call_history.doctor_id',$user_id)
        // ->orderBy('id', 'DESC')->get();

        $rolearray = auth()->user()->roles()->get();
        foreach ($rolearray as $role)
        {   
            if ($role->name == 'patient')
            {
                $Chathistory = Chathistory::select('call_history.*','users.first_name','users.ar_first_name','users.last_name','users.mobile','users.profile_pic','users.gender')->join('users', 'call_history.doctor_id', '=', 'users.id')
                ->Where('call_history.userid',$user_id)
                // ->Where('call_history.doctor_id',$user_id)
                ->orderBy('id', 'DESC')->get();
            }else{
                $Chathistory=Chathistory::select('call_history.*','users.first_name','users.ar_first_name','users.last_name','users.mobile','users.profile_pic','users.gender')
                ->join('users', 'call_history.userid', '=', 'users.id')
                // ->Where('call_history.userid',$user_id)
                ->Where('call_history.doctor_id',$user_id)
                ->orderBy('id', 'DESC')->get();
                // dd($Chathistory);
            }
        }
        
        return response()->json(['data'=>$Chathistory], 200);
    }


    public function addchatlastmsg(Request $request)
    {
        $validator = Validator::make($request->all(), [
           'userid'  => 'required',
           'doctor_id'  => 'required',
           'doctor_name'  => 'required',
           // 'doctor_pic'  => 'required',
           'last_message'  => 'required',
           // 'datetime'  => 'required'
         ]);

        if ($validator->fails()) {
            $errorMessage = implode(',', $validator->errors()->all());
            return response()->json(['errors' => $errorMessage], 422);
        }else{
            $chatcount  = Chat::where('user_id', request('userid'))->where('doctor_id', request('doctor_id'))->get();

            if(count($chatcount) > 0){
                // dd($chatcount['0']->id);
                $chat = Chat::find($chatcount['0']->id);
                $chat->message = request('last_message');
                $chat->c_datetime = date("Y-m-d H:i:s");
                $chat->doctor_name = request('doctor_name');
                $chat->doctor_pic = request('doctor_pic');
                $chat->save();
            }else{
                $chat = new Chat;
                $chat->user_id = request('userid');
                $chat->doctor_id = request('doctor_id');
                $chat->doctor_name = request('doctor_name');
                $chat->doctor_pic = request('doctor_pic');
                $chat->message = request('last_message');
                $chat->c_datetime = date("Y-m-d H:i:s");
                $chat->save();
            }
            return response()->json(['data'=>$chat], 200);
            
        }
    }

    public function getchatlastmsg(Request $request)
    {
        $validator = Validator::make($request->all(), [
           'user_id'  => 'required'
        ]);
        if ($validator->fails()) {
            $errorMessage = implode(',', $validator->errors()->all());
            return response()->json(['errors' => $errorMessage], 422);
        }else{
            // dd(auth()->user()->id);
            // $chat  = Chat::where('user_id', $request->user_id)->get();
            $rolearray = auth()->user()->roles()->get();
            foreach ($rolearray as $role)
            {   
                if ($role->name == 'patient')
                {
                    $chat  = Chat::where('user_id', auth()->user()->id)->get();
                }else{
                    $chat  = Chat::where('doctor_id', auth()->user()->id)->get(); 
                }
            }
            return response()->json(['data'=>$chat], 200);
            
        }
    }

     public function paymenyhistory(){
        $user_id = auth()->user()->id;
        // $user_id = 95;
        $paymentdetails = Payment_details::select('payment_detail.id','payment_detail.user_id','payment_detail.package_id','payment_detail.type','payment_detail.payment_status','payment_detail.order_id','users.first_name','users.ar_first_name','users.profile_pic','users.description','payment_detail.plan_startdate','paymentplan.price')
            ->leftjoin('users', 'payment_detail.user_id', '=', 'users.id')
            ->leftjoin('paymentplan', 'payment_detail.package_id', '=', 'paymentplan.id')
            ->where('payment_detail.user_id',$user_id)->orderBy('payment_detail.id', 'DESC')->get();
        // $paymentdetails  = Payment_details::where('user_id', $user_id)->get();
        return response()->json(['data'=>$paymentdetails], 200);
        // PushNotification::SendPushNotification($pmsg, $data, [$doctor_device_id]);
    }


    public function getpaymenthostory(){
        $user_id = auth()->user()->id;
        $rolearray = auth()->user()->roles()->first();
        if($rolearray->name == 'doctor'){
            if(request('language') == 'ar'){
                $paymentdetails = Payment_history::select('payment_history.*','payment_history.user_id2 as doctor_id','users.ar_first_name as first_name','payment_history.price as wallet_money','payment_history.created_at as date_time','users.profile_pic')
                ->leftjoin('users', 'payment_history.user_id', '=', 'users.id')    // user2_id is doctor
                ->where('payment_history.user_id2',$user_id)->orderBy('payment_history.id', 'DESC')->get();
            }else{
                $paymentdetails = Payment_history::select('payment_history.*','payment_history.user_id2 as doctor_id','users.first_name','payment_history.price as wallet_money','payment_history.created_at as date_time','users.profile_pic')
                ->leftjoin('users', 'payment_history.user_id', '=', 'users.id')    // user2_id is doctor
                ->where('payment_history.user_id2',$user_id)->orderBy('payment_history.id', 'DESC')->get();
            }
        }else{
            if(request('language') == 'ar'){
                $paymentdetails = Payment_history::select('payment_history.*','payment_history.user_id2 as doctor_id','users.first_name','payment_history.price as wallet_money','payment_history.created_at as date_time','users.profile_pic')
                ->leftjoin('users', 'payment_history.user_id2', '=', 'users.id')    // user2_id is doctor
                ->where('payment_history.user_id',$user_id)->orderBy('payment_history.id', 'DESC')->get();
            }else{
                $paymentdetails = Payment_history::select('payment_history.*','payment_history.user_id2 as doctor_id','users.first_name','payment_history.price as wallet_money','payment_history.created_at as date_time','users.profile_pic')
                ->leftjoin('users', 'payment_history.user_id2', '=', 'users.id')    // user2_id is doctor
                ->where('payment_history.user_id',$user_id)->orderBy('payment_history.id', 'DESC')->get();
            }
        }
        return response()->json(['data'=>$paymentdetails], 200);
        // PushNotification::SendPushNotification($pmsg, $data, [$doctor_device_id]);
    }



    public function checkbalancestatus(Request $request)
    {
        $validator = Validator::make($request->all(), [
           'userid'  => 'required',
           'doctor_id'  => 'required'
         ]);    

        if ($validator->fails()) {
            $errorMessage = implode(',', $validator->errors()->all());
            return response()->json(['errors' => $errorMessage], 422);
        }else{   
            $user_id = auth()->user()->id;
            //payment history
            $doctdata  = User::where('id', request('doctor_id'))->first();
            $userdata  = User::where('id', request('userid'))->first();
            if($userdata){
                if($doctdata){
                    if(!empty($doctdata->discount)){
                        $disprice =  $doctdata->fees * $doctdata->discount / 100; // 100 price
                        $payprice = $doctdata->fees - $disprice;    // 80 price
                        $feesdedution = $userdata->wallet_money - $payprice;
                        $feesadded = $doctdata->wallet_money + $payprice; 
                        if($userdata->wallet_money >= $payprice){
                            $data['status'] = 0;
                            $data['message'] = 'Your wallet amount is high.';
                            return response()->json(['data'=>$data], 200); // 0  wallet money
                        }else{
                            $data['status'] = 1;
                            $data['message'] = 'Your wallet amount is low.';
                            return response()->json(['data'=>$data], 200);  // 1 not  wallet money
                        }
                    }else{
                        if($doctdata->fees <= $userdata->wallet_money){
                            $data['status'] = 0;
                            $data['message'] = 'Your wallet amount is high.';
                            return response()->json(['data'=>$data], 200); // 0  wallet money
                        }else{
                            $data['status'] = 1;
                            $data['message'] = 'Your wallet amount is low.';
                            return response()->json(['data'=>$data], 200);  // 1 not  wallet money
                        }
                    }
                }
            }
            $data['status'] = 1;
            $data['message'] = 'User not exist';
            return response()->json(['data'=>$data], 200);
        }
    }


    public function getcallhistorymediacallist(Request $request)
    {
        $user_id = auth()->user()->id;
        $rolearray = auth()->user()->roles()->get();
        // dd($user_id);
        foreach ($rolearray as $role)
        {   
            if ($role->name == 'patient')
            {

                $Chathistory = Chathistory::select('call_history.*','users.first_name','users.ar_first_name','users.last_name','users.mobile','users.profile_pic','users.gender','clinic.name')
                ->join('users', 'call_history.doctor_id', '=', 'users.id')
                ->join('doctor_clinic', 'users.id', '=', 'doctor_clinic.user_id')
                ->join('clinic', 'doctor_clinic.clinic_id', '=', 'clinic.id')
                ->Where('call_history.userid',$user_id)
                ->orderBy('id', 'DESC')->get();
            }else{
                // echo "Asds";
                $Chathistory=Chathistory::select('call_history.*','users.first_name','users.ar_first_name','users.last_name','users.mobile','users.profile_pic','users.gender','clinic.name')
                ->join('users', 'call_history.userid', '=', 'users.id')
                ->join('doctor_clinic', 'users.id', '=', 'doctor_clinic.user_id')
                ->join('clinic', 'doctor_clinic.clinic_id', '=', 'clinic.id')
                ->Where('call_history.doctor_id',$user_id)
                ->orderBy('id', 'DESC')->get();
            }
        }
        
        return response()->json(['data'=>$Chathistory], 200);
    }
    
     public function getTermsConditionPdf(Request $request)
    {
        $path='storage/pdf/terms_condition/TermsandConditions.pdf';

        return response()->json(['data'=>$path], 200);
    }







    

}
