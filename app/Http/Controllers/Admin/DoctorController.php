<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Validator;
use Hash;
use App\Clinic;
use App\DoctorClinic;
use App\Speciality;
use App\Language;
use App\DoctorSpeciality;
use App\DoctorLanguage;
use App\DoctorEducation;
use App\DoctorExperience;
use App\DoctorDays;
use Auth;
use Config;
use Illuminate\Support\Facades\Crypt;
use App\Notifications\WelcomeUser;
use App\Helpers\Notification\SmsALa;
use App\DoctorAvailability;
use Mail;
use App\CountryCodeIso;
use App\Vat;
class DoctorController extends Controller
{
    private $clinic;
    private $doctor_clinic;
    private $user;
    private $speciality;
    private $doctor_speciality;
    private $doctor_language;
    private $doctor_days;
    public function __construct(Clinic $clinic,User $user,Speciality $speciality,DoctorClinic $doctor_clinic,Doctorspeciality $doctor_speciality,Doctorlanguage $doctor_language,DoctorEducation $doctor_education,DoctorExperience $doctor_experience,DoctorDays $doctor_days)
    {

        $this->clinic = $clinic;
        $this->doctor_clinic = $doctor_clinic;
        $this->user = $user;
        $this->speciality = $speciality;
        $this->doctor_speciality = $doctor_speciality;
        $this->doctor_language = $doctor_language;
        $this->doctor_education = $doctor_education;
        $this->doctor_experience = $doctor_experience;
        $this->doctor_days=$doctor_days;
    }

    const SUCCESS = 'success';
    /**
    * Display a listing of the states.
    *
    * @return \Illuminate\Http\Response List of states
    */

    public function index()
    {
        // $current_user = Auth::user();
        // if ($current_user->can([Config::get('constants.modules.STATE')]) == false) {
        //     return abort(401);
        // }
        return view('admin.doctor.index');
    }

    public function create()
    {
        // $current_user = Auth::user();
        // if ($current_user->can([Config::get('constants.modules.STATE')]) == false) {
        //     return abort(401);
        // }

        $page = '/admin/doctor';
        $clinics = Clinic::where('status',1)->get();
        $speciality = Speciality::where('status',1)->get();
        $language = Language::where('status',1)->get();
        $code=CountryCodeIso::get();
        $vat=Vat::first();
        return view('admin.doctor.create', compact('page','clinics','speciality','language','code','vat'));
    }

    /*
    *Store Document type data form data
    */
    public function store(Request $request)
    {
        // $current_user = Auth::user();
        // if ($current_user->can([Config::get('constants.modules.STATE')]) == false) {
        //     return abort(401);
        // }

        $this->validate($request, [
            'clinic_id' => 'required',
            'doctor_name' => 'required',
            // 'email' => 'required',
            //'mobile' => 'bail|required|numeric|digits:9',
            'mobile' => 'bail|required|numeric',
            'age' => 'required',
            'gender' => 'required',
            'description' => 'required|max:255',
            'speciality'=>'required',
            'national_id'=>'required|unique:users',
            'fees'=>'required | numeric',
            'discount'=>'numeric',
            'doctor_profile'=>'required|image',
            'ask_id'=>'required',
            'doctor_code'=>'required',

        ],
        [
                    'clinic_id.required' => 'Please enter clinic name',
                    'doctor_name.required' => 'Please enter doctor name',
                    // 'email.required' => 'Please enter email address',
                    'mobile.required' => 'Please enter mobile number',
                    'age.required' => 'Please enter age',
                    'gender.required' => 'Please select gender',
                    'description.required' => 'Please enter description',
                    'speciality.required'=>'Please enter specialty',
                    'national_id.required'=>'Please enter national id',
                    'fees.required'=>'Please enter fees',
                    'mobile.unique'=>'Mobile number has been already taken',
                    'mobile.digits'=>'Mobile number must be 9 digits long',
                    'doctor_profile.required'=>'Please upload profile picture',
                    'doctor_profile.image'=>'Please provide valid file type',
                    'doctor_profile.uploaded'=>'Please provide valid file type',
                    'ask_id.required'=>'Please enter Ask Dr Code',
                    'doctor_code.required'=>'Please enter doctor Code',
                    'national_id.unique'=>'Nationalid has been already taken'
        ]);

        // check doctor it.
        $key_id = $request->ask_id;
        $checkaskid = User::where('ask_id', $request->ask_id)->count();
        // if($checkaskid > 0){
        //     $errors = 'Ask id is already exist!';
        //     return redirect()->back()
        //             ->withInput($request->all())
        //             ->withErrors($errors);
        // }
        // dd("Asdsad");
        if ($request->file('doctor_profile')) {
            $image = $request->doctor_profile;
            $path = $image->store('doctor_profile');
        }

        $doctors = new User();
        $doctors->first_name = $request->doctor_name;
        $doctors->ar_first_name = $request->ar_doctor_name;
        // $doctors->email = $request->email;
        $doctors->email = $request->national_id;
        $doctors->national_id = $request->national_id;
        $doctors->mobile =ltrim($request->mobile, '0');
        $doctors->age = $request->age;
        $doctors->gender = $request->gender;
        $doctors->consultant = $request->consultant;
        $doctors->password = Hash::make(ltrim(request('mobile'), '0'));
        $doctors->profile_pic = isset($path) ? $path : null;
        $doctors->description = request('description');
        $doctors->ar_description = request('ar_description');
        $doctors->start_time=request('starttime');
        $doctors->fees = $request->fees;
        $doctors->commision = $request->commision;
        $doctors->discount = isset($request->discount) ? $request->discount : '0';
        $doctors->end_time=request('endtime');
        $doctors->doctor_code=request('doctor_code');
        $doctors->specialist=request('specialist');
        $doctors->countrycode=request('countrycode');
        $Clinic_NAME=Clinic::where('id',request('clinic_id'))->first();
        $clinic_name=substr($Clinic_NAME->name, 0, 3);
        // $doctors->ask_id =$clinic_name.'-'.$request->ask_id;
        $doctors->ask_id =$request->ask_id;
        $doctors->ar_askid =$request->ask_id_arabic;
        $doctors->ar_doctorcode =$request->doctor_code_ar;
        $doctors->ar_fees =$request->fees_arabic;

       


        $doctors->save();

        $doctors->attachRole(2); // 2 = Doctor

        $doctor_clinic = $this->doctor_clinic->createDoctorClinic(['clinic_id' => request('clinic_id'),'user_id' => $doctors->id]);

        if(request('speciality'))
        {
            $speciality = implode(' | ', request('speciality'));
            $specialities = request('speciality');
            foreach ($specialities as $key => $s) {
                $doctor_speciality = $this->doctor_speciality->createDoctorSpeciality(['speciality_id' => $s, 'user_id' => $doctors->id]);
            }
        }

        if(request('language'))
        {
            $language = implode(' | ', request('language'));
            $languages = request('language');
            foreach ($languages as $key => $l) {
                $doctor_language = $this->doctor_language->createDoctorLanguage(['language_id' => $l, 'user_id' => $doctors->id]);
            }
        }

        try {
            // dd($doctors);
            // $doctors->notify(new WelcomeUser($doctors));
        } catch (Exception $e) {
        }

       $institute=request('institute_name');

       $hospital=request('hospital_name');
       if($institute)
       {
            $edu = request('institute_name');
            $ar_edu = request('ar_institute_name');
            $course = request('course');
            $ar_course = request('ar_course');
            $year = request('year');
            foreach ($edu as $key => $e) {

                if($e != null)
                {
                    $doctor_edu = new DoctorEducation;
                    $doctor_edu->user_id = $e ? $doctors->id :"";
                    $doctor_edu->institute_name = $e ? $e :"";
                    $doctor_edu->ar_institute_name = $ar_edu[$key] ? $ar_edu[$key]: "";
                    $doctor_edu->course = $course[$key] ? $course[$key]: "";
                    $doctor_edu->ar_course = $ar_course[$key] ? $ar_course[$key]: "";
                    $doctor_edu->year = $year[$key] ? $year[$key]:"";
                    $doctor_edu->save();
                }

            }
       }

       if($hospital)
       {
            $hospital = request('hospital_name');
            $position = request('position');
            $ar_hospital = request('ar_hospital_name');
            $ar_position = request('ar_position');
            $number_of_year = request('number_of_year');
            foreach ($hospital as $key => $e) {
                if($e != null)
                {
                    $doctor_experience = new DoctorExperience;
                    $doctor_experience->user_id = $e ? $doctors->id :"";
                    $doctor_experience->hospital_name = $e;
                    $doctor_experience->position = $position[$key]?$position[$key]:"";
                    $doctor_experience->ar_hospital_name = $ar_hospital[$key]?$ar_hospital[$key]:"";
                    $doctor_experience->ar_position = $ar_position[$key]?$ar_position[$key]:"";
                    $doctor_experience->year = $number_of_year[$key]?$number_of_year[$key]:"";
                    $doctor_experience->save();
                }
            }
       }

       // $days=request('days');

       // if($days)
       // {
       //      $starttime = request('starttimedays');
       //      $endtime = request('endtimedays');
       //      foreach ($days as $key => $e) {
       //                  $starttime =  $e."_starttime";
       //                  $endtime =  $e."_endtime";
       //                  $DoctorDays = new DoctorDays;
       //                  $DoctorDays->user_id = $e ?$doctors->id :"";
       //                  $DoctorDays->days = $e? $e :"";
       //                  $DoctorDays->start_time = $request->$starttime;
       //                  $DoctorDays->end_time = $request->$endtime;
       //                  $DoctorDays->available ='1';
       //                  $DoctorDays->save();
       //      }
       // }

       $drav =  DoctorAvailability::where('doctor_id',$doctors->id)->first();
        if(!isset($drav)){
            $doctoravailability = new DoctorAvailability();
            $doctoravailability->doctor_id = $doctors->id;
            $doctoravailability->status = 1;
            $doctoravailability->save();
        }else{
            DoctorAvailability::where('doctor_id',$doctors->id)->update(['status'=>'1']);
        }
       // dd("asd");
        return redirect()->route('admin.doctor.index')
                      ->with(['success' =>  "Doctor Added Successfully.", 'create_sinch_user' => $doctors->mobile]);
    }

    public function doctorarray(Request $request)
    {
        $response = [];
        $doctors = User::with('roles')->whereHas('roles', function ($q) {
            $q->where('id', 2);
        })->get();

        // $doctors = $this->user->getAll();

        $doctors = $doctors->toArray();
        foreach ($doctors as $doctor) {
            $sub = [];
            $id = $doctor['id'];

            $sub[] = $id;

            $sub[] = ($doctor['first_name']) ? ucfirst($doctor['first_name']) : "-";
            $sub[] = ($doctor['email']) ? $doctor['email'] : "-";
            $sub[] = ($doctor['mobile']) ? ucfirst($doctor['mobile']) : "-";
            $sub[] = ($doctor['gender']) ? ucfirst($doctor['gender']) : "-";

            $doctor_id = Crypt::encryptString($id);

            if ($doctor['status'] == 1) {
                $verified_url = route('admin.doctor.changestatus', array($doctor_id , 0));
                $sub[] = '<a onclick="return confirm_alert(`' . $verified_url . '`,`Are you sure you want to inactive this doctor ?`)"  href="#"><span class="btn btn-success btn-sm" data-toggle="tooltip" title="click here to inactive">Active</span></a>' . ' ';
            } elseif ($doctor['status'] == 0) {
                $verified_url = route('admin.doctor.changestatus', array($doctor_id, 1));
                $sub[] = '<a onclick="return confirm_alert(`' . $verified_url . '`,`Are you sure you want to active this doctor ?`)"  href="#"><span class="btn btn-danger btn-sm" data-toggle="tooltip" title="click here to active">Inactive</span></a>' . ' ';
            }

            $delete_url = route('admin.doctor.delete', [$doctor_id]);

            $action = '<div class="btn-part"><a class="edit" href="' . route('admin.doctor.edit', $doctor_id) . '"><i class="fa fa-pencil-alt"></i></a>' . ' ';
            $action .= '<a class="delete" onclick="return confirm_alert(`' . $delete_url . '`,`Are you sure you want to delete this doctor ?`)"  href="#"><i class="fa fa-trash"></i>&nbsp;</a></div>';

            $sub[] = $action;
            $sub[] = $response[] = $sub;
        }
        $userjson = json_encode(["data" => $response]);
        echo $userjson;
    }

    public function edit($id)
    {
        // $current_user = Auth::user();
        // if ($current_user->can([Config::get('constants.modules.STATE')]) == false) {
        //     return abort(401);
        // }

        $id = Crypt::decryptString($id);
        $doctors = $this->user->getById($id);

        $doctor_clinic=$this->doctor_clinic->where('user_id',$id)->get();
        $doctor_speciality=$this->doctor_speciality->where('user_id',$id)->pluck('speciality_id')->toArray();
        $doctor_language=$this->doctor_language->where('user_id',$id)->pluck('language_id')->toArray();
        // $doctor_language=  array();
        $clinics = Clinic::where('status',1)->get();
        $speciality = Speciality::where('status',1)->get();
        $language = Language::where('status',1)->get();
        $ded=$this->doctor_education->where('user_id',$id)->count();
        $de=$this->doctor_experience->where('user_id',$id)->count();
        $doctor_days_checked=$this->doctor_days->where('user_id',$id)->pluck('days','id')->toArray();
        $doctor_days=$this->doctor_days->where('user_id',$id)->pluck('start_time','days')->toArray();
        $doctor_daysendtime=$this->doctor_days->where('user_id',$id)->pluck('end_time','days')->toArray();

        $page = '/admin/doctor';
        $code=CountryCodeIso::get();
        $vat=Vat::first();
        return view('admin.doctor.create', compact('doctors','page','clinics','speciality','doctor_clinic','doctor_speciality','doctor_language','ded','de','doctor_days','doctor_daysendtime','doctor_days_checked','language','code','vat'));
    }

    public function update(Request $request)
    {
        // dd(request('language'));
        $this->validate($request, [
            'clinic_id' => 'required',
            'doctor_name' => 'required',
            // 'email' => 'required|numeric|digits:10 ',
            //'mobile' => 'required|numeric|digits:9',
            'mobile' => 'bail|required|numeric',
            'age' => 'required',
            'gender' => 'required',
            'description' => 'required',
            'speciality'=>'required',
            'fees'=>'required | numeric',
            'discount'=>'numeric',
            'doctor_profile'=>'image',
            'ask_id'=>'required',
            'doctor_code'=>'required',
        ],[
                    'clinic_id.required' => 'Please enter clinic name',
                    'doctor_name.required' => 'Please enter doctor name.',
                    // 'email.required' => 'Please enter email address',
                    'fees.required'=>'Please enter fees',
                    'mobile.required' => 'Please enter mobile number',
                    'age.required' => 'Please enter age',
                    'gender.required' => 'Please select gender',
                    'description.required' => 'Please enter description',
                    'speciality.required'=>'Please enter specialty',
                    // 'mobile.unique'=>'Mobile number has been already taken',
                    'mobile.digits'=>'Mobile number must be 9 digits long',
                    'doctor_profile.required'=>'Please upload profile picture',
                    'ask_id.required'=>'Please enter ask dr Code',
                    'doctor_code.required'=>'Please enter doctor Code',
                    // 'doctor_profile.image'=>'Please provide valid file type',
                    // 'doctor_profile.uploaded'=>'Please provide valid file type'

        ]);
        $key_id = $request->ask_id;
        $checkaskid = User::where('ask_id', $request->ask_id)->whereNotIn( 'id', [$request->doctor_id])->count();
        // if($checkaskid > 0){
        //     $errors = 'ASK Dr code is already exist!';
        //     return redirect()->back()
        //             ->withInput($request->all())
        //             ->withErrors($errors);
        // }
            

        if (isset($request->doctor_profile)) {
            $image = $request->doctor_profile;
            $path = $image->store('doctor_profile');
        } else {
            $image = $request->hidden_image;
            $path = $image;
        }
$Clinic_NAME=Clinic::where('id',request('clinic_id'))->first();
        $clinic_name=substr($Clinic_NAME->name, 0, 3);
        $update_attributes = array(
            'first_name' => $request->doctor_name,
            'ar_first_name' => $request->ar_doctor_name,
            'email' => $request->national_id,
            'national_id' => $request->national_id,
            'mobile' => ltrim($request->mobile, '0'),
            'age' => $request->age,
            'fees' => $request->fees,
            'discount' => isset($request->discount) ? $request->discount : '0',
            'gender' => $request->gender,
            'consultant' => $request->consultant,
            'description' => $request->description,
            'ar_description' => $request->ar_description,
            'profile_pic'=>$path,
            'ask_id'=>$request->ask_id,
            'ar_askid'=>$request->ask_id_arabic,
            'commision' => $request->commision,
            'start_time'=>$request->starttime,
            'end_time'=>$request->endtime,
            'doctor_code'=>request('doctor_code'),
            'specialist'=>request('specialist'),
            'countrycode'=>$request->code,
            'ar_doctorcode'=>$request->doctor_code_ar,
            'ar_fees'=>$request->fees_arabic,
        );
        
        DoctorClinic::where('user_id',$request->doctor_id)->delete();
        $doctor_clinic = $this->doctor_clinic->createDoctorClinic(['clinic_id' => request('clinic_id'),'user_id' => $request->doctor_id]);
        

        if(request('speciality'))
        {
            $speciality = implode(' | ', request('speciality'));
            $specialities = request('speciality');

            DoctorSpeciality::where('user_id',$request->doctor_id)->delete();

            foreach ($specialities as $key => $s) {

               $doctor_speciality = $this->doctor_speciality->createDoctorSpeciality(['speciality_id' => $s, 'user_id' => $request->doctor_id]);
            }
        }
        if(request('language'))
        {

            $language = implode(' | ', request('language'));
            $languages = request('language');

            DoctorLanguage::where('user_id',$request->doctor_id)->delete();

            foreach ($languages as $key => $l) {
               $doctor_language = $this->doctor_language->createDoctorLanguage(['language_id' => $l, 'user_id' => $request->doctor_id]);
            }
        }

        $institute=request('institute_name');
        $hospital=request('hospital_name');
        if($institute)
        {
            $edu = request('institute_name');
            $ar_edu = request('ar_institute_name');
            $course = request('course');
            $ar_course = request('ar_course');
            $year = request('year');
            // dd($request->all());
            DoctorEducation::where('user_id',$request->doctor_id)->delete();

            foreach ($edu as $key => $e) {
                // dd($edu);
                if($e!=null)
                {   
                    $doctor_edu = new DoctorEducation;
                    $doctor_edu->user_id = $e ? $request->doctor_id :"";
                    $doctor_edu->institute_name = $e ? $e :"";
                    $doctor_edu->ar_institute_name = $ar_edu[$key] ? $ar_edu[$key]:"";
                    $doctor_edu->course = $course[$key] ? $course[$key]:"";
                    $doctor_edu->ar_course = $ar_course[$key] ? $ar_course[$key]:"";
                    $doctor_edu->year = $year[$key]? $year[$key]:"";
                    $doctor_edu->save();
                }

            }
        }

        if($hospital)
        {
            $hospital = request('hospital_name');
            $position = request('position');
            $ar_hospital = request('ar_hospital_name');
            $ar_position = request('ar_position');
            $number_of_year = request('number_of_year');
            DoctorExperience::where('user_id',$request->doctor_id)->delete();
            foreach ($hospital as $key => $e) {

                if($e!=null)
                {
                    $doctor_experience = new DoctorExperience;
                    $doctor_experience->user_id = $request->doctor_id;
                    $doctor_experience->hospital_name = $e ? $e :"";
                    $doctor_experience->position = $position[$key] ?$position[$key]:"";
                    $doctor_experience->ar_hospital_name = $ar_hospital[$key] ?$ar_hospital[$key]:"";
                    $doctor_experience->ar_position = $ar_position[$key] ?$ar_position[$key]:"";
                    $doctor_experience->year = $number_of_year[$key]?$number_of_year[$key]:"";
                    $doctor_experience->save();
                }
            }
        }

         // $days=request('days');

         // if($days)
         // {

         //    $days=request('days');

         //    $starttime = request('starttimedays');

         //    $endtime = request('endtimedays');

         //    DoctorDays::where('user_id',$request->doctor_id)->delete();

         //        foreach ($days as $key => $e) {

         //            $starttime =  $e."_starttime";
         //            $endtime =  $e."_endtime";
         //                $DoctorDays = new DoctorDays;
         //                $DoctorDays->user_id = $e ?$request->doctor_id :"";
         //                $DoctorDays->days = $e? $e :"";
         //                $DoctorDays->start_time = $request->$starttime;
         //                $DoctorDays->end_time = $request->$endtime;
         //                $DoctorDays->available ='1';
         //                $DoctorDays->save();
         //        }
         // }

        $user = $this->user->updateById($request->doctor_id, $update_attributes);
        $drav =  DoctorAvailability::where('doctor_id',$request->doctor_id)->first();
        if(!isset($drav)){
            $doctoravailability = new DoctorAvailability();
            $doctoravailability->doctor_id = $request->doctor_id;
            $doctoravailability->status = 1;
            $doctoravailability->save();
        }else{
            DoctorAvailability::where('doctor_id',$request->doctor_id)->update(['status'=>'1']);
        }
        // dd($user);
        return redirect()->route('admin.doctor.index')
                    ->with(self::SUCCESS, 'Doctor updated successfully.');

    }

    public function delete($id)
    {

        $doctor_id = Crypt::decryptString($id);

        $doctor_delete = $this->user->deleteById($doctor_id);
        return redirect()->route('admin.doctor.index')->with('success', 'Doctor deleted successfully.');
    }

    public function changestatus($id, $status)
    {
        // $current_user = Auth::user();
        // if ($current_user->can([Config::get('constants.modules.STATE')]) == false) {
        //     return abort(401);
        // }

        $id = Crypt::decryptString($id);
        $doctor = $this->user->getById($id);

        $update_attributes = array('status' => $status);

        $doctor_update = $this->user->updateById($id, $update_attributes);
        if ($status == 1) {
            $msg = 'Doctor is active successfully.';
        } elseif ($status == 0) {
            $msg = 'Doctor is inactive successfully.';
        }

        return redirect()->route('admin.doctor.index')->with('success', ucfirst($doctor->name)." ".$msg);
    }

    public function doctoreducation(Request $request) {

        $doctor_id = request('doctor_id');

        $doctor_education=$this->doctor_education->where('user_id',$doctor_id)->get();

        if($doctor_education)
        {
            return $doctor_education;
        }
        else
        {
            return 0;
        }
    }

    public function remove_education(Request $request) {

        $doctor_id = request('doctor_id');


        $doctor_education = $this->doctor_education->deleteById($doctor_id);

        if($doctor_education)
        {
            return 0;
        }
        else
        {
            return 1;
        }
    }

    public function doctorexperience(Request $request) {

        $doctor_id = request('doctor_id');

        $doctor_experience=$this->doctor_experience->where('user_id',$doctor_id)->get();

        if($doctor_experience)
        {
            return $doctor_experience;
        }
        else
        {
            return 0;
        }
    }

    public function remove_experience(Request $request)
    {
        $doctor_id = request('doctor_id');

        $doctor_experience = $this->doctor_experience->deleteById($doctor_id);

        if($doctor_experience)
        {
            return 0;
        }
        else
        {
            return 1;
        }
    }

    public function getdoctordays(Request $request)
    {
        $doctor_id = request('doctor_id');

        $getdoctordays=DoctorDays::where('user_id',$doctor_id)->get();

        if($getdoctordays)
        {
            return $getdoctordays;
        }
        else
        {
            return 0;
        }
    }

    public function getdoctorclinic(Request $request)
    {
        $elmId=request('elmId');

        $count=DoctorClinic::where('clinic_id',$elmId)->count();

        if($count > 0)
        {
            $count=$count+1;
        }
        else
        {
            $count=1;
        }
        return $count;


    }


    


}
