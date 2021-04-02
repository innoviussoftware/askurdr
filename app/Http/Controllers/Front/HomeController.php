<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use App\DoctorAvailability;
use App\DoctorBooking;
use App\Role;
use App\DocumentType;
use App\User;
use App\Speciality;
use App\Language;
use App\Notification;
use App\Investigation;
use App\Payment_details;
use App\Clinic;
use App\DoctorBookingForm;
use App\Paymentplan;
use App\Medicine;
use App\EmrDetails;
use App\DoctorClinic;
use App\Visit_Investigation;
use App\Visit_Prescription;
use App\Visit_Data_Prescription;
use App\Visit_Referral;
use App\DoctorSpeciality;
use App\DoctorLanguage;
use App\DoctorEducation;
use App\DoctorExperience;
use App\DoctorDays;
use App\VideoCallDocumentDetail;
use App\CountryCodeIso;
use App\Payment_history;
// use App\Chat;
use App\Messages;
use PDF;
use Auth;
use Hash;
use Validator;
use App\VideoCallRoomDetail;
use App\Notifications\DoctorBookingMail;
use App\Notifications\PatientBooking;
use App\Notifications\Activation;
use App\Helpers\Notification\PushNotification;
use Illuminate\Support\Facades\Storage;
use App\Helpers\Notification\ICD_API_Client;
use DB;
use Carbon;
use App\Helpers\SinchHelper\SinchTicketGenerator;
use App\Chathistory;
use App\Chat;
use App\ClinicWalletHistory;
use App\DoctorWallet;
use App\Vat;
use App\DoctorBill;


class HomeController extends Controller
{
    private $user;
    private $doctor_days;
    private $doctor_language;
    public function __construct(User $user,Doctorlanguage $doctor_language,DoctorDays $doctor_days)
    {
        $this->user = $user;
        $this->doctor_days=$doctor_days;
        $this->doctor_language = $doctor_language;

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function customindex(){
      // $sinch_ticket = SinchTicketGenerator::generateTicket(auth()->user()->mobile);

      $sinch_ticket = SinchTicketGenerator::generateTicket(auth()->user()->national_id);
      return view('front.index',['sinch_ticket' => $sinch_ticket]);
    }

    public function index()
    {

        $user = auth()->user();

        $id=$user->id;

        $date = date('Y-m-d');

        $time = date('g A');

        if($user->roles()->first()->id == '2')
        {
            return view('front.index');
        }
        if($user->roles()->first()->id == '3')
        {
            $labreport=Visit_Investigation::where('patient_id',$id)->count();

            $prescription=Visit_Prescription::where('patient_id',$id)->count();

            $patient_appointment = DoctorBooking::with(['doctor' => function($q){
                $q->select('id','first_name','last_name','mobile');
                $q->with(['clinic' => function($p){
                    $p->with(['clinic']);
                }]);
            }])->where('date','>=',$date)->where('patient_id',$id)->count();

            return view('front.index',['labreport'=>$labreport,'patient_appointment'=>$patient_appointment,'prescription'=>$prescription]);
        }

    }

    public function doctor_getappointment(Request $request)
    {
        return view('front.appointment.appointmentwaitinglist');
    }

    public function todayappointmentlist(Request $request)
    {
        $response=[];

        $date = date('Y-m-d');

        $time = date('H');

        $doctor_id = auth()->user()->id;

        $doctor_appointment = DoctorBooking::with(['patient' => function($q){
            $q->select('id','first_name','last_name','mobile','emr_number','profile_pic');
        }])->where('date','=',$date)->where('doctor_id',$doctor_id)->get();

        $doctor_appointments = $doctor_appointment->toArray();

        foreach ($doctor_appointments as $doctor_appointment) {

            $sub = [];

            $id = $doctor_appointment['id'];

            $sub[] = $id;

            $sub[] = ($doctor_appointment['patient']['emr_number']) ? $doctor_appointment['patient']['emr_number']: "-";

             $sub[] = ($doctor_appointment['patient']['first_name']) ? $doctor_appointment['patient']['first_name'].' '.$doctor_appointment['patient']['last_name']: "-";

            $sub[] = ($doctor_appointment['date']) ? date("d-m-Y", strtotime($doctor_appointment['date'])): "-";


            $sub[] = ($doctor_appointment['time_slot']) ? $doctor_appointment['time_slot']: "-";

            $sub[]='<a href="'.route("front.home.chat",($doctor_appointment['patient']['id']) ? $doctor_appointment['patient']['id']:'').'"><i class="fa fa-comments"></i></a>&nbsp
            <button class="btn-transparent videocall_btn" value="'.(($doctor_appointment['patient']['id']) ? $doctor_appointment['patient']['mobile']:'').'"  ><i class="fa fa-video-camera"></i></button>';

            $sub[] = $response[] = $sub;
        }
        $userjson = json_encode(["data" => $response]);

        echo $userjson;

    }

    public function waitinglist(Request $request)
    {
        $response=[];

        $doctor_id = auth()->user()->id;

        $patient=DoctorBookingForm::select('id','patient_id','doctor_id')->where('doctor_id',$doctor_id)->where('from_where',2)->with(array('patient'=>function($query){
                    $query->select('id','first_name','last_name','emr_number');
        }))->get('doctor_id','patient_id');

        $patients = $patient->toArray();

        foreach ($patients as $patient) {

            $sub = [];

            $id = $patient['id'];

            $sub[] = $id;

            $sub[] = ($patient['patient']['emr_number']) ? $patient['patient']['emr_number']: "-";

            $sub[] = ($patient['patient']['first_name']) ? $patient['patient']['first_name'] .' '. $patient['patient']['last_name']: "-";

            $sub[]='<a href="'.route("front.home.video",($patient['patient']['id']) ? $patient['patient']['id']:'').'"><i class="fa fa-video-camera"></i></a>';

            $sub[] = $response[] = $sub;
        }
        $userjson = json_encode(["data" => $response]);
        echo $userjson;

    }

    public function getappointment(Request $request)
    {
        return view('front.appointment.upcomingappointment');
    }

    public function appointmentArray(Request $request)
    {
        $response=[];
        $date = date('Y-m-d');
        $time = date('g A');
        $patient_id = auth()->user()->id;

        $patient_appointment = DoctorBooking::with(['doctor' => function($q){
            $q->select('id','first_name','last_name','mobile');
            $q->with(['clinic' => function($p){
                $p->with(['clinic']);
            }]);
        }])->where('date','>=',$date)->where('patient_id',$patient_id)->get();

        $patient_appointments = $patient_appointment->toArray();

        foreach ($patient_appointments as $patient_appointment) {

            $sub = [];

            $id = $patient_appointment['id'];

            $sub[] = $id;

            $sub[] = ($patient_appointment['doctor']['first_name']) ? $patient_appointment['doctor']['first_name'] . $patient_appointment['doctor']['last_name']: "-";

            $subclinic=[];
            foreach ($patient_appointment['doctor']['clinic'] as $patient_appointment['doctor']['clinic']) {
                      $subclinic=$patient_appointment['doctor']['clinic']['clinic']['name'];
                }
            $sub[] = ($subclinic)?$subclinic:'-';

            $sub[] = ($patient_appointment['date']) ? date("d-m-Y", strtotime($patient_appointment['date'])): "-";

            $sub[] = ($patient_appointment['time_slot']) ? $patient_appointment['time_slot']: "-";

            $sub[]='<a href="'.route("front.home.chat",($patient_appointment['doctor']['id']) ? $patient_appointment['doctor']['id']:'').'"><i class="fa fa-comments" data-toggle="modal" data-target="#yourModal"></i></a>&nbsp
            <button class="btn-transparent videocall_btn" value="'.(($patient_appointment['doctor']['id']) ? $patient_appointment['doctor']['mobile']:'').'"  ><i class="fa fa-video-camera"></i></button>';

            $sub[] = $response[] = $sub;
        }
        $userjson = json_encode(["data" => $response]);
        echo $userjson;

    }



     public function uploadcenter(Request $request)
    {
        $dt=DocumentType::where('status',1)->get();
        return view('front.uploadcenter.create',['dt'=>$dt]);
    }

    public function doctor_profile(Request $request)
    {
        $response=Speciality::where('status',1)->get();

        $doctors = User::whereHas('roles', function ($q) {
                $q->where('id', 2);
            })->with(['speciality' => function($p){
                $p->with('speciality');
            }])->with(['clinic' => function($r){
                $r->with('clinic');
            }])->with('education','experience')->where('status',1)->get();

        return view('front.doctor_profile.index',['response'=>$response,'doctors'=>$doctors]);
    }

    public function doctorfilter_profile_array(Request $request)
    {


        $response = [];

        if(request('speciality') != null || request('searchByDoctor'))
        {
            $speciality_id = request('speciality');

            $doctor = User::whereHas('speciality',function($q) use ($speciality_id){
                if(request('searchByDoctor'))
                {
                    $q->where('first_name', 'LIKE', '%' . strtolower(request('searchByDoctor')) . '%');
                }
                if(request('speciality') != null)
                {

                  $q->where('speciality_id',$speciality_id);
                }
            })->with(['speciality' => function($p){
                $p->with('speciality');
            }])->with(['education','experience'])->where('status',1)->get();

        }
        else
        {
             $doctor = User::whereHas('roles', function ($q) {
                $q->where('id', 2);
            })->with(['speciality' => function($p){
                $p->with('speciality');
            }])->with(['clinic' => function($r){
                $r->with('clinic');
            }])->with('education','experience')->where('status',1)->get();

        }


        $doctors = $doctor->toArray();

        foreach ($doctors as $doctor) {

            $sub = [];

            $id = $doctor['id'];

            $sub[] = $id;

            $sub[] = ($doctor['first_name']) ? ucfirst($doctor['first_name']).$doctor['last_name'] : "-";

            $sub[] = ($doctor['start_time']) ? $doctor['start_time'].' To '.$doctor['end_time']: "-";

            $subeducation=[];

            foreach ($doctor['education'] as $key=>$value) {
                $subeducation[]=$value['course'];
            }


            $sub[] = ($subeducation) ? implode(',',$subeducation) : "-";

            $subspeciality=[];

            foreach ($doctor['speciality'] as $doctor['speciality']) {

                $subspeciality[]=$doctor['speciality']['speciality']['name'];
            }

            $sub[] = ($subspeciality) ? implode(',',$subspeciality) : "-";

            $subexperience=[];

            foreach ($doctor['experience'] as $doctor['experience']) {

                $subexperience[]=$doctor['experience']['year'].' year';
                $subexperience[]=$doctor['experience']['position'].' at';
                $subexperience[]=$doctor['experience']['hospital_name'];



            }


            $sub[] = ($subexperience) ? implode(' ',$subexperience) : "-";

            $sub[] = '<img src="'.env('STORAGE_FILE_PATH').'/'.$doctor['profile_pic'].'" style="width:150px;height:100px;">';

            $sub[] = $response[] = $sub;
        }
        $userjson = json_encode(["data" => $response]);
        echo $userjson;

    }



     public function labresults(Request $request)
    {
        return view('front.labresults.labresults');
    }

    public function labresultsArray(Request $request)
    {

        $user_id=Auth::user();

        $id=$user_id->id;

        if($user_id->roles()->first()->id == '2')
        {
             $response = [];

             $labreport=Visit_Investigation::where('doctor_id',$id)->with('patient','doctor','investigation','uploadBy')->orderBy('id', 'desc')->get();

             $labreports = $labreport->toArray();

             foreach ($labreports as $labreport) {
                $sub = [];

                $id = $labreport['id'];

                $sub[] = $id;

                $sub[] = ($labreport['id']) ? ucfirst($labreport['id']) : "-";

                $sub[] = ($labreport['patient']) ? ucfirst($labreport['patient']['first_name']).' '.$labreport['patient']['last_name'] : "-";

                $sub[] = ($labreport['patient']) ? ucfirst($labreport['patient']['emr_number']) : "-";

                $sub[] = ($labreport['status']==1) ? '<span class="btn btn-success btn-xs" data-toggle="tooltip">Completed</span>' : '<span class="btn btn-danger btn-xs" data-toggle="tooltip">Pending</span>';

                $sub[] = ($labreport['created_at']) ? date("d-m-Y", strtotime($labreport['created_at'])) : "-";

                $sub[]='<button class="reports" value="'.$labreport['id'].'"><span class="fa fa-eye" data-toggle="modal" data-target="#yourModal"></span></button>';

                $sub[] = $response[] = $sub;
             }
             $userjson = json_encode(["data" => $response]);
             echo $userjson;
        }

        if($user_id->roles()->first()->id == '3')
        {
            $response = [];

            $labreport=Visit_Investigation::where('patient_id',$id)->with('patient','doctor','investigation','uploadBy')->orderBy('id', 'desc')->get();

            $labreports = $labreport->toArray();

            foreach ($labreports as $labreport) {
                $sub = [];

                $id = $labreport['id'];

                $sub[] = $id;

                $sub[] = ($labreport['id']) ? ucfirst($labreport['id']) : "-";

                $sub[] = ($labreport['patient']) ? ucfirst($labreport['patient']['first_name']).' '.$labreport['patient']['last_name'] : "-";

                $sub[] = ($labreport['patient']) ? ucfirst($labreport['patient']['emr_number']) : "-";

                $sub[] = ($labreport['status']==1) ? '<span class="btn btn-success btn-xs" data-toggle="tooltip">Completed</span>' : '<span class="btn btn-danger btn-xs" data-toggle="tooltip">Pending</span>';

                $sub[] = ($labreport['created_at']) ? date("d-m-Y", strtotime($labreport['created_at'])) : "-";

                $sub[]='<a href="'.env('APP_URL_WITHOUT_PUBLIC').$labreport['pdf'].'" target="_"><i class="fa fa-file-pdf-o"></i></a>';

                $sub[] = $response[] = $sub;
             }
             // dd($response);
             $userjson = json_encode(["data" => $response]);
             echo $userjson;
        }
    }

    public function prescription(Request $request)
    {
        return view('front.prescription.prescription');
    }

    public function prescriptionArray(Request $request)
    {
        $user_id=Auth::user();

        $id=$user_id->id;

        if($user_id->roles()->first()->id == '2')
        {
            $response = [];

            $prescription=Visit_Prescription::where('doctor_id',$id)->with('doctor','patient')->get();

            $prescriptions = $prescription->toArray();

            foreach ($prescriptions as $prescription) {
                $sub = [];

                $id = $prescription['id'];

                $sub[] = $id;

                $sub[] = ($prescription['id']) ? ucfirst($prescription['id']) : "-";

                $sub[] = ($prescription['patient']) ? ucfirst($prescription['patient']['first_name']) .' '. $prescription['patient']['last_name'] : "-";

                $sub[] = ($prescription['patient']) ? ucfirst($prescription['patient']['emr_number']) : "-";

                $sub[] = ($prescription['status']==0) ? '<span class="btn btn-danger btn-xs" data-toggle="tooltip">Assigned</span>' :'<span class="btn btn-success btn-xs" data-toggle="tooltip">Bought</span>' ;

                $sub[] = ($prescription['created_at']) ? date("d-m-Y", strtotime($prescription['created_at'])) : "-";

                $sub[]='<a href="'.env('APP_URL_WITHOUT_PUBLIC').$prescription['pdf'].'"" target="_"><i class="fa fa-file-pdf-o"></i></a>';

                $sub[] = $response[] = $sub;
            }

            $userjson = json_encode(["data" => $response]);

            echo $userjson;
        }
        if($user_id->roles()->first()->id == '3')
        {
            $response = [];

            $prescription=Visit_Prescription::where('patient_id',$id)->with('doctor','patient')->get();

            $prescriptions = $prescription->toArray();

            foreach ($prescriptions as $prescription) {
                $sub = [];

                $id = $prescription['id'];

                $sub[] = $id;

                $sub[] = ($prescription['id']) ? ucfirst($prescription['id']) : "-";

                $sub[] = ($prescription['patient']) ? ucfirst($prescription['patient']['first_name']) .' '. $prescription['patient']['last_name'] : "-";

                $sub[] = ($prescription['patient']) ? ucfirst($prescription['patient']['emr_number']) : "-";

                $sub[] = ($prescription['status']==0) ? '<span class="btn btn-danger btn-xs" data-toggle="tooltip">Assigned</span>' :'<span class="btn btn-success btn-xs" data-toggle="tooltip">Bought</span>' ;

                $sub[] = ($prescription['created_at']) ? date("d-m-Y", strtotime($prescription['created_at'])) : "-";

                $sub[]='<a href="'.env('APP_URL_WITHOUT_PUBLIC').$prescription['pdf'].'"" target="_"><i class="fa fa-file-pdf-o"></i></a>';

                $sub[] = $response[] = $sub;
             }

            $userjson = json_encode(["data" => $response]);
            echo $userjson;
        }
    }

    public function refferal(Request $request)
    {
        return view('front.refferal.refferal');
    }

    public function refferalArray(Request $request)
    {

        $user_id=Auth::user();

        $id=$user_id->id;

        $response = [];

        $patient=Visit_Referral::where('patient_id',$id)->where('status',1)->get();

        $patients = $patient->toArray();


        foreach ($patients as $patient) {

                $sub = [];

                $id = $patient['id'];

                $sub[] = $id;



                $sub[] = ($patient['diagnosis']) ? ucfirst($patient['diagnosis']) : "-";

                $sub[] = ($patient['doctor_name']) ? ucfirst($patient['doctor_name']) : "-";

                $sub[]='<a href="'.env('APP_URL_WITHOUT_PUBLIC').$patient['pdf'].'" target="_"><i class="fa fa-file-pdf-o"></i></a>';

                $sub[] = $response[] = $sub;
        }

        $userjson = json_encode(["data" => $response]);

        echo $userjson;
    }

    public function getrecordOfdocumentid(Request $request)
    {
        $id=request('document_id');

        $users_id=Auth::user();

        $user_id=$users_id->id;

        $recordno=Visit_Investigation::where('investigation_id',$id)->where('patient_id',$user_id)->orWhere('doctor_id',$user_id)->get();

        return json_encode($recordno);
    }

    public function updatedocumentcenter(Request $request)
    {


        // $validator = Validator::make($request->all(), [
        //             'documents' => 'required|image|mimes:jpeg,png,jpg|max:10000'
        // ]);
        // $errors = $validator->errors();
        // if ($validator->fails()) {
        //     return redirect()->back()
        // // dd($errors);
        //                     ->withInput($request->all())
        //                     ->withErrors($errors);
        //     exit;
        // }

        $id=request('reportid');


        $result=request('documents');

        $users_id=Auth::user();

        $user_id=$users_id->id;

        $uploadedby=$user_id;

        if($result)
        {

                $report_file = request('documents');

                if (is_array($report_file) || is_object($report_file))
                {

                    $allowedfileExtension=['pdf','jpg','png','jpeg'];

                    $report_file_input = [];

                    foreach ($report_file as $key => $r) {

                        $filename = $r->getClientOriginalName();
                        $extension = $r->getClientOriginalExtension();
                        $check=in_array($extension,$allowedfileExtension);
                        if($check)
                        {
                            foreach ($report_file as $key => $ro) {

                                $img = $ro;
                                $custom_file_name = 'report-'.$key.time().'.'.$img->getClientOriginalExtension();
                                $labreport = $img->storeAs('lab_report', $custom_file_name);
                                $report_file_input[] = $labreport;
                            }
                        }
                        else
                        {
                            // return redirect()->back()->with('success', );
                            return redirect()->route('front.home.uploadcenter')->with('danger', 'Sorry Only Upload png , jpg , pdf');
                        }
                        
                    }

                    $report_file_data = implode(' | ', $report_file_input);

                }

        }

        $labreport=Visit_Investigation::where('id',$id)->update([
                'result'=>isset($report_file_data)?$report_file_data:'',
                'uploaded_by'=>$uploadedby,
                'status'=> 1
        ]);

        //push notification
        $labreportdata = Visit_Investigation::where('id',$id)->first();
        $patient = User::whereId($labreportdata->patient_id)->first();
        $patient_device_id = $patient->device_id;
        if($labreportdata){
            $doctor_device_id = $users_id->device_id;
            $data = array(
                'patient_id' => $labreportdata->patient_id,
                'doctor_id' => $users_id->id,
                'notification_type' => 'Document Center'
            );
            $pmsg = array(
                'body' => 'Hello Patient, Doctor have added new Documents',
                'title' => 'New Documents Uploaded',
                'icon' => 'myicon',
                'sound' => 'mySound'
            );
            PushNotification::SendPushNotification($pmsg, $data, [$patient_device_id]);
        }

        return redirect()->route('front.home.uploadcenter')->with('success', 'Document Updated successfully.');


    }

    public function profile(Request $request)
    {

        $users=Auth::user();

        $id=$users->id;

        $code=CountryCodeIso::get();


        $paymentdetails=Payment_details::where('user_id',$id)->with('paymentplan')->first();

        $doctor_days_checked=$this->doctor_days->where('user_id',$id)->pluck('days','id')->toArray();
        $doctor_days=$this->doctor_days->where('user_id',$id)->pluck('start_time','days')->toArray();
        $doctor_daysendtime=$this->doctor_days->where('user_id',$id)->pluck('end_time','days')->toArray();

        $language = language::All();
        $doctor_language=$this->doctor_language->where('user_id',$id)->pluck('language_id')->toArray();
        return view('front.user.profile',['users'=>$users,'paymentdetails'=>$paymentdetails,'doctor_days_checked'=>$doctor_days_checked,'doctor_days'=>$doctor_days,'doctor_daysendtime'=>$doctor_daysendtime,'language' => $language,'doctor_language' => $doctor_language,'code'=>$code]);
    }

    public function profile_doctor(Request $request)
    {
        $users=Auth::user();

        $id=$users->id;

        $doctor_clinic=DoctorClinic::where('user_id',$id)->get();
        $doctor_speciality=DoctorSpeciality::where('user_id',$id)->pluck('speciality_id')->toArray();
        $clinics = Clinic::where('status',1)->get();
        $speciality = Speciality::where('status',1)->get();
        $ded=DoctorEducation::where('user_id',$id)->count();
        $de=DoctorExperience::where('user_id',$id)->count();

        return view('front.user.doctor_profile',['users'=>$users,'doctor_clinic'=>$doctor_clinic,'clinics'=>$clinics,'speciality'=>$speciality,'doctor_speciality'=>$doctor_speciality,'ded'=>$ded,'de'=>$de]);
    }

    public function updateProfile(Request $request)
    {


        $user = auth()->user();
        $this->validate($request, [
            'firstname'  => 'required|max:64',
            // 'mobile'  => 'required|numeric|digits:9|unique:users,mobile,'.$user->id,
            // 'email'=>'required|email|unique:users,email,'.$user->id,
            'mobile'  => 'required|numeric|digits_between:8,12,mobile,'.$user->id,
            'email'=>'required',
            'fees'=>'required | numeric'
        ],
        [
            'firstname.required'=>'Enter the first name',
            'mobile.required'=>'Enter the mobile number',
            'email.required' => 'Please enter email address',
            'mobile.unique'=>'Mobile number has been already taken',
            'mobile.min'=>'Mobile number minimum 8 digits long'
        ]
        );

        $user = auth()->user();

        if(request('profile'))
        {
                $img = request('profile');
                $custom_file_name = 'patient-'.time().'.'.$img->getClientOriginalExtension();
                $profile = $img->storeAs('doctor_profile', $custom_file_name);
        }

        $user = User::find($user->id);
        $user->first_name = request('firstname');
        $user->last_name = request('lastname');
        $user->post_mail = request('postermail');
        $user->fees = request('fees');
        $user->age = request('dob');
        $user->discount = request('discount');
        $user->mobile = ltrim(request('mobile'), '0');
        $user->countrycode = request('countrycode');
        // $user->language = request('language');
        if(request('profile'))
        {
                $user->profile_pic = $profile;
        }
        $user->insurance_company_name = request('insurance_company_name');
        $user->insurance_policy_no = request('insurance_policy_no');
        $user->save();
        if(request('language'))
        {      
            // dd($user->id);
            $languages = request('language');
            DoctorLanguage::where('user_id',$user->id)->delete();
            foreach ($languages as $key => $l) {
               $doctor_language = $this->doctor_language->createDoctorLanguage(['language_id' => $l, 'user_id' => $user->id]);
            }
        }

        // $days=request('days');

        //  if($days)
        //  {

        //     $days=request('days');

        //     $starttime = request('starttimedays');

        //     $endtime = request('endtimedays');

        //     DoctorDays::where('user_id',$user->id)->delete();

        //         foreach ($days as $key => $e) {

        //             $starttime =  $e."_starttime";
        //             $endtime =  $e."_endtime";
        //                 $DoctorDays = new DoctorDays;
        //                 $DoctorDays->user_id = $e ?$user->id :"";
        //                 $DoctorDays->days = $e? $e :"";
        //                 $DoctorDays->start_time = $request->$starttime;
        //                 $DoctorDays->end_time = $request->$endtime;
        //                 $DoctorDays->available ='1';
        //                 $DoctorDays->save();
        //         }
        //  }

        // return redirect()->route('front.home.dashboard')->with('success', 'Profile Updated successfully.');
        return redirect()->route('front.home.dashboard');
    }

    public function changepassword(Request $request)
    {
        return view('front.user.changepassword');
    }

    public function passwordchange(Request $request)
    {
        $validator = Validator::make($request->all(), [
                    'oldpassword' => 'required',
                    'newpassword' => 'bail|required|min:6|max:16',
                    'repassword' => 'bail|required|min:6|max:16|same:newpassword'
        ],[
                    'oldpassword.required' => 'Please enter old password',
                    'newpassword.required' => 'Please enter new password',
                    'repassword.required' => 'Please enter retype password',
                    'newpassword.min'=>'Your new password length must be at least 6 digit',
                    'newpassword.max'=>'Newpassword maximum 16 digits allowed',
                    'repassword.min'=>'Your confirmpassword length must be at least 6 digit',
                    'repassword.max'=>'Confirmpassword maximum 16 digits allowed',
                    'repassword.same'=>'Confirm password and new password is not matched'
        ]);
        $errors = $validator->errors();
        if ($validator->fails()) {
            return redirect()->back()
                            ->withInput($request->all())
                            ->withErrors($errors);
            exit;
        }

        $current_user = auth()->user();

        $user = User::find($current_user->id);
        if (!Hash::check($request->oldpassword, $user->password)) {
            return redirect()->back()
                            ->withInput($request->all())
                            ->withErrors(['Old password did not match.']);
            exit;
        }

        $password = Hash::make(request('repassword'));

        $update_attributes['password'] = $password;


        $user_id=$current_user->id;

        $user = $this->user->updateById($user_id, $update_attributes);

        return redirect()->route('front.home.dashboard')
                    ->with('success', 'Password changed successfully.');
    }

    public function investigation(Request $request)
    {
        return view('front.investigation.investigation');
    }

    public function labreportstypearray(Request $request)
    {
        $users_id=Auth::user();

        $user_id=$users_id->id;

        $response = [];

        $investigation=Investigation::where('type_id','1')->pluck('id')->toArray();


        $labreport=Visit_Investigation::whereIn('investigation_id',$investigation)->where('doctor_id',$user_id)->with('patient','doctor')->orderBy('id', 'desc')->get();

        $labreports = $labreport->toArray();

        foreach ($labreports as $labreport) {

                $sub = [];

                $id = $labreport['id'];

                $sub[] = $id;

                $sub[] = ($labreport['id']) ? ucfirst($labreport['id']) : "-";

                $sub[] = ($labreport['patient']) ? ucfirst($labreport['patient']['first_name']).' '.$labreport['patient']['last_name'] : "-";

                $sub[] = ($labreport['patient']) ? ucfirst($labreport['patient']['emr_number']) : "-";

                $sub[] = ($labreport['status']==1) ? '<span class="btn btn-success btn-xs" data-toggle="tooltip">Completed</span>' : '<span class="btn btn-danger btn-xs" data-toggle="tooltip">Pending</span>';

                $sub[] = ($labreport['created_at']) ? date("d-m-Y", strtotime($labreport['created_at'])) : "-";

                $sub[]='<button class="reports" value="'.$labreport['id'].'"><span class="fa fa-eye" data-toggle="modal" data-target="#yourModal"></span></button>';

                $sub[] = $response[] = $sub;
             }
             $userjson = json_encode(["data" => $response]);
             echo $userjson;
    }

    public function xrayreportsarray(Request $request)
    {
        $users_id=Auth::user();

        $user_id=$users_id->id;

        $response = [];

        $investigation=Investigation::where('type_id','2')->pluck('id')->toArray();


        $labreport=Visit_Investigation::whereIn('investigation_id',$investigation)->where('doctor_id',$user_id)->with('patient','doctor')->orderBy('id', 'desc')->get();

        $labreports = $labreport->toArray();

        foreach ($labreports as $labreport) {

                $sub = [];

                $id = $labreport['id'];

                $sub[] = $id;

                $sub[] = ($labreport['id']) ? ucfirst($labreport['id']) : "-";

                $sub[] = ($labreport['patient']) ? ucfirst($labreport['patient']['first_name']).' '.$labreport['patient']['last_name'] : "-";

                $sub[] = ($labreport['patient']) ? ucfirst($labreport['patient']['emr_number']) : "-";

                $sub[] = ($labreport['status']==1) ? '<span class="btn btn-success btn-xs" data-toggle="tooltip">Completed</span>' : '<span class="btn btn-danger btn-xs" data-toggle="tooltip">Pending</span>';

                $sub[] = ($labreport['created_at']) ? date("d-m-Y", strtotime($labreport['created_at'])) : "-";

                $sub[]='<button class="reports" value="'.$labreport['id'].'"><span class="fa fa-eye" data-toggle="modal" data-target="#yourModal"></span></button>';

                $sub[] = $response[] = $sub;
             }
             $userjson = json_encode(["data" => $response]);
             echo $userjson;
    }

    public function bookAppointment(Request $request)
    {
        $clinics=Clinic::where('status',1)->get();

        return view('front.appointment.bookappointment',['clinics'=>$clinics]);
    }

    public function clinicwisedoctor(Request $request)
    {
        $id=request('id');

        $doctor = User::select('id','first_name','last_name')->whereHas('clinic',function($q) use ($id){
                $q->where('clinic_id',$id);
            })->where('status',1)->get();

        return json_encode($doctor);
    }

    public function doctor_details(Request $request)
    {
        $doctor_id=request('doctor_id');

        $doctors = User::whereId($doctor_id)->with(['clinic' => function($q){
            $q->with('clinic');
        }])->with(['speciality' => function($p){
            $p->with('speciality');
        }])->with('education','experience')->first();


        $labreports = $doctors->toArray();


        $html  ='';
        $html .='
                <div class="row">
                <div class="col-md-8 col-sm-12">
                <center><img src="'.env('STORAGE_FILE_PATH').'/'.$labreports['profile_pic'].'" class="img-responsive img-circle" width="150px;height:100px;"/></center>
                <h3><center>'.$labreports['first_name'].' '.$labreports['last_name'].'</center></h3>';
                foreach ($labreports['education'] as $labreport['education']) {
                        $html .='<p><center>'.$labreport['education']['course'].',</center></p>';
                }

                foreach ($labreports['speciality'] as $labreport['speciality']) {
                        $html .='<p><center>'.$labreport['speciality']['speciality']['name'].',</center></p>';
                }
        $html .='<p><center>'.$labreports['description'].'</center></div></div>
            <div class="row">
              <div class="col-md-8 col-sm-2">
                <form class="form-horizontal validate_form" id="filter_form" method="POST" action="'.route('front.home.bookpage').'">
                 '.csrf_field() .'
                 <input type="hidden" name="doctor_id" value="'.$doctor_id.'">
                  <div class="col-md-4 col-sm-4" style="padding-top:1em;padding-bottom: 0.5em;">
                      <input type="text" id="datecurrent" placeholder="Select Date" name="datecurrent" class="form-control datepicker" required="true" autocomplete="off">
                  </div>

                  <div class="col-md-4 col-sm-4" style="padding-top:1em;padding-bottom: 0.5em;">
                      <input type="text " id="currenttime" name="currenttime" class="form-control timepicker"  required="true" placeholder="Select Time" autocomplete="off">
                  </div>

                  <div class="col-md-4 col-sm-4" style="padding-top:1em;padding-bottom: 0.5em;">
                      <button type="submit" class="btn btn-primary">Book Appointment</button>
                  </div>

                </form>
              </div>

            </div>';

        return $html;

    }

    public function book_page(Request $request)
    {

        $doctor_id= request('doctor_id');

        $date = date('Y-m-d',strtotime(request('datecurrent')));

        $time = request('currenttime');

        return view('front.appointment.booknow',['doctor_id'=>$doctor_id,'date'=>$date,'time'=>$time]);
    }

    public function bookingAppointment(Request $request)
    {
        $id=Auth::user()->id;

        $check_doctor_booking = DoctorBooking::where('doctor_id',request('doctor_id'))->where('date',request('date'))->where('time',request('time'))->count();

        if($check_doctor_booking  > 3)
        {
            $report_file_data = '';

            if(request('report_file'))
            {

                    $report_file = request('report_file');

                    $report_file_input = [];

                    foreach ($report_file as $key => $r) {
                        $img = $r;
                        $custom_file_name = 'patient-'.$key.time().'.'.$img->getClientOriginalExtension();
                        $profile = $img->storeAs('patient_report', $custom_file_name);
                        $report_file_input[] = $profile;
                    }

                    $report_file_data = implode(' | ', $report_file_input);
            }

            $doctor_booking_form = new DoctorBookingForm;
            $doctor_booking_form->patient_id = $id;
            $doctor_booking_form->doctor_id = request('doctor_id');
            $doctor_booking_form->reason = request('reason');
            $doctor_booking_form->description = request('description');
            $doctor_booking_form->report = request('report');
            $doctor_booking_form->booking_id=0;
            $doctor_booking_form->report_file = $report_file_data;
            $doctor_booking_form->from_where=2;
            $doctor_booking_form->save();
            return redirect()->route('front.home.dashboard')->with('alert', 'Updated!');
        }
        else
        {
            if($check_doctor_booking == 0)
            {
                $appointment_date = date('g:i A',strtotime(request('time')));
            }
            if($check_doctor_booking == 1)
            {
                $appointment_date = date('g:i A',strtotime('+15 minutes',strtotime(request('time'))));
            }
            if($check_doctor_booking == 2)
            {
                $appointment_date = date('g:i A',strtotime('+30 minutes',strtotime(request('time'))));
            }
            if($check_doctor_booking == 3)
            {
                $appointment_date = date('g:i A',strtotime('+45 minutes',strtotime(request('time'))));
            }

            $doctor_booking = new DoctorBooking();
            $doctor_booking->doctor_id = request('doctor_id');
            $doctor_booking->patient_id = $id;
            $doctor_booking->date = request('date');
            $doctor_booking->time = request('time');
            $doctor_booking->time_slot = $appointment_date;
            $doctor_booking->save();
            $booking_id=$doctor_booking->id;

            $report_file_data = '';

            if(request('report_file'))
            {

                    $report_file = request('report_file');

                    $report_file_input = [];

                    foreach ($report_file as $key => $r) {
                        $img = $r;
                        $custom_file_name = 'patient-'.$key.time().'.'.$img->getClientOriginalExtension();
                        $profile = $img->storeAs('patient_report', $custom_file_name);
                        $report_file_input[] = $profile;
                    }

                    $report_file_data = implode(' | ', $report_file_input);
            }


            $doctor_booking_form = new DoctorBookingForm;
            $doctor_booking_form->patient_id = $id;
            $doctor_booking_form->doctor_id = request('doctor_id');
            $doctor_booking_form->reason = request('reason');
            $doctor_booking_form->description = request('description');
            $doctor_booking_form->report = request('report');
            $doctor_booking_form->booking_id=$booking_id;
            $doctor_booking_form->report_file = $report_file_data;
            $doctor_booking_form->from_where=1;
            $doctor_booking_form->save();


            $doctor = User::whereId(request('doctor_id'))->first();

            $patient = User::whereId($id)->first();

            $doctor_device_id = $doctor->device_id;

            $data = array(
                'patient_id' => $patient->id,
                'doctor_id' => $doctor->id,
                'notification_type' => 'Booking'
            );

            $doctor_msg = array('message' => 'Hello '.$doctor->first_name.', You have new appointment booking request from '.$patient->first_name.' '.$patient->last_name.' at '.request('date').' '.$appointment_date, 'data' => $data);

            $pmsg = array(
                'body' => 'Hello '.$doctor->first_name.', You have new appointment booking request from '.$patient->first_name.' '.$patient->last_name.' at '.request('date').' '.$appointment_date,
                'title' => 'New appointment Booking',
                'icon' => 'myicon',
                'sound' => 'mySound'
            );

            PushNotification::SendPushNotification($pmsg, $doctor_msg, [$doctor_device_id]);

            $create_notification = new Notification;
            $create_notification->from_id = $patient->id;
            $create_notification->to_id = request('doctor_id');
            $create_notification->message = 'Hello '.$doctor->first_name.', You have new appointment booking request from '.$patient->first_name.' '.$patient->last_name.' at '.request('date').' '.$appointment_date;
            $create_notification->save();

            try {
               $patient->notify(new PatientBooking($patient,$doctor,$doctor_booking,$appointment_date));
               $doctor->notify(new DoctorBookingMail($doctor,$patient,$doctor_booking,$appointment_date));
            } catch (Exception $e) {
            }
            return redirect()->route('front.home.dashboard');
        }
    }

    public function getemr(Request $request)
    {
        return view('front.emr.addemr');
    }

     public function register(Request $request)
    {
        return view('front.user.register');
    }

    public function refreshCaptcha()
    {
        return response()->json(['captcha'=> captcha_img()]);
    }

    public function submitregister(Request $request)
    {
        $this->validate($request, [
                   'first_name'  => 'required|max:64',
                   'last_name'  => 'required|max:64',
                   'date_of_birth'=>'required',
                   'email' => 'required|email|unique:users',
                   'post_mail' => 'required',
                   'password'  => 'required|min:8|max:14',
                   'confirmpassword'=>'required|min:8|max:14',
                   'mobile'  => 'required',
                   'gender'=>'required',
                   'language'=>'required',
                   'captcha'=>'required|captcha',
        ],
        [
            'firstname.required'=>'Enter the first name',
            'last_name.required'=>'Enter the last name',
            'date_of_birth'=>'Enter the date of birth',
            'email.required'=>'Enter the email',
            'post_mail.required'=>'Enter the poster email',
            'mobile.required'=>'Enter the mobile number',
            'password.required'=>'Enter the password',
            'password.min'=>'Enter the password mininum of 8 characters',
            'password.max'=>'Enter the password maximum of 14 characters',
            'confirmpassword.required'=>'Enter the password',
            'confirmpassword.min'=>'Enter the password mininum of 8 characters',
            'confirmpassword.max'=>'Enter the password maximum of 14 characters',
            'gender'=>'Select the gender',
            'language'=>'Select the language',
            'captcha'=>'Enter the captcha from image',
        ]
        );

            $job_max_id = User::max('id');

            $emr_number = str_pad($job_max_id + 1, 7, '0', STR_PAD_LEFT);

            $user = new User();
            $user->first_name = request('first_name');
            $user->last_name = request('last_name');
            $user->email = request('email');
            $user->post_mail = request('post_mail');
            $user->mobile = request('mobile');
            $user->password = Hash::make(request('password'));
            $user->gender = strtolower(request('gender'));
            $user->date_of_birth = request('date_of_birth');
            $user->language = request('language');
            $user->insurance_company_name = request('insurance_company_name');
            $user->insurance_policy_no = request('insurance_policy_no');
            $user->emr_number = $emr_number;
            if(request('Membership')=='on')
            {
                $user->is_insurance=1;
            }
            else
            {
                $user->is_insurance=0;
            }
            $user->status=0;
            $user->save();
            $user->attachRole(3); // 3 = Patient

            try {
                    $user->notify(new Activation($user));
            } catch (Exception $e) {
            }



            return redirect()->route('home.paymentplan')
                    ->with('success', 'Register successfully.');

    }

    public function paymentplan(Request $request)
    {
        $packages=Paymentplan::where('status',1)->get();

        return view('front.user.paymentplan',['packages'=>$packages]);
    }

    public function getpatientlistforemr(Request $request)
    {
        $users_id=Auth::user();

        $user_id=$users_id->id;

        // $patients=DoctorBooking::where('doctor_id',$user_id)->get();

        $patients=EmrDetails::where('doctor_id',$user_id)->get();

        foreach ($patients as $value) {

                $patient[]=$value->patient_id;
        }
        if(isset($patient))
        {
             $patients = User::whereIn('id', $patient)->get();
        }

        // dd($patients);
        $patients = $patients->toArray();

        foreach ($patients as $patient) {

                    $sub = [];

                    $id = $patient['id'];

                    $sub[] = $id;

                    $sub[] = ($patient['emr_number']) ? ucfirst($patient['emr_number']) : "-";

                    $sub[] = ($patient['first_name']) ? ucfirst($patient['first_name']).' '. $patient['last_name'] : "-";


                    $delete_url = route('front.home.emrdelete', [$id]);

                    $action = '<div class="btn-part"><a class="edit" href="' . route('front.home.emrdetails',$id) . '"><i class="fa fa-plus"></i></a>' . ' </div>';


                    $sub[] = $action;

                    $sub[] = $response[] = $sub;
        }
        $userjson = json_encode(["data" => isset($response)?$response:'']);
        echo $userjson;



    }
    public function getemrdetails(Request $request,$id)
    {
        return view('front.emr.emrdetails',['patient_id'=>$id]);
    }
    public function getemrdetailsarray(Request $request,$id)
    {
        $response = [];

        $users_id=Auth::user();

        $user_id=$users_id->id;

        $emrDetails=EmrDetails::where('doctor_id',$user_id)->where('patient_id',$id)->with('investigation','prescription','refrerral','doctorbooking')->get();

        $emrDetails = $emrDetails->toArray();

        foreach ($emrDetails as $emrDetail) {

                $sub = [];

                $id = $emrDetail['id'];

                $sub[] = $id;

                $sub[] = ($emrDetail['type_visit']) ? ucfirst($emrDetail['type_visit']) : "-";
                if($emrDetail['visit_status']==1)
                {
                    $sub[] = '<div class="btn-part"><span class="btn btn-success btn-xs" data-toggle="tooltip">Closed</span></div>';
                }
                if($emrDetail['visit_status']==0)
                {
                    $sub[] = '<div class="btn-part"><span class="btn btn-danger btn-xs" data-toggle="tooltip">Open</span></div>';
                }


                $delete_url = route('front.home.emrdelete', [$id]);

                $action = '<div class="btn-part"><a class="edit" href="' . route('front.home.emredit',$id) . '"><i class="fa fa-edit"></i></a>' . ' </div>';


                $sub[] = $action;

                $sub[] = $response[] = $sub;
             }
             $userjson = json_encode(["data" => $response]);
             echo $userjson;


    }

    public function newAddEmr(Request $request)
    {
        $patients = User::with('roles')->whereHas('roles', function ($q) {
            $q->where('id', 3);
        })->get();

        $medicines = Medicine::where('status',1)->get();

        $investigations=Investigation::where('status',1)->get();

        $specialitys=Speciality::where('status',1)->get();

        $documentType=DocumentType::where('status',1)->get();

        return view('front.emr.newaddemr',['patients'=>$patients,'medicines'=>$medicines,'investigations'=>$investigations,'specialitys'=>$specialitys,'documentType'=>$documentType]);
    }

    public function newemrStore(Request $request)
    {
        $users_id=Auth::user();

        $user_id=$users_id->id;

        $this->validate($request, [
                  // 'physicannote'  => 'required',
                  'physicandiagnosis'  => 'required',

            ],
            [
                // 'physicannote.required'=>'Enter the physican note',
                'physicandiagnosis.required'=>'Enter the physican diagnosis',

            ]
            );
            // if ($validator->fails()) {
            //     $errorMessage = $validator->errors()->all();
            //     return response()->json(['errors' => $errorMessage], 422);
            // } else{
                $bookingfrom_id=request('bookingform_id');
            $EmrDetails=new EmrDetails();
            $EmrDetails->type_visit='First Visit';
            $EmrDetails->patient_id=request('patients');
            $EmrDetails->doctor_id=$user_id;
            $EmrDetails->emr_no=request('emrno');
            $EmrDetails->physican_note=request('physicannote');
            $EmrDetails->physican_diagonis_id=request('physicandiagnosis');
           // $EmrDetails->doctorbookingform_id=isset($bookingfrom_id)?$bookingfrom_id:'0';
            $EmrDetails->save();

            $emr_lastId = $EmrDetails->id;
////////////

             $doctors=User::where('id',$user_id)->first();

                $fees=isset($doctors)?$doctors->fees:'';//Doctor Fees 

                $commission_final=isset($doctors)?$doctors->commision:'';//Doctor Commission 

                $discount=isset($doctors)?$doctors->discount:'';//Doctor Discount 

                

                $vats=Vat::first();

                $vat=isset($vats)?$vats->vat:'5';

                if($discount > 0)
                {
                    $feesdiscount=$fees*$discount/100;   
                    $discountprice=$fees-$feesdiscount;
                    $vat=$discountprice*$vat/100; //Vat Is Here 5%;
                    $total_fees=$vat+$discountprice;
                    $total_fees_with_vat=$total_fees;
                }
                else{
                    $vat=$fees*$vat/100; //Vat Is Here 5%;
                    $total_fees_with_vat=$vat+$fees;
                }
            
                $doctor_commission=$total_fees_with_vat*$commission_final/100;

                $patient_wallet=User::where('id',request('patients'))->first();//Patient Wallet Money

                $patient_wallet_money=isset($patient_wallet)?$patient_wallet->wallet_money:'';
                
                if($fees <= $patient_wallet_money)
                {   

                    if($total_fees_with_vat >= $patient_wallet_money)
                    {
                        $update_patient_wallet_money=$total_fees_with_vat-$patient_wallet_money;
                    }
                    else
                    {
                        $update_patient_wallet_money=$patient_wallet_money-$total_fees_with_vat;
                    }//Update Wallet Money Patient

                    $patient_wallet=User::where('id',request('patients'))->update(['wallet_money'=>$update_patient_wallet_money]);//Update Patient Wallet

                    $clinic_wallet=DoctorClinic::where('user_id',$user_id)->first();//Doctor Clinic

                    $clinic=Clinic::where('id',isset($clinic_wallet)?$clinic_wallet->clinic_id:'')->first();//Clinic Wallet Money

                    if($clinic)
                    {
                        $clinic_name=isset($clinic->name)?$clinic->name:'';

                        if($clinic_name=='Ask' || $clinic_name=='ask')
                        {

                            $clinic_wallet_money=isset($clinic)?$clinic->wallet_money:'';

                            $update_clinic_money=$clinic_wallet_money+$doctor_commission;

                            $restdr_money=$total_fees_with_vat-$doctor_commission;

                            $clinic_wallets=Clinic::where('id',isset($clinic_wallet)?$clinic_wallet->clinic_id:'')->update(['wallet_money'=>$update_clinic_money]);//Update Patient 

                            $wallets=User::where('id',$user_id)->first();
                            if($wallets)
                            {
                                $totalMoney=$wallets->wallet_money+$restdr_money;
                            }
                            else
                            {
                                $totalMoney=$restdr_money;
                            }
                            

                            $patient_wallets=User::where('id',$user_id)->update(['wallet_money'=>$totalMoney]);

                            $ClinicWalletHistory=new DoctorWallet;
                            $ClinicWalletHistory->doctor_id=$user_id;
                            $ClinicWalletHistory->commission=$doctor_commission;
                            $ClinicWalletHistory->amount=$restdr_money;
                            $ClinicWalletHistory->save();

                            //$doctors=User::where('id',request('patient_id'))->update(['wallet_money'=>$fees]);
                        }
                        else
                        {


                            $askclinic_wallet=Clinic::where('name','=','Ask')->first();
     
                            $clinic_wallet_money=isset($askclinic_wallet)?$askclinic_wallet->wallet_money:'';

                            $update_askmoney=$clinic_wallet_money+$doctor_commission;

                            $askclinic_wallets=Clinic::where('id',isset($askclinic_wallet)?$askclinic_wallet->clinic_id:'')->update(['wallet_money'=>$update_askmoney]);//Update Patient 

                            if(isset($askclinic_wallet))
                            {
                                    $ClinicWalletHistory=new ClinicWalletHistory;
                                    $ClinicWalletHistory->clinic_id=$askclinic_wallet->id;
                                    $ClinicWalletHistory->commission=$doctor_commission;
                                    $ClinicWalletHistory->doctor_id=$user_id;
                                    $ClinicWalletHistory->amount=$doctor_commission;
                                    $ClinicWalletHistory->save();
                            }
                            
                            $restdr_money=$total_fees_with_vat-$doctor_commission;

                            $clinic_wallet_money=isset($clinic)?$clinic->wallet_money:'';

                            $update_clinic_money=$clinic_wallet_money+$doctor_commission;

                            $clinic_wallets=Clinic::where('id',isset($clinic_wallet)?$clinic_wallet->clinic_id:'')->update(['wallet_money'=>$restdr_money]);//Update Patient 
                            // $ClinicWalletHistory=new ClinicWalletHistory;
                            // $ClinicWalletHistory->clinic_id=isset($clinic_wallet)?$clinic_wallet->clinic_id:'';
                            // $ClinicWalletHistory->commission=$doctor_commission;
                            // $ClinicWalletHistory->doctor_id=request('doctor_id');
                            // $ClinicWalletHistory->save();

                            if(isset($clinic_wallet))
                            {
                                $ClinicWalletHistory=new ClinicWalletHistory;
                                $ClinicWalletHistory->clinic_id=$clinic_wallet->clinic_id;
                                $ClinicWalletHistory->commission=$doctor_commission;
                                $ClinicWalletHistory->doctor_id=$user_id;
                                $ClinicWalletHistory->amount=$restdr_money;
                                $ClinicWalletHistory->save();
                            }


                        }
                    }

                        }

                    $payment_history = new Payment_history;
                    $payment_history->user_id = request('patients');      // user
                    $payment_history->user_id2 = $user_id;  // doctor
                    $payment_history->price = $total_fees_with_vat;
                    $payment_history->message = "Pay fees of doctor SAR".$total_fees_with_vat;
                    $payment_history->save();

                    $doctorbill=new DoctorBill;
                    $doctorbill->patient_id=request('patients');
                    $doctorbill->doctor_id=$user_id;
                    $doctorbill->clinic_id=isset($clinic_wallet)?$clinic_wallet->clinic_id:'-';
                    $doctorbill->doctor_fees=$fees;
                    $doctorbill->discount_fees=isset($discountprice)?$discountprice:'-';
                    $doctorbill->vat_fees=$total_fees_with_vat;
                    $doctorbill->emr_id=$emr_lastId;
                    $doctorbill->vat=$vat;
                    $doctorbill->bill_no=mt_rand(100000,999999);
                    $doctorbill->Audio_video_type='emr add';
                    $doctorbill->save();

                     $doctorbillid = $doctorbill->id;

                    //Report Bill
                    $path = 'storage/pdf/bill/' .$doctorbillid. '_bill.pdf';

                    $receiver_name = User::whereId(request('patients'))->first();

                    $doctor_name = User::whereId($user_id)->first();

                    $receiver_device_id = isset($receiver_name)?$receiver_name->device_id:'';

                    $receiver_fname=isset($receiver_name)?$receiver_name->first_name:'';

                    $receiver_lname=isset($receiver_name)?$receiver_name->last_name:'';

                    $dr_fname=isset($doctor_name)?$doctor_name->first_name:'';

                    $dr_lname=isset($doctor_name)?$doctor_name->last_name:'';

                    $dr_code=isset($doctor_name)?$doctor_name->ask_id:'';

                    $emr=EmrDetails::where('id',$emr_lastId)->first();

                    $pdf = PDF::loadView('admin.Bill.visitbill',compact('receiver_fname','receiver_lname','dr_fname','dr_lname','doctorbill','emr','dr_code'))->save($path);

                    DoctorBill::where('id',$doctorbillid)->update(array('pdf'=>$path));

                    $data = array(
                        'sender_id' => isset($doctor_name)?$doctor_name->id:'',
                        'receiver_id' => isset($receiver_name)?$receiver_name->id:'',
                        'notification_type' => 'investigation'
                    );
                
                    $doctor_msg = array('message' => 'Hello '.$receiver_fname.' '.$receiver_lname.', Dr.'.$dr_fname.''.$dr_lname.' Sent you bill', 'data' => $data);

                    $pmsg = array(
                            'body' => 'Hello '.$receiver_fname.' '.$receiver_lname.', Dr.'.$dr_fname.''.$dr_lname.' Sent you bill',
                            'title' => isset($doctor_name)?'Message From Dr.'.$doctor_name->first_name.' '.$doctor_name->last_name:'',
                            'icon' => 'myicon',
                            'sound' => 'mySound'
                     );

                    PushNotification::SendPushNotification($pmsg, $doctor_msg, [$receiver_device_id]);

                    //End Report Bill



//////////////

            $emr_lastId = $EmrDetails->id;
            $medicines=request('medicines');
            
            if(!empty($medicines[0]))
            {
                $id=request('medicines');
                $medicine_name=Medicine::select('name')->whereIn('id',$id)->get();

                $dose = request('dose');
                $dosetype = request('dosetype');
                $frequency1 = request('frequency1');
                $frequency2 = request('frequency2');
                $frequency3 = request('frequency3');
                $duration = request('duration');
                $route = request('route');
                $visit_prescription = new Visit_Prescription;
                $visit_prescription->emr_id= $emr_lastId?$emr_lastId:'';
                $visit_prescription->patient_id = request('patients') ? request('patients'): "";
                $visit_prescription->doctor_id = $user_id ?$user_id:"";
                $visit_prescription->save();
                $visit_prescriptionid = $visit_prescription->id;

                foreach ($medicines as $key => $e) {

                    if($e != null)
                    {
                        if($e=='others')
                        {
                                $medicinestext=request('medicinestext');

                                            $medicine = new Medicine;
                                            $medicine->name=$medicinestext[$key]?$medicinestext[$key]:"0";
                                            $medicine->dose = $dose[$key] ? $dose[$key]: "0";
                                            $medicine->unit = $dosetype[$key] ? $dosetype[$key]:"";
                                            $medicine->frequency = $frequency1[$key] ? $frequency1[$key]:"0";
                                            $medicine->frequency2 = $frequency2[$key] ? $frequency2[$key]: "0";
                                            $medicine->frequency3 = $frequency3[$key] ? $frequency3[$key]:"0";
                                            $medicine->duration = $duration[$key] ? $duration[$key]: "";
                                            $medicine->route = $route[$key] ? $route[$key]: "";
                                            $medicine->save();
                                            $e = $medicine->id;
                                            $visit_data_prescription = new Visit_Data_Prescription;
                                            $visit_data_prescription->visit_prescription_id =isset($visit_prescription->id)?$visit_prescription->id:'';


                                            $visit_data_prescription->medicine_id = $e ? $e:"";
                                            $medicine_name=Medicine::select('name')->where('id',$e)->first();
                                            $visit_data_prescription->medicine_name = isset($medicine_name)?$medicine_name->name:'';
                                            $visit_data_prescription->dose = $dose[$key] ? $dose[$key]: "0";
                                            $visit_data_prescription->unit = $dosetype[$key] ? $dosetype[$key]:"";
                                            $visit_data_prescription->frequency = $frequency1[$key] ? $frequency1[$key]:"0";
                                            $visit_data_prescription->frequency2 = $frequency2[$key] ? $frequency2[$key]: "0";
                                            $visit_data_prescription->frequency3 = $frequency3[$key] ? $frequency3[$key]:"0";
                                            $visit_data_prescription->duration = $duration[$key] ? $duration[$key]: "";
                                            $visit_data_prescription->route = $route[$key] ? $route[$key]: "";
                                            $visit_data_prescription->save();     
                                                           
                        }
                        else{
                            $visit_data_prescription = new Visit_Data_Prescription;
                            $visit_data_prescription->visit_prescription_id =isset($visit_prescription->id)?$visit_prescription->id:'';
                            $visit_data_prescription->medicine_id = $e ? $e:"";
                            $medicine_name=Medicine::select('name')->where('id',$e)->first();
                            $visit_data_prescription->medicine_name = $medicine_name->name;
                            $visit_data_prescription->dose = $dose[$key] ? $dose[$key]: "0";
                            $visit_data_prescription->unit = $dosetype[$key] ? $dosetype[$key]:"";
                            $visit_data_prescription->frequency = $frequency1[$key] ? $frequency1[$key]:"0";
                            $visit_data_prescription->frequency2 = $frequency2[$key] ? $frequency2[$key]: "0";
                            $visit_data_prescription->frequency3 = $frequency3[$key] ? $frequency3[$key]:"0";
                            $visit_data_prescription->duration = $duration[$key] ? $duration[$key]: "";
                            $visit_data_prescription->route = $route[$key] ? $route[$key]: "";
                            $visit_data_prescription->save();    
                        }
                        
                        // $visit_id = $visit_data_prescription->id;

                    }

                }
                $visit_prescription_data =Visit_Data_Prescription::where('visit_prescription_id', $visit_prescriptionid)->get();


                $doctor_name=User::where('id',$user_id)->first();
                        $patient_name=User::where('id',request('patients'))->first();

                $path = 'storage/pdf/prescription/' .$visit_prescriptionid. '_labereport.pdf';
                $clinic=DoctorClinic::where('user_id',$user_id)->with('clinic')->first();
                $visit_medicine=Visit_Prescription::where('patient_id', request('patients'))->with('medicine','doctor','clinic')->get();


                $pdf = PDF::loadView('admin.patient.visit_pdf',compact('visit_prescription','visit_prescription_data','clinic','doctor_name','patient_name'))->save($path);

                Visit_Prescription::where('id',$visit_prescriptionid)->update(array('pdf'=>$path))  ;
                // dd($visit_prescriptionid);
            }

            $investigation=request('investigation');

            if(!empty($investigation[0]))
            {
                $investigation=request('investigation');
                $notes =     request('notes');

                $subinvestigation=request('subinvestigation');


                foreach ($investigation as $key => $e) {
                    if($e != null)
                    {

                         if($e=='others')
                        {
                            $investigationtext=request('investigationtext');
                            $subinvestigationtext=request('subinvestigationtext');

                            $DocumentType = new DocumentType;
                            $DocumentType->name=$investigationtext[$key]?$investigationtext[$key]:"0";
                            $DocumentType->save();
                            $e = $DocumentType->id;

                            $Investigation= new Investigation;
                            $Investigation->testname_english=$subinvestigationtext[$key]?$subinvestigationtext[$key]:"0";
                            $Investigation->type_id=$e;
                            $Investigation->save();
                            $type_id = $Investigation->id;                            

                            $visit_investigation = new Visit_Investigation;
                            $visit_investigation->emr_id=isset($emr_lastId)?$emr_lastId:'';
                            $visit_investigation->investigation_id = $e ? $e :"";
                            $visit_investigation->note = $notes[$key]?$notes[$key]:"";
                            $visit_investigation->type_id = $type_id;
                            $typename=DocumentType::where('id',$e)->first();
                            $investigation_name=Investigation::select('testname_english','type_name')->where('id',$type_id)->first();
                            $visit_investigation->investigation_name = $investigation_name->testname_english;
                            $visit_investigation->patient_id = request('patient_id') ? request('patient_id'): "";
                            $visit_investigation->doctor_id = request('doctor_id') ?request('doctor_id'):"";
                            $visit_investigation->type_name=$typename?$typename->name:'';
                            $visit_investigation->save();
                            $visit_id = $visit_investigation->id;
                            $path = 'storage/pdf/lab_reports/' .$visit_id. '_labereport.pdf';
                            $typename=strtolower(str_replace(' ', '-', $investigation_name->type_name));
                            
                            
                            $clinic=DoctorClinic::where('user_id',request('doctor_id'))->with('clinic')->first();

                            if($typename=='labreport')
                            {
                                $pdf = PDF::loadView('admin.investigation.investigationpdf',compact('visit_investigation','clinic'))->save($path);
                            }

                            if($typename=='xray')
                            {
                                $pdf = PDF::loadView('admin.investigation.new_xrayreport',compact('visit_investigation','clinic'))->save($path);
                            }
                          
                            Visit_Investigation::where('id',$visit_id)->update(array('pdf'=>$path));
                        }
                        else
                        {
                            $visit_investigation = new Visit_Investigation;
                            $visit_investigation->emr_id=isset($emr_lastId)?$emr_lastId:'';
                            $visit_investigation->investigation_id = $e ? $e :"";
                            $visit_investigation->note = $notes[$key]?$notes[$key]:"";
                            $visit_investigation->type_id = $subinvestigation[$key]?$subinvestigation[$key]:"";
                            $typename=DocumentType::where('id',$e)->first();
                            $investigation_name=Investigation::select('testname_english','type_name')->where('id',$subinvestigation[$key])->first();
                            // dd($investigation_name);
                            $visit_investigation->investigation_name = $investigation_name->testname_english;
                            $visit_investigation->patient_id = request('patients') ? request('patients'): "";
                            $visit_investigation->doctor_id = $user_id ?$user_id:"";
                            $visit_investigation->type_name=$typename?$typename->name:'';
                            $visit_investigation->save();
                            $visit_id = $visit_investigation->id;
                            $path = 'storage/pdf/lab_reports/' .$visit_id. '_labereport.pdf';
                            $typename=strtolower(str_replace(' ', '-', $investigation_name->type_name));
                            
                            
                            $clinic=DoctorClinic::where('user_id',request('doctor_id'))->with('clinic')->first();

                            if($typename=='labreport')
                            {
                                $pdf = PDF::loadView('admin.investigation.investigationpdf',compact('visit_investigation','clinic'))->save($path);
                            }

                            if($typename=='xray')
                            {
                                $pdf = PDF::loadView('admin.investigation.new_xrayreport',compact('visit_investigation','clinic'))->save($path);
                            }
                            Visit_Investigation::where('id',$visit_id)->update(array('pdf'=>$path));        
                        }
                    }
                }
            }

            if(!empty($medicines[0]) && !empty($investigation[0]) || !empty($investigation[0]) || !empty($medicines[0]) )
            {
                $receiver_name = User::whereId(request('patients'))->first();

                $doctor_name = User::whereId($user_id)->first();

                $receiver_device_id = isset($receiver_name)?$receiver_name->device_id:'';

                $receiver_fname=isset($receiver_name)?$receiver_name->first_name:'';

                $receiver_lname=isset($receiver_name)?$receiver_name->last_name:'';

                $dr_fname=isset($doctor_name)?$doctor_name->first_name:'';

                $dr_lname=isset($doctor_name)?$doctor_name->last_name:'';

                $data = array(
                        'sender_id' => isset($doctor_name)?$doctor_name->id:'',
                        'receiver_id' => isset($receiver_name)?$receiver_name->id:'',
                        'notification_type' => 'other'
                );

                if(!empty($investigation[0]))
                {
                    $doctor_msg = array('message' => 'Hello '.$receiver_fname.' '.$receiver_lname.', Dr.'.$dr_fname.''.$dr_lname.' Sent you investigation', 'data' => $data);

                    $pmsg = array(
                            'body' => 'Hello '.$receiver_fname.' '.$receiver_lname.', Dr.'.$dr_fname.''.$dr_lname.' Sent you investigation',
                            'title' => isset($doctor_name)?'Message From Dr.'.$doctor_name->first_name.' '.$doctor_name->last_name:'',
                            'icon' => 'myicon',
                            'sound' => 'mySound'
                     );

                    PushNotification::SendPushNotification($pmsg, $doctor_msg, [$receiver_device_id]);

                }

                if(!empty($medicines[0]))
                {
                    $doctor_msg = array(
                        'message' => 'Hello '.$receiver_fname.' '.$receiver_lname.', Dr.'.$dr_fname.''.$dr_lname.' Sent you prescription',
                        'data' => $data
                    );

                    $pmsg = array(
                            'body' => 'Hello '.$receiver_fname.' '.$receiver_lname.', Dr.'.$dr_fname.''.$dr_lname.' Sent you prescription',
                            'title' => isset($doctor_name)?'Message From Dr.'.$doctor_name->first_name.' '.$doctor_name->last_name:'',
                            'icon' => 'myicon',
                            'sound' => 'mySound'
                     );

                    PushNotification::SendPushNotification($pmsg, $doctor_msg, [$receiver_device_id]);
                }

                    $create_notification = new Notification;
                    $create_notification->from_id = $user_id;
                    $create_notification->to_id = request('patients');

                    if(!empty($investigation[0]) && !empty($medicines[0]))
                    {
                        $create_notification->message = 'Hello '.$receiver_fname.' '.$receiver_lname.', Dr.'.$dr_fname.''.$dr_lname.' Sent you investigation & prescription';
                    }
                    elseif (!empty($medicines[0])) {
                            $create_notification->message = 'Hello '.$receiver_fname.' '.$receiver_lname.', Dr.'.$dr_fname.''.$dr_lname.' Sent you prescription';
                    }elseif(!empty($investigation[0]))
                    {
                        $create_notification->message = 'Hello '.$receiver_fname.' '.$receiver_lname.', Dr.'.$dr_fname.''.$dr_lname.' Sent you investigation';
                    }
                    else
                    {
                        $create_notification->message = 'Hello '.$receiver_fname.' '.$receiver_lname.', Dr.'.$dr_fname.''.$dr_lname.' Sent you emr';
                    }
                    $create_notification->save();
            }

            $referral=request('referral');

            if(!empty($referral[0]))
            {
                $referral=    request('referral');
                $doctor =  request('doctor');
                $diagnosis=request('diagnosis');
                $referraldetails =     request('referraldetails');
                $speciality_name=Speciality::select('name')->whereIn('id',$referral)->get();
                $doctor_name=User::select('first_name')->whereIn('id',$doctor)->get();


                foreach ($referral as $key => $e) {

                    if($e != null)
                    {

                            $visit_referral = new Visit_Referral;
                            $visit_referral->emr_id=isset($emr_lastId)?$emr_lastId:'';
                            $visit_referral->speciality_id=$e ? $e :"";
                            $speciality_name=Speciality::select('name')->where('id',$e)->first();

                            $doctor_name=User::select('first_name')->whereIn('id',$doctor)->first();
                            $visit_referral->doctor_name=$doctor_name->first_name;
                            $visit_referral->speciality_name=$speciality_name->name;
                            $visit_referral->diagnosis=$diagnosis[$key]?$diagnosis[$key]:"";
                            $visit_referral->reason=$referraldetails[$key]?$referraldetails[$key]:"";
                            $visit_referral->patient_id = request('patients') ? request('patients'): "";
                            $visit_referral->doctor_id = $user_id ?$user_id:"";
                            $visit_referral->save();
                            $visit_id = $visit_referral->id;
                            $path = 'storage/pdf/referral/' .$visit_id. '_referral.pdf';
                            $visit_referral=Visit_Referral::where('id', $visit_id)->with('speciality','doctor')->get();

                            $pdf = PDF::loadView('admin.referral.refereal_pdf',compact('visit_referral'))->save($path);
                            Visit_Referral::where('id',$visit_id)->update(array('pdf'=>$path));
                    }
                }
            }
            // }
            

             return redirect()->route('front.home.emr');
    }

    public function emrAdd(Request $request,$id)
    {

        $patient_id=EmrDetails::select('patient_id')->where('id',$id)->first();

        $id_patient=isset($patient_id->patient_id)?$patient_id->patient_id:'';

        $users=User::where('id',$id)->first();

        $medicines = Medicine::where('status',1)->get();

        $investigations=Investigation::where('status',1)->get();

        $specialitys=Speciality::where('status',1)->get();

        $lastvisit = EmrDetails::where('patient_id',$id)->orderBy('id', 'desc')->first();

        $documentType=DocumentType::where('status',1)->get();

        //$previsit =DoctorBookingForm::where('patient_id',isset($id_patient)?$id_patient:'')->first();


        if($lastvisit==null || $lastvisit->type_visit==null)
        {
            $type_visit='First Visit';
        }
        else
        {
            if($lastvisit->type_visit=='First Visit' || $lastvisit->type_visit=='first visit')
            {
                $memberid='Succesive Visit 0';
                $visit_id=++$memberid;

            }
            else
            {
                $memberid = $lastvisit->type_visit;
                $visit_id=++$memberid;

            }
            $type_visit=$visit_id;

        }
        return view('front.emr.EmrAdd',['medicines'=>$medicines,'investigations'=>$investigations,'specialitys'=>$specialitys,'emr_number'=>isset($users->emr_number)?$users->emr_number:'','type_visit'=>$type_visit,'patient_id'=>$id,'documentType'=>$documentType]);
    }

    public function emrStore(Request $request)
    {
        
            $this->validate($request, [
                  // 'physicannote'  => 'required',
                  'physicandiagnosis'  => 'required',

            ],
            [
                // 'physicannote.required'=>'Enter the physican note',
                'physicandiagnosis.required'=>'Enter the physican diagnosis',

            ]
            );
            // if ($validator->fails()) {
            //     $errorMessage = $validator->errors()->all();
            //     return response()->json(['errors' => $errorMessage], 422);
            // } else{
                $bookingfrom_id=request('bookingform_id');
            $EmrDetails=new EmrDetails();
            $EmrDetails->type_visit=request('type_visit');
            $EmrDetails->patient_id=request('patient_id');
            $EmrDetails->doctor_id=request('doctor_id');
            $EmrDetails->emr_no=request('emrno');
            $EmrDetails->physican_note=request('physicannote');
            $EmrDetails->physican_diagonis_id=request('physicandiagnosis');
            $EmrDetails->doctorbookingform_id=isset($bookingfrom_id)?$bookingfrom_id:'0';
            $EmrDetails->save();
            $emr_lastId = $EmrDetails->id;
            $medicines=request('medicines');
            if(isset($medicines))
            {
                $id=request('medicines');
                $medicine_name=Medicine::select('name')->whereIn('id',$id)->get();

                $dose = request('dose');
                $dosetype = request('dosetype');
                $frequency1 = request('frequency1');
                $frequency2 = request('frequency2');
                $frequency3 = request('frequency3');
                $duration = request('duration');
                $route = request('route');
                $visit_prescription = new Visit_Prescription;
                $visit_prescription->emr_id= $emr_lastId?$emr_lastId:'';
                $visit_prescription->patient_id = request('patient_id') ? request('patient_id'): "";
                $visit_prescription->doctor_id = request('doctor_id') ?request('doctor_id'):"";
                $visit_prescription->save();
                $visit_prescriptionid = $visit_prescription->id;

                foreach ($medicines as $key => $e) {

                    if($e != null)
                    {
                        if($e=='others')
                        {
                                $medicinestext=request('medicinestext');

                                            $medicine = new Medicine;
                                            $medicine->name=$medicinestext[$key]?$medicinestext[$key]:"0";
                                            $medicine->dose = $dose[$key] ? $dose[$key]: "0";
                                            $medicine->unit = $dosetype[$key] ? $dosetype[$key]:"";
                                            $medicine->frequency = $frequency1[$key] ? $frequency1[$key]:"0";
                                            $medicine->frequency2 = $frequency2[$key] ? $frequency2[$key]: "0";
                                            $medicine->frequency3 = $frequency3[$key] ? $frequency3[$key]:"0";
                                            $medicine->duration = $duration[$key] ? $duration[$key]: "";
                                            $medicine->route = $route[$key] ? $route[$key]: "";
                                            $medicine->save();
                                            $e = $medicine->id;
                                            $visit_data_prescription = new Visit_Data_Prescription;
                                            $visit_data_prescription->visit_prescription_id =isset($visit_prescription->id)?$visit_prescription->id:'';


                                            $visit_data_prescription->medicine_id = $e ? $e:"";
                                            $medicine_name=Medicine::select('name')->where('id',$e)->first();
                                            $visit_data_prescription->medicine_name = isset($medicine_name)?$medicine_name->name:'';
                                            $visit_data_prescription->dose = $dose[$key] ? $dose[$key]: "0";
                                            $visit_data_prescription->unit = $dosetype[$key] ? $dosetype[$key]:"";
                                            $visit_data_prescription->frequency = $frequency1[$key] ? $frequency1[$key]:"0";
                                            $visit_data_prescription->frequency2 = $frequency2[$key] ? $frequency2[$key]: "0";
                                            $visit_data_prescription->frequency3 = $frequency3[$key] ? $frequency3[$key]:"0";
                                            $visit_data_prescription->duration = $duration[$key] ? $duration[$key]: "";
                                            $visit_data_prescription->route = $route[$key] ? $route[$key]: "";
                                            $visit_data_prescription->save();     
                                                           
                        }
                        else
                        {
                            $visit_data_prescription = new Visit_Data_Prescription;
                            $visit_data_prescription->visit_prescription_id =isset($visit_prescription->id)?$visit_prescription->id:'';


                            $visit_data_prescription->medicine_id = $e ? $e:"";
                            $medicine_name=Medicine::select('name')->where('id',$e)->first();
                            $visit_data_prescription->medicine_name = isset($medicine_name)?$medicine_name->name:'';
                            $visit_data_prescription->dose = $dose[$key] ? $dose[$key]: "0";
                            $visit_data_prescription->unit = $dosetype[$key] ? $dosetype[$key]:"";
                            $visit_data_prescription->frequency = $frequency1[$key] ? $frequency1[$key]:"0";
                            $visit_data_prescription->frequency2 = $frequency2[$key] ? $frequency2[$key]: "0";
                            $visit_data_prescription->frequency3 = $frequency3[$key] ? $frequency3[$key]:"0";
                            $visit_data_prescription->duration = $duration[$key] ? $duration[$key]: "";
                            $visit_data_prescription->route = $route[$key] ? $route[$key]: "";
                            $visit_data_prescription->save();    
                        }
                        
                        // $visit_id = $visit_data_prescription->id;
                    }
                }


                // $medicinestext=request('medicinestext');

                // foreach ($medicinestext as $key => $e) {

                //     if($e != null)
                //     {
                        
                //          // $medicine_name=Medicine::select('name')->where('name',$e)->first();
                //         // if($medicine_name == null)
                //         // {
                //             $medicine = new Medicine;
                //             $medicine->name=$e;
                //             $medicine->dose = $dose[$key] ? $dose[$key]: "0";
                //             $medicine->unit = $dosetype[$key] ? $dosetype[$key]:"";
                //             $medicine->frequency = $frequency1[$key] ? $frequency1[$key]:"0";
                //             $medicine->frequency2 = $frequency2[$key] ? $frequency2[$key]: "0";
                //             $medicine->frequency3 = $frequency3[$key] ? $frequency3[$key]:"0";
                //             $medicine->duration = $duration[$key] ? $duration[$key]: "";
                //             $medicine->route = $route[$key] ? $route[$key]: "";
                //             $medicine->save();
                //             $e = $medicine->id;
                //         // }

                //         $visit_data_prescription = new Visit_Data_Prescription;
                //         $visit_data_prescription->visit_prescription_id =isset($visit_prescription->id)?$visit_prescription->id:'';
                //         $visit_data_prescription->medicine_id = $e ? $e:"";
                //         $medicine_name=Medicine::select('name')->where('id',$e)->first();
                //         $visit_data_prescription->medicine_name = isset($medicine_name)?$medicine_name->name:'';
                //         $visit_data_prescription->dose = $dose[$key] ? $dose[$key]: "0";
                //         $visit_data_prescription->unit = $dosetype[$key] ? $dosetype[$key]:"";
                //         $visit_data_prescription->frequency = $frequency1[$key] ? $frequency1[$key]:"0";
                //         $visit_data_prescription->frequency2 = $frequency2[$key] ? $frequency2[$key]: "0";
                //         $visit_data_prescription->frequency3 = $frequency3[$key] ? $frequency3[$key]:"0";
                //         $visit_data_prescription->duration = $duration[$key] ? $duration[$key]: "";
                //         $visit_data_prescription->route = $route[$key] ? $route[$key]: "";
                //         $visit_data_prescription->save();
                //         // $visit_id = $visit_data_prescription->id;
                //     }
                // }

                $visit_prescription_data =Visit_Data_Prescription::where('visit_prescription_id', $visit_prescriptionid)->get();


                $doctor_name=User::where('id',request('doctor_id'))->first();
                        $patient_name=User::where('id',request('patient_id'))->first();

                $path = 'storage/pdf/prescription/' .$visit_prescriptionid. '_labereport.pdf';
                $clinic=DoctorClinic::where('user_id',request('doctor_id'))->with('clinic')->first();
                $visit_medicine=Visit_Prescription::where('patient_id', request('patient_id'))->with('medicine','doctor','clinic')->get();


                $pdf = PDF::loadView('admin.patient.visit_pdf',compact('visit_prescription','visit_prescription_data','clinic','doctor_name','patient_name'))->save($path);

                Visit_Prescription::where('id',$visit_prescriptionid)->update(array('pdf'=>$path))  ;
                // dd($visit_prescriptionid);
            }

            $investigation=request('investigation');

            if(isset($investigation))
            {
                $investigation=request('investigation');
                $notes =     request('notes');
                $subinvestigation=request('subinvestigation');


                foreach ($investigation as $key => $e) {
                    if($e != null)
                    {

                        if($e=='others')
                        {
                            $investigationtext=request('investigationtext');
                            $subinvestigationtext=request('subinvestigationtext');

                            $DocumentType = new DocumentType;
                            $DocumentType->name=$investigationtext[$key]?$investigationtext[$key]:"0";
                            $DocumentType->save();
                            $e = $DocumentType->id;

                            $Investigation= new Investigation;
                            $Investigation->testname_english=$subinvestigationtext[$key]?$subinvestigationtext[$key]:"0";
                            $Investigation->type_id=$e;
                            $Investigation->save();
                            $type_id = $Investigation->id;                            

                            $visit_investigation = new Visit_Investigation;
                            $visit_investigation->emr_id=isset($emr_lastId)?$emr_lastId:'';
                            $visit_investigation->investigation_id = $e ? $e :"";
                            $visit_investigation->note = $notes[$key]?$notes[$key]:"";
                            $visit_investigation->type_id = $type_id;
                            $typename=DocumentType::where('id',$e)->first();
                            $investigation_name=Investigation::select('testname_english','type_name')->where('id',$type_id)->first();
                            $visit_investigation->investigation_name = $investigation_name->testname_english;
                            $visit_investigation->patient_id = request('patient_id') ? request('patient_id'): "";
                            $visit_investigation->doctor_id = request('doctor_id') ?request('doctor_id'):"";
                            $visit_investigation->type_name=$typename?$typename->name:'';
                            $visit_investigation->save();
                            $visit_id = $visit_investigation->id;
                            $path = 'storage/pdf/lab_reports/' .$visit_id. '_labereport.pdf';
                            $typename=strtolower(str_replace(' ', '-', $investigation_name->type_name));
                            
                            
                            $clinic=DoctorClinic::where('user_id',request('doctor_id'))->with('clinic')->first();

                            if($typename=='labreport')
                            {
                                $pdf = PDF::loadView('admin.investigation.investigationpdf',compact('visit_investigation','clinic'))->save($path);
                            }

                            if($typename=='xray')
                            {
                                $pdf = PDF::loadView('admin.investigation.new_xrayreport',compact('visit_investigation','clinic'))->save($path);
                            }
                          
                            Visit_Investigation::where('id',$visit_id)->update(array('pdf'=>$path));

                                        

                        }
                        else
                        {
                            //dd($subinvestigation[$key]);
                            $visit_investigation = new Visit_Investigation;
                            $visit_investigation->emr_id=isset($emr_lastId)?$emr_lastId:'';
                            $visit_investigation->investigation_id = $e ? $e :"";
                            $visit_investigation->note = $notes[$key]?$notes[$key]:"";
                            $visit_investigation->type_id = $subinvestigation[$key]?$subinvestigation[$key]:"";
                            $typename=DocumentType::where('id',$e)->first();
                            $investigation_name=Investigation::select('testname_english','type_name')->where('id',$subinvestigation[$key])->first();
                            $visit_investigation->investigation_name = $investigation_name->testname_english;
                            $visit_investigation->patient_id = request('patient_id') ? request('patient_id'): "";
                            $visit_investigation->doctor_id = request('doctor_id') ?request('doctor_id'):"";
                            $visit_investigation->type_name=$typename?$typename->name:'';
                            $visit_investigation->save();
                            $visit_id = $visit_investigation->id;
                            $path = 'storage/pdf/lab_reports/' .$visit_id. '_labereport.pdf';
                            $typename=strtolower(str_replace(' ', '-', $investigation_name->type_name));
                            
                            
                            $clinic=DoctorClinic::where('user_id',request('doctor_id'))->with('clinic')->first();

                            if($typename=='labreport')
                            {
                                $pdf = PDF::loadView('admin.investigation.investigationpdf',compact('visit_investigation','clinic'))->save($path);
                            }

                            if($typename=='xray')
                            {
                                $pdf = PDF::loadView('admin.investigation.new_xrayreport',compact('visit_investigation','clinic'))->save($path);
                            }
                          
                            Visit_Investigation::where('id',$visit_id)->update(array('pdf'=>$path));
                        }
                    }

                }
            }

            if(!empty($investigation[0]) && !empty($medicines[0]) || !empty($investigation[0]) || !empty($medicines[0]) )
            {
                $receiver_name = User::whereId(request('patient_id'))->first();

                $doctor_name = User::whereId(request('doctor_id'))->first();

                $receiver_device_id = isset($receiver_name)?$receiver_name->device_id:'';

                $receiver_fname=isset($receiver_name)?$receiver_name->first_name:'';

                $receiver_lname=isset($receiver_name)?$receiver_name->last_name:'';

                $dr_fname=isset($doctor_name)?$doctor_name->first_name:'';

                $dr_lname=isset($doctor_name)?$doctor_name->last_name:'';

                $data = array(
                        'sender_id' => isset($doctor_name)?$doctor_name->id:'',
                        'receiver_id' => isset($receiver_name)?$receiver_name->id:'',
                        'notification_type' => 'other'
                );

                if(!empty($investigation[0]))
                {
                    $doctor_msg = array('message' => 'Hello '.$receiver_fname.' '.$receiver_lname.', Dr.'.$dr_fname.''.$dr_lname.' Sent you investigation', 'data' => $data);

                    $pmsg = array(
                            'body' => 'Hello '.$receiver_fname.' '.$receiver_lname.', Dr.'.$dr_fname.''.$dr_lname.' Sent you investigation',
                            'title' => isset($doctor_name)?'Message From Dr.'.$doctor_name->first_name.' '.$doctor_name->last_name:'',
                            'icon' => 'myicon',
                            'sound' => 'mySound'
                     );

                    PushNotification::SendPushNotification($pmsg, $doctor_msg, [$receiver_device_id]);

                }

                if(!empty($medicines[0]))
                {
                    $doctor_msg = array(
                        'message' => 'Hello '.$receiver_fname.' '.$receiver_lname.', Dr.'.$dr_fname.''.$dr_lname.' Sent you prescription',
                        'data' => $data
                    );

                    $pmsg = array(
                            'body' => 'Hello '.$receiver_fname.' '.$receiver_lname.', Dr.'.$dr_fname.''.$dr_lname.' Sent you prescription',
                            'title' => isset($doctor_name)?'Message From Dr.'.$doctor_name->first_name.' '.$doctor_name->last_name:'',
                            'icon' => 'myicon',
                            'sound' => 'mySound'
                     );

                    PushNotification::SendPushNotification($pmsg, $doctor_msg, [$receiver_device_id]);
                }

                    $create_notification = new Notification;
                    $create_notification->from_id = request('doctor_id');
                    $create_notification->to_id = request('patient_id');

                    if(!empty($investigation[0]) && !empty($medicines[0]) )
                    {
                        $create_notification->message = 'Hello '.$receiver_fname.' '.$receiver_lname.', Dr.'.$dr_fname.''.$dr_lname.' Sent you investigation & prescription';
                    }
                    elseif (!empty($medicines[0])) {
                            $create_notification->message = 'Hello '.$receiver_fname.' '.$receiver_lname.', Dr.'.$dr_fname.''.$dr_lname.' Sent you prescription';
                    }elseif(!empty($investigation[0]))
                    {
                        $create_notification->message = 'Hello '.$receiver_fname.' '.$receiver_lname.', Dr.'.$dr_fname.''.$dr_lname.' Sent you investigation';
                    }
                    else
                    {
                        $create_notification->message = 'Hello '.$receiver_fname.' '.$receiver_lname.', Dr.'.$dr_fname.''.$dr_lname.' Sent you emr';
                    }
                    $create_notification->save();
            }

            $referral=request('referral');

            if(isset($referral))
            {
                $referral=    request('referral');
                $doctor =  request('doctor');
                $diagnosis=request('diagnosis');
                $referraldetails =     request('referraldetails');
                $speciality_name=Speciality::select('name')->whereIn('id',$referral)->get();
                $doctor_name=User::select('first_name')->whereIn('id',$doctor)->get();


                foreach ($referral as $key => $e) {

                    if($e != null)
                    {

                            $visit_referral = new Visit_Referral;
                            $visit_referral->emr_id=isset($emr_lastId)?$emr_lastId:'';
                            $visit_referral->speciality_id=$e ? $e :"";
                            $speciality_name=Speciality::select('name')->where('id',$e)->first();

                            $doctor_name=User::select('first_name')->whereIn('id',$doctor)->first();
                            $visit_referral->doctor_name=$doctor_name->first_name;
                            $visit_referral->speciality_name=$speciality_name->name;
                            $visit_referral->diagnosis=$diagnosis[$key]?$diagnosis[$key]:"";
                            $visit_referral->reason=$referraldetails[$key]?$referraldetails[$key]:"";
                            $visit_referral->patient_id = request('patient_id') ? request('patient_id'): "";
                            $visit_referral->doctor_id = request('doctor_id') ?request('doctor_id'):"";
                            $visit_referral->save();
                            $visit_id = $visit_referral->id;
                            $path = 'storage/pdf/referral/' .$visit_id. '_referral.pdf';
                            $visit_referral=Visit_Referral::where('id', $visit_id)->with('speciality','doctor')->get();

                            $pdf = PDF::loadView('admin.referral.refereal_pdf',compact('visit_referral'))->save($path);
                            Visit_Referral::where('id',$visit_id)->update(array('pdf'=>$path));
                    }
                }
            }
            // }
            

             return redirect()->route('front.home.emr');

    }

    public function storeChatUserEmr(Request $request)
    {
         $validator = Validator::make($request->all(), [
               // 'physicannote'  => 'required',
               'physicandiagnosis'  => 'required',

        ],
        [
            // 'physicannote.required'=>'Enter the physican note',
            'physicandiagnosis.required'=>'Enter the physican diagnosis',

        ]);
        if ($validator->fails()) {

            // $errorMessage = implode(',', $validator->errors()->all());
            $errorMessage = $validator->errors()->all();

            return response()->json(['errors' => $errorMessage], 422);

        } else {

            $bookingfrom_id=request('bookingform_id');

            $followupdate=EmrDetails::where('patient_id',request('patient_id'))->where('doctor_id',request('doctor_id'))->latest()->first();

            if($followupdate)
            {
                if($followupdate->call_type == 'regular')
                {
                    $call_type='followup';
                }
                elseif($followupdate->call_type == 'followup')
                {
                    $call_type='regular';
                }
                else
                {

                 $call_type='regular';
                }
            }
            else
            {
                $call_type='regular';
            }
            

            $EmrDetails=new EmrDetails();
            $EmrDetails->type_visit=request('type_visit');
            $EmrDetails->patient_id=request('patient_id');
            $EmrDetails->doctor_id=request('doctor_id');
            $EmrDetails->emr_no=request('emrno');
            $EmrDetails->physican_note=request('physicannote');
            $EmrDetails->physican_diagonis_id=request('physicandiagnosis');
            $EmrDetails->doctorbookingform_id=isset($bookingfrom_id)?$bookingfrom_id:'0';
            // if(request('call_type') =='')
            // {
            //     $call_type='regular';
            // }
            // else
            // {
            //     $call_type=request('call_type');
            // }
            $EmrDetails->call_type=isset($call_type)?$call_type:'chat';
            $EmrDetails->followup_date=date('Y-m-d');
            $date_time=date('Y-m-d', strtotime(date('Y-m-d'). ' + 14 days'));
            $EmrDetails->enddate=$date_time;
            $EmrDetails->save();
            $emr_lastId = $EmrDetails->id;
            
            if($call_type == 'regular')
            {

                //Payment Functions
                $doctors=User::where('id',request('doctor_id'))->first();

                $fees=isset($doctors)?$doctors->fees:'';//Doctor Fees 

                $commission_final=isset($doctors)?$doctors->commision:'';//Doctor Commission 

                $discount=isset($doctors)?$doctors->discount:'';//Doctor Discount 

                

                $vats=Vat::first();

                $vat=isset($vats)?$vats->vat:'5';

                if($discount > 0)
                {
                    $feesdiscount=$fees*$discount/100;   
                    $discountprice=$fees-$feesdiscount;
                    $vat=$discountprice*$vat/100; //Vat Is Here 5%;
                    $total_fees=$vat+$discountprice;
                    $total_fees_with_vat=$total_fees;
                }
                else{
                    $vat=$fees*$vat/100; //Vat Is Here 5%;
                    $total_fees_with_vat=$vat+$fees;
                }
            
                $doctor_commission=$total_fees_with_vat*$commission_final/100;

                $patient_wallet=User::where('id',request('patient_id'))->first();//Patient Wallet Money

                $patient_wallet_money=isset($patient_wallet)?$patient_wallet->wallet_money:'';
                
                  

                    if($total_fees_with_vat >= $patient_wallet_money)
                    {
                        $update_patient_wallet_money=$total_fees_with_vat-$patient_wallet_money;
                    }
                    else
                    {
                        $update_patient_wallet_money=$patient_wallet_money-$total_fees_with_vat;
                    }//Update Wallet Money Patient

                    $patient_wallet=User::where('id',request('patient_id'))->update(['wallet_money'=>$update_patient_wallet_money]);//Update Patient Wallet

                    $clinic_wallet=DoctorClinic::where('user_id',request('doctor_id'))->first();//Doctor Clinic

                    $clinic=Clinic::where('id',isset($clinic_wallet)?$clinic_wallet->clinic_id:'')->first();//Clinic Wallet Money

                    if($clinic)
                    {
                        $clinic_name=isset($clinic->name)?$clinic->name:'';

                        if($clinic_name=='Ask' || $clinic_name=='ask')
                        {

                            $clinic_wallet_money=isset($clinic)?$clinic->wallet_money:'';

                            $update_clinic_money=$clinic_wallet_money+$doctor_commission;

                            $restdr_money=$total_fees_with_vat-$doctor_commission;

                            $clinic_wallets=Clinic::where('id',isset($clinic_wallet)?$clinic_wallet->clinic_id:'')->update(['wallet_money'=>$update_clinic_money]);//Update Patient 

                            $wallets=User::where('id',request('doctor_id'))->first();
                            if($wallets)
                            {
                                $totalMoney=$wallets->wallet_money+$restdr_money;
                            }
                            else
                            {
                                $totalMoney=$restdr_money;
                            }
                            

                            $patient_wallets=User::where('id',request('doctor_id'))->update(['wallet_money'=>$totalMoney]);

                            $ClinicWalletHistory=new DoctorWallet;
                            $ClinicWalletHistory->doctor_id=request('doctor_id');
                            $ClinicWalletHistory->commission=$doctor_commission;
                            $ClinicWalletHistory->amount=$restdr_money;
                            $ClinicWalletHistory->save();

                            //$doctors=User::where('id',request('patient_id'))->update(['wallet_money'=>$fees]);
                        }
                        else
                        {


                            $askclinic_wallet=Clinic::where('name','=','Ask')->first();
     
                            $clinic_wallet_money=isset($askclinic_wallet)?$askclinic_wallet->wallet_money:'';

                            $update_askmoney=$clinic_wallet_money+$doctor_commission;

                            $askclinic_wallets=Clinic::where('id',isset($askclinic_wallet)?$askclinic_wallet->clinic_id:'')->update(['wallet_money'=>$update_askmoney]);//Update Patient 

                            if(isset($askclinic_wallet))
                            {
                                    $ClinicWalletHistory=new ClinicWalletHistory;
                                    $ClinicWalletHistory->clinic_id=$askclinic_wallet->id;
                                    $ClinicWalletHistory->commission=$doctor_commission;
                                    $ClinicWalletHistory->doctor_id=request('doctor_id');
                                    $ClinicWalletHistory->amount=$doctor_commission;
                                    $ClinicWalletHistory->save();
                            }
                            
                            $restdr_money=$total_fees_with_vat-$doctor_commission;

                            $clinic_wallet_money=isset($clinic)?$clinic->wallet_money:'';

                            $update_clinic_money=$clinic_wallet_money+$doctor_commission;

                            $clinic_wallets=Clinic::where('id',isset($clinic_wallet)?$clinic_wallet->clinic_id:'')->update(['wallet_money'=>$restdr_money]);//Update Patient 
                            // $ClinicWalletHistory=new ClinicWalletHistory;
                            // $ClinicWalletHistory->clinic_id=isset($clinic_wallet)?$clinic_wallet->clinic_id:'';
                            // $ClinicWalletHistory->commission=$doctor_commission;
                            // $ClinicWalletHistory->doctor_id=request('doctor_id');
                            // $ClinicWalletHistory->save();

                            if(isset($clinic_wallet))
                            {
                                $ClinicWalletHistory=new ClinicWalletHistory;
                                $ClinicWalletHistory->clinic_id=$clinic_wallet->clinic_id;
                                $ClinicWalletHistory->commission=$doctor_commission;
                                $ClinicWalletHistory->doctor_id=request('doctor_id');
                                $ClinicWalletHistory->amount=$restdr_money;
                                $ClinicWalletHistory->save();
                            }


                        }
                    }

                

                    $payment_history = new Payment_history;
                    $payment_history->user_id = request('patient_id');      // user
                    $payment_history->user_id2 = request('doctor_id');  // doctor
                    $payment_history->price = $total_fees_with_vat;
                    $payment_history->message = "Pay fees of doctor SAR".$total_fees_with_vat;
                    $payment_history->save();

                    $doctorbill=new DoctorBill;
                    $doctorbill->patient_id=request('patient_id');
                    $doctorbill->doctor_id=request('doctor_id');
                    $doctorbill->clinic_id=isset($clinic_wallet)?$clinic_wallet->clinic_id:'-';
                    $doctorbill->doctor_fees=$fees;
                    $doctorbill->discount_fees=isset($discountprice)?$discountprice:'-';
                    $doctorbill->vat_fees=$total_fees_with_vat;
                    $doctorbill->emr_id=$emr_lastId;
                    $doctorbill->vat=$vat;
                    $doctorbill->bill_no=mt_rand(100000,999999);
                    $doctorbill->Audio_video_type=request('call_type');
                    $doctorbill->save();

                     $doctorbillid = $doctorbill->id;

                    //Report Bill
                    $path = 'storage/pdf/bill/' .$doctorbillid. '_bill.pdf';

                    $receiver_name = User::whereId(request('patient_id'))->first();

                    $doctor_name = User::whereId(request('doctor_id'))->first();

                    $receiver_device_id = isset($receiver_name)?$receiver_name->device_id:'';

                    $receiver_fname=isset($receiver_name)?$receiver_name->first_name:'';

                    $receiver_lname=isset($receiver_name)?$receiver_name->last_name:'';

                    $dr_fname=isset($doctor_name)?$doctor_name->first_name:'';

                    $dr_lname=isset($doctor_name)?$doctor_name->last_name:'';

                    $dr_code=isset($doctor_name)?$doctor_name->ask_id:'';

                    $emr=EmrDetails::where('id',$emr_lastId)->first();

                    $pdf = PDF::loadView('admin.Bill.visitbill',compact('receiver_fname','receiver_lname','dr_fname','dr_lname','doctorbill','emr','dr_code'))->save($path);

                    DoctorBill::where('id',$doctorbillid)->update(array('pdf'=>$path))  ;

                 
                     $data = array(
                        'sender_id' => isset($doctor_name)?$doctor_name->id:'',
                        'receiver_id' => isset($receiver_name)?$receiver_name->id:'',
                        'notification_type' => 'investigation'
                    );
                
                    $doctor_msg = array('message' => 'Hello '.$receiver_fname.' '.$receiver_lname.', Dr.'.$dr_fname.''.$dr_lname.' Sent you bill', 'data' => $data);

                    $pmsg = array(
                            'body' => 'Hello '.$receiver_fname.' '.$receiver_lname.', Dr.'.$dr_fname.''.$dr_lname.' Sent you bill',
                            'title' => isset($doctor_name)?'Message From Dr.'.$doctor_name->first_name.' '.$doctor_name->last_name:'',
                            'icon' => 'myicon',
                            'sound' => 'mySound'
                     );

                    PushNotification::SendPushNotification($pmsg, $doctor_msg, [$receiver_device_id]);

                    //End Report Bill

                   
                }
            
            

            // if(request('call_type') == 'followup')
            // {
            //     // $followupdate=EmrDetails::where('id',$emr_lastId)->update(['call_type'=>'regular']);
            // }


                   
            
            // //End Payment Functions    

            
            
            $medicines=request('medicines');
           // is_null($result)
            if(!empty($medicines[0]))
            {
                $id=request('medicines');
                $medicine_name=Medicine::select('name')->whereIn('id',$id)->get();

                $dose = request('dose');
                $dosetype = request('dosetype');
                $frequency1 = request('frequency1');
                $frequency2 = request('frequency2');
                $frequency3 = request('frequency3');
                $duration = request('duration');
                $route = request('route');
                $visit_prescription = new Visit_Prescription;
                $visit_prescription->emr_id= $emr_lastId?$emr_lastId:'';
                $visit_prescription->patient_id = request('patient_id') ? request('patient_id'): "";
                $visit_prescription->doctor_id = request('doctor_id') ?request('doctor_id'):"";
                $visit_prescription->save();
                $visit_prescriptionid = $visit_prescription->id;
                foreach ($medicines as $key => $e) {

                    if($e != null)
                    {
                        if($e=='others')
                        {
                                $medicinestext=request('medicinestext');

                                            $medicine = new Medicine;
                                            $medicine->name=$medicinestext[$key]?$medicinestext[$key]:"0";
                                            $medicine->dose = $dose[$key] ? $dose[$key]: "0";
                                            $medicine->unit = $dosetype[$key] ? $dosetype[$key]:"";
                                            $medicine->frequency = $frequency1[$key] ? $frequency1[$key]:"0";
                                            $medicine->frequency2 = $frequency2[$key] ? $frequency2[$key]: "0";
                                            $medicine->frequency3 = $frequency3[$key] ? $frequency3[$key]:"0";
                                            $medicine->duration = $duration[$key] ? $duration[$key]: "";
                                            $medicine->route = $route[$key] ? $route[$key]: "";
                                            $medicine->save();
                                            $e = $medicine->id;
                                             $visit_prescription_data = new Visit_Data_Prescription;
                                            $visit_prescription_data->visit_prescription_id=isset($visit_prescriptionid)?$visit_prescriptionid:'';
                                            $visit_prescription_data->medicine_id = $e ? $e:"";
                                            $medicine_name=Medicine::select('name')->where('id',$e)->first();
                                            $visit_prescription_data->medicine_name = $medicine_name->name;
                                            $visit_prescription_data->dose = $dose[$key] ? $dose[$key]: "";
                                            $visit_prescription_data->unit = $dosetype[$key] ? $dosetype[$key]:"";
                                            $visit_prescription_data->frequency = $frequency1[$key] ? $frequency1[$key]:"0";
                                            $visit_prescription_data->frequency2 = $frequency2[$key] ? $frequency2[$key]: "0";
                                            $visit_prescription_data->frequency3 = $frequency3[$key] ? $frequency3[$key]:"0";
                                            $visit_prescription_data->duration = $duration[$key] ? $duration[$key]: "";
                                            $visit_prescription_data->route = $route[$key] ? $route[$key]: "";
                                            //$visit_prescription_data->patient_id = request('patient_id') ? request('patient_id'): "";
                                           // $visit_prescription_data->doctor_id = request('doctor_id') ?request('doctor_id'):"";
                                            //$visit_prescription->route = $route[$key] ? $route[$key]: "";
                                            $visit_prescription_data->save();
                                            $doctor_name=User::where('id',request('doctor_id'))->first();
                                            $patient_name=User::where('id',request('patient_id'))->first();
                                            $visit_id = $visit_prescription_data->id;
                                            $path = 'storage/pdf/prescription/' .$visit_id. '_labereport.pdf';
                                            $clinic=DoctorClinic::where('user_id',request('doctor_id'))->with('clinic')->first();
                                            $visit_prescription=Visit_Prescription::where('patient_id', request('patient_id'))->with('medicine','doctor','clinic')->get();
                                            $visit_prescription_doctor=Visit_Prescription::where('doctor_id', request('doctor_id'))->with('medicine','doctor','clinic')->get();

                                             $visit_prescription_data =Visit_Data_Prescription::where('visit_prescription_id', $visit_prescriptionid)->get();

                                            $pdf = PDF::loadView('admin.patient.visit_pdf',compact('visit_prescription_data','clinic','doctor_name','patient_name','visit_prescriptionid'))->save($path);
                                            Visit_Prescription::where('id',$visit_prescriptionid)->update(array('pdf'=>$path))  ;                                  
                        }
                        else
                        {
                            $visit_prescription_data = new Visit_Data_Prescription;
                        $visit_prescription_data->visit_prescription_id=isset($visit_prescriptionid)?$visit_prescriptionid:'';
                        $visit_prescription_data->medicine_id = $e ? $e:"";
                        $medicine_name=Medicine::select('name')->where('id',$e)->first();
                        $visit_prescription_data->medicine_name = $medicine_name->name;
                        $visit_prescription_data->dose = $dose[$key] ? $dose[$key]: "";
                        $visit_prescription_data->unit = $dosetype[$key] ? $dosetype[$key]:"";
                        $visit_prescription_data->frequency = $frequency1[$key] ? $frequency1[$key]:"0";
                        $visit_prescription_data->frequency2 = $frequency2[$key] ? $frequency2[$key]: "0";
                        $visit_prescription_data->frequency3 = $frequency3[$key] ? $frequency3[$key]:"0";
                        $visit_prescription_data->duration = $duration[$key] ? $duration[$key]: "";
                        $visit_prescription_data->route = $route[$key] ? $route[$key]: "";
                        //$visit_prescription_data->patient_id = request('patient_id') ? request('patient_id'): "";
                       // $visit_prescription_data->doctor_id = request('doctor_id') ?request('doctor_id'):"";
                        //$visit_prescription->route = $route[$key] ? $route[$key]: "";
                        $visit_prescription_data->save();
                        $doctor_name=User::where('id',request('doctor_id'))->first();
                        $patient_name=User::where('id',request('patient_id'))->first();
                        $visit_id = $visit_prescription_data->id;
                        $path = 'storage/pdf/prescription/' .$visit_id. '_labereport.pdf';
                        $clinic=DoctorClinic::where('user_id',request('doctor_id'))->with('clinic')->first();
                        $visit_prescription=Visit_Prescription::where('patient_id', request('patient_id'))->with('medicine','doctor','clinic')->get();
                        $visit_prescription_doctor=Visit_Prescription::where('doctor_id', request('doctor_id'))->with('medicine','doctor','clinic')->get();

                         $visit_prescription_data =Visit_Data_Prescription::where('visit_prescription_id', $visit_prescriptionid)->get();

                        $pdf = PDF::loadView('admin.patient.visit_pdf',compact('visit_prescription_data','clinic','doctor_name','patient_name','visit_prescriptionid'))->save($path);
                        Visit_Prescription::where('id',$visit_prescriptionid)->update(array('pdf'=>$path))  ;
                        }
                        
                    }

                }
            }

            $investigation=request('investigation');

            if(!empty($investigation[0]))
            {
                $investigation = request('investigation');
                $notes =     request('notes');
                $subinvestigation=request('subinvestigation');


                foreach ($investigation as $key => $e) {
                    if($e != null)
                    {

                         if($e=='others')
                        {
                            $investigationtext=request('investigationtext');
                            $subinvestigationtext=request('subinvestigationtext');

                            $DocumentType = new DocumentType;
                            $DocumentType->name=$investigationtext[$key]?$investigationtext[$key]:"0";
                            $DocumentType->save();
                            $e = $DocumentType->id;

                            $Investigation= new Investigation;
                            $Investigation->testname_english=$subinvestigationtext[$key]?$subinvestigationtext[$key]:"0";
                            $Investigation->type_id=$e;
                            $Investigation->save();
                            $type_id = $Investigation->id;                            

                            $visit_investigation = new Visit_Investigation;
                            $visit_investigation->emr_id=isset($emr_lastId)?$emr_lastId:'';
                            $visit_investigation->investigation_id = $e ? $e :"";
                            $visit_investigation->note = $notes[$key]?$notes[$key]:"";
                            $visit_investigation->type_id = $type_id;
                            $typename=DocumentType::where('id',$e)->first();
                            $investigation_name=Investigation::select('testname_english','type_name')->where('id',$type_id)->first();
                            $visit_investigation->investigation_name = $investigation_name->testname_english;
                            $visit_investigation->patient_id = request('patient_id') ? request('patient_id'): "";
                            $visit_investigation->doctor_id = request('doctor_id') ?request('doctor_id'):"";
                            $visit_investigation->type_name=$typename?$typename->name:'';
                            $visit_investigation->save();
                            $visit_id = $visit_investigation->id;
                            $path = 'storage/pdf/lab_reports/' .$visit_id. '_labereport.pdf';
                            $typename=strtolower(str_replace(' ', '-', $investigation_name->type_name));
                            
                            
                            $clinic=DoctorClinic::where('user_id',request('doctor_id'))->with('clinic')->first();

                            if($typename=='labreport')
                            {
                                $pdf = PDF::loadView('admin.investigation.investigationpdf',compact('visit_investigation','clinic'))->save($path);
                            }

                            if($typename=='xray')
                            {
                                $pdf = PDF::loadView('admin.investigation.new_xrayreport',compact('visit_investigation','clinic'))->save($path);
                            }
                          
                            Visit_Investigation::where('id',$visit_id)->update(array('pdf'=>$path));
                        }
                       else{
                                $visit_investigation = new Visit_Investigation;
                                $visit_investigation->emr_id=isset($emr_lastId)?$emr_lastId:'';
                                $visit_investigation->investigation_id = $e ? $e :"";
                                $visit_investigation->note = $notes[$key]?$notes[$key]:"";
                                $visit_investigation->type_id = $subinvestigation[$key]?$subinvestigation[$key]:"";
                                $typename=DocumentType::where('id',$e)->first();
                                $investigation_name=Investigation::select('testname_english','type_name')->where('id',$subinvestigation[$key])->first();
                                $visit_investigation->investigation_name = $investigation_name->testname_english;
                                $visit_investigation->patient_id = request('patient_id') ? request('patient_id'): "";
                                $visit_investigation->doctor_id = request('doctor_id') ?request('doctor_id'):"";
                                $visit_investigation->type_name=$typename?$typename->name:'';
                                $visit_investigation->save();
                                $visit_id = $visit_investigation->id;
                                $path = 'storage/pdf/lab_reports/' .$visit_id. '_labereport.pdf';
                                $clinic=DoctorClinic::where('user_id',request('doctor_id'))->with('clinic')->first();
                                $typename=strtolower(str_replace(' ', '-', $investigation_name->type_name));
                                if($typename=='labreport')
                                {
                                    $pdf = PDF::loadView('admin.investigation.investigationpdf',compact('visit_investigation','clinic'))->save($path);
                                }

                                if($typename=='xray')
                                {
                                    $pdf = PDF::loadView('admin.investigation.new_xrayreport',compact('visit_investigation','clinic'))->save($path);
                                }

                                // $pdf = PDF::loadView('admin.investigation.investigationpdf',compact('visit_investigation','clinic'))->save($path);
                                Visit_Investigation::where('id',$visit_id)->update(array('pdf'=>$path));    
                       }
                    
                    }

                }
            }

            if(!empty($investigation[0]) && !empty($medicines[0]) || !empty($investigation[0]) || !empty($medicines[0]) )
            {

                $receiver_name = User::whereId(request('patient_id'))->first();

                $doctor_name = User::whereId(request('doctor_id'))->first();

                $receiver_device_id = isset($receiver_name)?$receiver_name->device_id:'';

                $receiver_fname=isset($receiver_name)?$receiver_name->first_name:'';

                $receiver_lname=isset($receiver_name)?$receiver_name->last_name:'';

                $dr_fname=isset($doctor_name)?$doctor_name->first_name:'';

                $dr_lname=isset($doctor_name)?$doctor_name->last_name:'';

                $data = array(
                        'sender_id' => isset($doctor_name)?$doctor_name->id:'',
                        'receiver_id' => isset($receiver_name)?$receiver_name->id:'',
                        'notification_type' => 'investigation & prescription'
                );

                // if(isset($investigation_detail))
                // {
                //     $doctor_msg = array('message' => 'Hello '.$receiver_fname.' '.$receiver_lname.', Dr.'.$dr_fname.''.$dr_lname.' Sent you investigation', 'data' => $data);

                //     $pmsg = array(
                //             'body' => 'Hello '.$receiver_fname.' '.$receiver_lname.', Dr.'.$dr_fname.''.$dr_lname.' Sent you investigation',
                //             'title' => isset($doctor_name)?'Message From Dr.'.$doctor_name->first_name.' '.$doctor_name->last_name:'',
                //             'icon' => 'myicon',
                //             'sound' => 'mySound'
                //      );

                //     PushNotification::SendPushNotification($pmsg, $doctor_msg, [$receiver_device_id]);
                // }

                if(!empty($investigation[0]))
                {
                    $data = array(
                        'sender_id' => isset($doctor_name)?$doctor_name->id:'',
                        'receiver_id' => isset($receiver_name)?$receiver_name->id:'',
                        'notification_type' => 'investigation'
                    );
                
                    $doctor_msg = array('message' => 'Hello '.$receiver_fname.' '.$receiver_lname.', Dr.'.$dr_fname.''.$dr_lname.' Sent you investigation', 'data' => $data);

                    $pmsg = array(
                            'body' => 'Hello '.$receiver_fname.' '.$receiver_lname.', Dr.'.$dr_fname.''.$dr_lname.' Sent you investigation',
                            'title' => isset($doctor_name)?'Message From Dr.'.$doctor_name->first_name.' '.$doctor_name->last_name:'',
                            'icon' => 'myicon',
                            'sound' => 'mySound'
                     );

                    PushNotification::SendPushNotification($pmsg, $doctor_msg, [$receiver_device_id]);
                }

                // if(isset($prescription_detail))
                // {
                //     $doctor_msg = array(
                //         'message' => 'Hello '.$receiver_fname.' '.$receiver_lname.', Dr.'.$dr_fname.''.$dr_lname.' Sent you precription',
                //         'data' => $data
                //     );

                //     $pmsg = array(
                //             'body' => 'Hello '.$receiver_fname.' '.$receiver_lname.', Dr.'.$dr_fname.''.$dr_lname.' Sent you precription',
                //             'title' => isset($doctor_name)?'Message From Dr.'.$doctor_name->first_name.' '.$doctor_name->last_name:'',
                //             'icon' => 'myicon',
                //             'sound' => 'mySound'
                //      );

                //     PushNotification::SendPushNotification($pmsg, $doctor_msg, [$receiver_device_id]);
                // }


                if(!empty($medicines[0]))
                {
                    $data = array(
                        'sender_id' => isset($doctor_name)?$doctor_name->id:'',
                        'receiver_id' => isset($receiver_name)?$receiver_name->id:'',
                        'notification_type' => 'prescription'
                    );
                    
                    $doctor_msg = array(
                        'message' => 'Hello '.$receiver_fname.' '.$receiver_lname.', Dr.'.$dr_fname.''.$dr_lname.' Sent you prescription',
                        'data' => $data
                    );

                    $pmsg = array(
                            'body' => 'Hello '.$receiver_fname.' '.$receiver_lname.', Dr.'.$dr_fname.''.$dr_lname.' Sent you prescription',
                            'title' => isset($doctor_name)?'Message From Dr.'.$doctor_name->first_name.' '.$doctor_name->last_name:'',
                            'icon' => 'myicon',
                            'sound' => 'mySound'
                     );

                    PushNotification::SendPushNotification($pmsg, $doctor_msg, [$receiver_device_id]);
                }

                    $create_notification = new Notification;
                    $create_notification->from_id = request('doctor_id');
                    $create_notification->to_id = request('patient_id');

                    if(!empty($investigation[0]) && !empty($medicines[0]) )
                    {
                        $create_notification->message = 'Hello '.$receiver_fname.' '.$receiver_lname.', Dr.'.$dr_fname.''.$dr_lname.' Sent you investigation & prescription';
                    }
                    elseif (!empty($medicines[0])) {
                            $create_notification->message = 'Hello '.$receiver_fname.' '.$receiver_lname.', Dr.'.$dr_fname.''.$dr_lname.' Sent you prescription';
                    }elseif(!empty($investigation[0]))
                    {
                        $create_notification->message = 'Hello '.$receiver_fname.' '.$receiver_lname.', Dr.'.$dr_fname.''.$dr_lname.' Sent you investigation';
                    }
                    else
                    {
                        $create_notification->message = 'Hello '.$receiver_fname.' '.$receiver_lname.', Dr.'.$dr_fname.''.$dr_lname.' Sent you emr';
                    }
                    $create_notification->save();
            }

            $referral=request('referral');

            if(!empty($referral[0]))
            {
                $referral=    request('referral');
                $doctor =  request('doctor');
                $diagnosis=request('diagnosis');
                $referraldetails =     request('referraldetails');
                $speciality_name=Speciality::select('name')->whereIn('id',$referral)->get();
                $doctor_name=User::select('first_name')->whereIn('id',$doctor)->get();


                foreach ($referral as $key => $e) {

                    if($e != null)
                    {

                            $visit_referral = new Visit_Referral;
                            $visit_referral->emr_id=isset($emr_lastId)?$emr_lastId:'';
                            $visit_referral->speciality_id=$e ? $e :"";
                            $speciality_name=Speciality::select('name')->where('id',$e)->first();

                            $doctor_name=User::select('first_name')->whereIn('id',$doctor)->first();
                            $visit_referral->doctor_name=$doctor_name->first_name;
                            $visit_referral->speciality_name=$speciality_name->name;
                            $visit_referral->diagnosis=$diagnosis[$key]?$diagnosis[$key]:"";
                            $visit_referral->reason=$referraldetails[$key]?$referraldetails[$key]:"";
                            $visit_referral->patient_id = request('patient_id') ? request('patient_id'): "";
                            $visit_referral->doctor_id = request('doctor_id') ?request('doctor_id'):"";
                            $visit_referral->save();
                            $visit_id = $visit_referral->id;
                            $path = 'storage/pdf/referral/' .$visit_id. '_referral.pdf';
                            $visit_referral=Visit_Referral::where('id', $visit_id)->with('speciality','doctor')->get();

                            $pdf = PDF::loadView('admin.referral.refereal_pdf',compact('visit_referral'))->save($path);
                            Visit_Referral::where('id',$visit_id)->update(array('pdf'=>$path));
                    }
                }
            }

              // return response()->json(['data'=>"Added successfully"], 200);

              return response()->json(['data'=>"Added successfully"], 200);
          }
    }
    public function storeUserEmr(Request $request){

        $validator = Validator::make($request->all(), [
               // 'physicannote'  => 'required',
               'physicandiagnosis'  => 'required',

        ],
        [
            // 'physicannote.required'=>'Enter the physican note',
            'physicandiagnosis.required'=>'Enter the physican diagnosis',

        ]);
        if ($validator->fails()) {

            // $errorMessage = implode(',', $validator->errors()->all());
            $errorMessage = $validator->errors()->all();

            return response()->json(['errors' => $errorMessage], 422);

        } else {

            $bookingfrom_id=request('bookingform_id');

            $followupdate=EmrDetails::where('patient_id',request('patient_id'))->where('doctor_id',request('doctor_id'))->latest()->first();

            if($followupdate)
            {
                if($followupdate->call_type == 'regular')
                {
                    $call_type='followup';
                }
                elseif($followupdate->call_type == 'followup')
                {
                    $call_type='regular';
                }
                else
                {
                    $call_type='regular';    
                }
                
            }
            else
            {
                $call_type='regular';
            }
            

            $EmrDetails=new EmrDetails();
            $EmrDetails->type_visit=request('type_visit');
            $EmrDetails->patient_id=request('patient_id');
            $EmrDetails->doctor_id=request('doctor_id');
            $EmrDetails->emr_no=request('emrno');
            $EmrDetails->physican_note=request('physicannote');
            $EmrDetails->physican_diagonis_id=request('physicandiagnosis');
            $EmrDetails->doctorbookingform_id=isset($bookingfrom_id)?$bookingfrom_id:'0';
            // if(request('call_type') =='')
            // {
            //     $call_type='regular';
            // }
            // else
            // {
            //     $call_type=request('call_type');
            // }
            $EmrDetails->call_type=isset($call_type)?$call_type:'chat';
            $EmrDetails->followup_date=date('Y-m-d');
            $date_time=date('Y-m-d', strtotime(date('Y-m-d'). ' + 14 days'));
            $EmrDetails->enddate=$date_time;
            $EmrDetails->save();
            $emr_lastId = $EmrDetails->id;
            
            if($call_type == 'regular')
            {
                //Payment Functions
                $doctors=User::where('id',request('doctor_id'))->first();

                $fees=isset($doctors)?$doctors->fees:'';//Doctor Fees 

                $commission_final=isset($doctors)?$doctors->commision:'';//Doctor Commission 

                $discount=isset($doctors)?$doctors->discount:'';//Doctor Discount 

                

                $vats=Vat::first();

                $vat=isset($vats)?$vats->vat:'5';

                if($discount > 0)
                {
                    $feesdiscount=$fees*$discount/100;   
                    $discountprice=$fees-$feesdiscount;
                    $vat=$discountprice*$vat/100; //Vat Is Here 5%;
                    $total_fees=$vat+$discountprice;
                    $total_fees_with_vat=$total_fees;
                }
                else{
                    $vat=$fees*$vat/100; //Vat Is Here 5%;
                    $total_fees_with_vat=$vat+$fees;
                }
            
                $doctor_commission=$total_fees_with_vat*$commission_final/100;

                $patient_wallet=User::where('id',request('patient_id'))->first();//Patient Wallet Money

                $patient_wallet_money=isset($patient_wallet)?$patient_wallet->wallet_money:'';
                
                  

                    if($total_fees_with_vat >= $patient_wallet_money)
                    {
                        $update_patient_wallet_money=$total_fees_with_vat-$patient_wallet_money;
                    }
                    else
                    {
                        $update_patient_wallet_money=$patient_wallet_money-$total_fees_with_vat;
                    }//Update Wallet Money Patient

                    $patient_wallet=User::where('id',request('patient_id'))->update(['wallet_money'=>$update_patient_wallet_money]);//Update Patient Wallet

                    $clinic_wallet=DoctorClinic::where('user_id',request('doctor_id'))->first();//Doctor Clinic

                    $clinic=Clinic::where('id',isset($clinic_wallet)?$clinic_wallet->clinic_id:'')->first();//Clinic Wallet Money

                    if($clinic)
                    {
                        $clinic_name=isset($clinic->name)?$clinic->name:'';

                        if($clinic_name=='Ask' || $clinic_name=='ask')
                        {

                            $clinic_wallet_money=isset($clinic)?$clinic->wallet_money:'';

                            $update_clinic_money=$clinic_wallet_money+$doctor_commission;

                            $restdr_money=$total_fees_with_vat-$doctor_commission;

                            $clinic_wallets=Clinic::where('id',isset($clinic_wallet)?$clinic_wallet->clinic_id:'')->update(['wallet_money'=>$update_clinic_money]);//Update Patient 

                            $wallets=User::where('id',request('doctor_id'))->first();
                            if($wallets)
                            {
                                $totalMoney=$wallets->wallet_money+$restdr_money;
                            }
                            else
                            {
                                $totalMoney=$restdr_money;
                            }
                            

                            $patient_wallets=User::where('id',request('doctor_id'))->update(['wallet_money'=>$totalMoney]);

                            $ClinicWalletHistory=new DoctorWallet;
                            $ClinicWalletHistory->doctor_id=request('doctor_id');
                            $ClinicWalletHistory->commission=$doctor_commission;
                            $ClinicWalletHistory->amount=$restdr_money;
                            $ClinicWalletHistory->save();

                            //$doctors=User::where('id',request('patient_id'))->update(['wallet_money'=>$fees]);
                        }
                        else
                        {


                            $askclinic_wallet=Clinic::where('name','=','Ask')->first();
     
                            $clinic_wallet_money=isset($askclinic_wallet)?$askclinic_wallet->wallet_money:'';

                            $update_askmoney=$clinic_wallet_money+$doctor_commission;

                            $askclinic_wallets=Clinic::where('id',isset($askclinic_wallet)?$askclinic_wallet->clinic_id:'')->update(['wallet_money'=>$update_askmoney]);//Update Patient 

                            if(isset($askclinic_wallet))
                            {
                                    $ClinicWalletHistory=new ClinicWalletHistory;
                                    $ClinicWalletHistory->clinic_id=$askclinic_wallet->id;
                                    $ClinicWalletHistory->commission=$doctor_commission;
                                    $ClinicWalletHistory->doctor_id=request('doctor_id');
                                    $ClinicWalletHistory->amount=$doctor_commission;
                                    $ClinicWalletHistory->save();
                            }
                            
                            $restdr_money=$total_fees_with_vat-$doctor_commission;

                            $clinic_wallet_money=isset($clinic)?$clinic->wallet_money:'';

                            $update_clinic_money=$clinic_wallet_money+$doctor_commission;

                            $clinic_wallets=Clinic::where('id',isset($clinic_wallet)?$clinic_wallet->clinic_id:'')->update(['wallet_money'=>$restdr_money]);//Update Patient 
                            // $ClinicWalletHistory=new ClinicWalletHistory;
                            // $ClinicWalletHistory->clinic_id=isset($clinic_wallet)?$clinic_wallet->clinic_id:'';
                            // $ClinicWalletHistory->commission=$doctor_commission;
                            // $ClinicWalletHistory->doctor_id=request('doctor_id');
                            // $ClinicWalletHistory->save();

                            if(isset($clinic_wallet))
                            {
                                $ClinicWalletHistory=new ClinicWalletHistory;
                                $ClinicWalletHistory->clinic_id=$clinic_wallet->clinic_id;
                                $ClinicWalletHistory->commission=$doctor_commission;
                                $ClinicWalletHistory->doctor_id=request('doctor_id');
                                $ClinicWalletHistory->amount=$restdr_money;
                                $ClinicWalletHistory->save();
                            }


                        }
                    }

                

                    $payment_history = new Payment_history;
                    $payment_history->user_id = request('patient_id');      // user
                    $payment_history->user_id2 = request('doctor_id');  // doctor
                    $payment_history->price = $total_fees_with_vat;
                    $payment_history->message = "Pay fees of doctor SAR".$total_fees_with_vat;
                    $payment_history->save();

                    $doctorbill=new DoctorBill;
                    $doctorbill->patient_id=request('patient_id');
                    $doctorbill->doctor_id=request('doctor_id');
                    $doctorbill->clinic_id=isset($clinic_wallet)?$clinic_wallet->clinic_id:'-';
                    $doctorbill->doctor_fees=$fees;
                    $doctorbill->discount_fees=isset($discountprice)?$discountprice:'-';
                    $doctorbill->vat_fees=$total_fees_with_vat;
                    $doctorbill->emr_id=$emr_lastId;
                    $doctorbill->vat=$vat;
                    $doctorbill->bill_no=mt_rand(100000,999999);
                    $doctorbill->Audio_video_type=request('call_type');
                    $doctorbill->save();
                    $doctorbillid = $doctorbill->id;

                    //Report Bill
                    $path = 'storage/pdf/bill/' .$doctorbillid. '_bill.pdf';

                    $receiver_name = User::whereId(request('patient_id'))->first();

                    $doctor_name = User::whereId(request('doctor_id'))->first();

                    $receiver_device_id = isset($receiver_name)?$receiver_name->device_id:'';

                    $receiver_fname=isset($receiver_name)?$receiver_name->first_name:'';

                    $receiver_lname=isset($receiver_name)?$receiver_name->last_name:'';

                    $dr_fname=isset($doctor_name)?$doctor_name->first_name:'';

                    $dr_lname=isset($doctor_name)?$doctor_name->last_name:'';

                    $dr_code=isset($doctor_name)?$doctor_name->ask_id:'';

                    $emr=EmrDetails::where('id',$emr_lastId)->first();

                    $pdf = PDF::loadView('admin.Bill.visitbill',compact('receiver_fname','receiver_lname','dr_fname','dr_lname','doctorbill','emr','dr_code'))->save($path);

                    DoctorBill::where('id',$doctorbillid)->update(array('pdf'=>$path))  ;

                 
                     $data = array(
                        'sender_id' => isset($doctor_name)?$doctor_name->id:'',
                        'receiver_id' => isset($receiver_name)?$receiver_name->id:'',
                        'notification_type' => 'investigation'
                    );
                
                    $doctor_msg = array('message' => 'Hello '.$receiver_fname.' '.$receiver_lname.', Dr.'.$dr_fname.''.$dr_lname.' Sent you bill', 'data' => $data);

                    $pmsg = array(
                            'body' => 'Hello '.$receiver_fname.' '.$receiver_lname.', Dr.'.$dr_fname.''.$dr_lname.' Sent you bill',
                            'title' => isset($doctor_name)?'Message From Dr.'.$doctor_name->first_name.' '.$doctor_name->last_name:'',
                            'icon' => 'myicon',
                            'sound' => 'mySound'
                     );

                    PushNotification::SendPushNotification($pmsg, $doctor_msg, [$receiver_device_id]);

                    //End Report Bill
                   
                }
            

            
            
            
            $medicines=request('medicines');
           // is_null($result)
            if(!empty($medicines[0]))
            {
                $id=request('medicines');
                $medicine_name=Medicine::select('name')->whereIn('id',$id)->get();

                $dose = request('dose');
                $dosetype = request('dosetype');
                $frequency1 = request('frequency1');
                $frequency2 = request('frequency2');
                $frequency3 = request('frequency3');
                $duration = request('duration');
                $route = request('route');
                $visit_prescription = new Visit_Prescription;
                $visit_prescription->emr_id= $emr_lastId?$emr_lastId:'';
                $visit_prescription->patient_id = request('patient_id') ? request('patient_id'): "";
                $visit_prescription->doctor_id = request('doctor_id') ?request('doctor_id'):"";
                $visit_prescription->save();
                $visit_prescriptionid = $visit_prescription->id;
                foreach ($medicines as $key => $e) {

                    if($e != null)
                    {

                        if($e=='others')
                        {
                                $medicinestext=request('medicinestext');

                                            $medicine = new Medicine;
                                            $medicine->name=$medicinestext[$key]?$medicinestext[$key]:"0";
                                            $medicine->dose = $dose[$key] ? $dose[$key]: "0";
                                            $medicine->unit = $dosetype[$key] ? $dosetype[$key]:"";
                                            $medicine->frequency = $frequency1[$key] ? $frequency1[$key]:"0";
                                            $medicine->frequency2 = $frequency2[$key] ? $frequency2[$key]: "0";
                                            $medicine->frequency3 = $frequency3[$key] ? $frequency3[$key]:"0";
                                            $medicine->duration = $duration[$key] ? $duration[$key]: "";
                                            $medicine->route = $route[$key] ? $route[$key]: "";
                                            $medicine->save();
                                            $e = $medicine->id;
                                            $visit_prescription_data = new Visit_Data_Prescription;
                                            $visit_prescription_data->visit_prescription_id=isset($visit_prescriptionid)?$visit_prescriptionid:'';
                                            $visit_prescription_data->medicine_id = $e ? $e:"";
                                            $medicine_name=Medicine::select('name')->where('id',$e)->first();
                                            $visit_prescription_data->medicine_name = $medicine_name->name;
                                            $visit_prescription_data->dose = $dose[$key] ? $dose[$key]: "";
                                            $visit_prescription_data->unit = $dosetype[$key] ? $dosetype[$key]:"";
                                            $visit_prescription_data->frequency = $frequency1[$key] ? $frequency1[$key]:"0";
                                            $visit_prescription_data->frequency2 = $frequency2[$key] ? $frequency2[$key]: "0";
                                            $visit_prescription_data->frequency3 = $frequency3[$key] ? $frequency3[$key]:"0";
                                            $visit_prescription_data->duration = $duration[$key] ? $duration[$key]: "";
                                            $visit_prescription_data->route = $route[$key] ? $route[$key]: "";
                                            //$visit_prescription_data->patient_id = request('patient_id') ? request('patient_id'): "";
                                           // $visit_prescription_data->doctor_id = request('doctor_id') ?request('doctor_id'):"";
                                            //$visit_prescription->route = $route[$key] ? $route[$key]: "";
                                            $visit_prescription_data->save();
                                            $doctor_name=User::where('id',request('doctor_id'))->first();
                                            $patient_name=User::where('id',request('patient_id'))->first();
                                            $visit_id = $visit_prescription_data->id;
                                            $path = 'storage/pdf/prescription/' .$visit_id. '_labereport.pdf';
                                            $clinic=DoctorClinic::where('user_id',request('doctor_id'))->with('clinic')->first();
                                            $visit_prescription=Visit_Prescription::where('patient_id', request('patient_id'))->with('medicine','doctor','clinic')->get();
                                            $visit_prescription_doctor=Visit_Prescription::where('doctor_id', request('doctor_id'))->with('medicine','doctor','clinic')->get();

                                             $visit_prescription_data =Visit_Data_Prescription::where('visit_prescription_id', $visit_prescriptionid)->get();

                                            $pdf = PDF::loadView('admin.patient.visit_pdf',compact('visit_prescription_data','clinic','doctor_name','patient_name','visit_prescriptionid'))->save($path);
                                            Visit_Prescription::where('id',$visit_prescriptionid)->update(array('pdf'=>$path))  ;                                   
                        }
                        else{
                            $visit_prescription_data = new Visit_Data_Prescription;
                            $visit_prescription_data->visit_prescription_id=isset($visit_prescriptionid)?$visit_prescriptionid:'';
                            $visit_prescription_data->medicine_id = $e ? $e:"";
                            $medicine_name=Medicine::select('name')->where('id',$e)->first();
                            $visit_prescription_data->medicine_name = $medicine_name->name;
                            $visit_prescription_data->dose = $dose[$key] ? $dose[$key]: "";
                            $visit_prescription_data->unit = $dosetype[$key] ? $dosetype[$key]:"";
                            $visit_prescription_data->frequency = $frequency1[$key] ? $frequency1[$key]:"0";
                            $visit_prescription_data->frequency2 = $frequency2[$key] ? $frequency2[$key]: "0";
                            $visit_prescription_data->frequency3 = $frequency3[$key] ? $frequency3[$key]:"0";
                            $visit_prescription_data->duration = $duration[$key] ? $duration[$key]: "";
                            $visit_prescription_data->route = $route[$key] ? $route[$key]: "";
                            //$visit_prescription_data->patient_id = request('patient_id') ? request('patient_id'): "";
                           // $visit_prescription_data->doctor_id = request('doctor_id') ?request('doctor_id'):"";
                            //$visit_prescription->route = $route[$key] ? $route[$key]: "";
                            $visit_prescription_data->save();
                            $doctor_name=User::where('id',request('doctor_id'))->first();
                            $patient_name=User::where('id',request('patient_id'))->first();
                            $visit_id = $visit_prescription_data->id;
                            $path = 'storage/pdf/prescription/' .$visit_id. '_labereport.pdf';
                            $clinic=DoctorClinic::where('user_id',request('doctor_id'))->with('clinic')->first();
                            $visit_prescription=Visit_Prescription::where('patient_id', request('patient_id'))->with('medicine','doctor','clinic')->get();
                            $visit_prescription_doctor=Visit_Prescription::where('doctor_id', request('doctor_id'))->with('medicine','doctor','clinic')->get();

                             $visit_prescription_data =Visit_Data_Prescription::where('visit_prescription_id', $visit_prescriptionid)->get();

                            $pdf = PDF::loadView('admin.patient.visit_pdf',compact('visit_prescription_data','clinic','doctor_name','patient_name','visit_prescriptionid'))->save($path);
                            Visit_Prescription::where('id',$visit_prescriptionid)->update(array('pdf'=>$path))  ;    
                        }

                        
                    }

                }
            }

            $investigation=request('investigation');

            if(!empty($investigation[0]))
            {
                $investigation = request('investigation');
                $notes =     request('notes');
                $subinvestigation=request('subinvestigation');


                foreach ($investigation as $key => $e) {
                    if($e != null)
                    {
                        if($e=='others')
                        {
                            $investigationtext=request('investigationtext');
                            $subinvestigationtext=request('subinvestigationtext');

                            $DocumentType = new DocumentType;
                            $DocumentType->name=$investigationtext[$key]?$investigationtext[$key]:"0";
                            $DocumentType->save();
                            $e = $DocumentType->id;

                            $Investigation= new Investigation;
                            $Investigation->testname_english=$subinvestigationtext[$key]?$subinvestigationtext[$key]:"0";
                            $Investigation->type_id=$e;
                            $Investigation->save();
                            $type_id = $Investigation->id;                            

                            $visit_investigation = new Visit_Investigation;
                            $visit_investigation->emr_id=isset($emr_lastId)?$emr_lastId:'';
                            $visit_investigation->investigation_id = $e ? $e :"";
                            $visit_investigation->note = $notes[$key]?$notes[$key]:"";
                            $visit_investigation->type_id = $type_id;
                            $typename=DocumentType::where('id',$e)->first();
                            $investigation_name=Investigation::select('testname_english','type_name')->where('id',$type_id)->first();
                            $visit_investigation->investigation_name = $investigation_name->testname_english;
                            $visit_investigation->patient_id = request('patient_id') ? request('patient_id'): "";
                            $visit_investigation->doctor_id = request('doctor_id') ?request('doctor_id'):"";
                            $visit_investigation->type_name=$typename?$typename->name:'';
                            $visit_investigation->save();
                            $visit_id = $visit_investigation->id;
                            $path = 'storage/pdf/lab_reports/' .$visit_id. '_labereport.pdf';
                            $typename=strtolower(str_replace(' ', '-', $investigation_name->type_name));
                            
                            
                            $clinic=DoctorClinic::where('user_id',request('doctor_id'))->with('clinic')->first();

                            if($typename=='labreport')
                            {
                                $pdf = PDF::loadView('admin.investigation.investigationpdf',compact('visit_investigation','clinic'))->save($path);
                            }

                            if($typename=='xray')
                            {
                                $pdf = PDF::loadView('admin.investigation.new_xrayreport',compact('visit_investigation','clinic'))->save($path);
                            }
                          
                            Visit_Investigation::where('id',$visit_id)->update(array('pdf'=>$path));
                        }
                        else
                        {
                            $visit_investigation = new Visit_Investigation;
                            $visit_investigation->emr_id=isset($emr_lastId)?$emr_lastId:'';
                            $visit_investigation->investigation_id = $e ? $e :"";
                            $visit_investigation->note = $notes[$key]?$notes[$key]:"";
                            $visit_investigation->type_id = $subinvestigation[$key]?$subinvestigation[$key]:"";
                            $typename=DocumentType::where('id',$e)->first();
                            $investigation_name=Investigation::select('testname_english','type_name')->where('id',$subinvestigation[$key])->first();
                            $visit_investigation->investigation_name = $investigation_name->testname_english;
                            $visit_investigation->patient_id = request('patient_id') ? request('patient_id'): "";
                            $visit_investigation->doctor_id = request('doctor_id') ?request('doctor_id'):"";
                             $visit_investigation->type_name=$typename?$typename->name:'';
                            $visit_investigation->save();
                            $visit_id = $visit_investigation->id;
                            $path = 'storage/pdf/lab_reports/' .$visit_id. '_labereport.pdf';
                            $clinic=DoctorClinic::where('user_id',request('doctor_id'))->with('clinic')->first();
                            $typename=strtolower(str_replace(' ', '-', $investigation_name->type_name));
                            if($typename=='labreport')
                            {
                                $pdf = PDF::loadView('admin.investigation.investigationpdf',compact('visit_investigation','clinic'))->save($path);
                            }

                            if($typename=='xray')
                            {
                                $pdf = PDF::loadView('admin.investigation.new_xrayreport',compact('visit_investigation','clinic'))->save($path);
                            }

                            // $pdf = PDF::loadView('admin.investigation.investigationpdf',compact('visit_investigation','clinic'))->save($path);
                            Visit_Investigation::where('id',$visit_id)->update(array('pdf'=>$path));        
                        }
                    
            }

                }
            }

            if(!empty($investigation[0]) && !empty($medicines[0]) || !empty($investigation[0]) || !empty($medicines[0]) )
            {

                $receiver_name = User::whereId(request('patient_id'))->first();

                $doctor_name = User::whereId(request('doctor_id'))->first();

                $receiver_device_id = isset($receiver_name)?$receiver_name->device_id:'';

                $receiver_fname=isset($receiver_name)?$receiver_name->first_name:'';

                $receiver_lname=isset($receiver_name)?$receiver_name->last_name:'';

                $dr_fname=isset($doctor_name)?$doctor_name->first_name:'';

                $dr_lname=isset($doctor_name)?$doctor_name->last_name:'';

                $data = array(
                        'sender_id' => isset($doctor_name)?$doctor_name->id:'',
                        'receiver_id' => isset($receiver_name)?$receiver_name->id:'',
                        'notification_type' => 'investigation & prescription'
                );

                // if(isset($investigation_detail))
                // {
                //     $doctor_msg = array('message' => 'Hello '.$receiver_fname.' '.$receiver_lname.', Dr.'.$dr_fname.''.$dr_lname.' Sent you investigation', 'data' => $data);

                //     $pmsg = array(
                //             'body' => 'Hello '.$receiver_fname.' '.$receiver_lname.', Dr.'.$dr_fname.''.$dr_lname.' Sent you investigation',
                //             'title' => isset($doctor_name)?'Message From Dr.'.$doctor_name->first_name.' '.$doctor_name->last_name:'',
                //             'icon' => 'myicon',
                //             'sound' => 'mySound'
                //      );

                //     PushNotification::SendPushNotification($pmsg, $doctor_msg, [$receiver_device_id]);
                // }

                if(!empty($investigation[0]))
                {
                    $data = array(
                        'sender_id' => isset($doctor_name)?$doctor_name->id:'',
                        'receiver_id' => isset($receiver_name)?$receiver_name->id:'',
                        'notification_type' => 'investigation'
                    );
                
                    $doctor_msg = array('message' => 'Hello '.$receiver_fname.' '.$receiver_lname.', Dr.'.$dr_fname.''.$dr_lname.' Sent you investigation', 'data' => $data);

                    $pmsg = array(
                            'body' => 'Hello '.$receiver_fname.' '.$receiver_lname.', Dr.'.$dr_fname.''.$dr_lname.' Sent you investigation',
                            'title' => isset($doctor_name)?'Message From Dr.'.$doctor_name->first_name.' '.$doctor_name->last_name:'',
                            'icon' => 'myicon',
                            'sound' => 'mySound'
                     );

                    PushNotification::SendPushNotification($pmsg, $doctor_msg, [$receiver_device_id]);
                }

                // if(isset($prescription_detail))
                // {
                //     $doctor_msg = array(
                //         'message' => 'Hello '.$receiver_fname.' '.$receiver_lname.', Dr.'.$dr_fname.''.$dr_lname.' Sent you precription',
                //         'data' => $data
                //     );

                //     $pmsg = array(
                //             'body' => 'Hello '.$receiver_fname.' '.$receiver_lname.', Dr.'.$dr_fname.''.$dr_lname.' Sent you precription',
                //             'title' => isset($doctor_name)?'Message From Dr.'.$doctor_name->first_name.' '.$doctor_name->last_name:'',
                //             'icon' => 'myicon',
                //             'sound' => 'mySound'
                //      );

                //     PushNotification::SendPushNotification($pmsg, $doctor_msg, [$receiver_device_id]);
                // }


                if(!empty($medicines[0]))
                {
                    $data = array(
                        'sender_id' => isset($doctor_name)?$doctor_name->id:'',
                        'receiver_id' => isset($receiver_name)?$receiver_name->id:'',
                        'notification_type' => 'prescription'
                    );
                    
                    $doctor_msg = array(
                        'message' => 'Hello '.$receiver_fname.' '.$receiver_lname.', Dr.'.$dr_fname.''.$dr_lname.' Sent you prescription',
                        'data' => $data
                    );

                    $pmsg = array(
                            'body' => 'Hello '.$receiver_fname.' '.$receiver_lname.', Dr.'.$dr_fname.''.$dr_lname.' Sent you prescription',
                            'title' => isset($doctor_name)?'Message From Dr.'.$doctor_name->first_name.' '.$doctor_name->last_name:'',
                            'icon' => 'myicon',
                            'sound' => 'mySound'
                     );

                    PushNotification::SendPushNotification($pmsg, $doctor_msg, [$receiver_device_id]);
                }

                    $create_notification = new Notification;
                    $create_notification->from_id = request('doctor_id');
                    $create_notification->to_id = request('patient_id');

                    if(!empty($investigation[0]) && !empty($medicines[0]))
                    {
                        $create_notification->message = 'Hello '.$receiver_fname.' '.$receiver_lname.', Dr.'.$dr_fname.''.$dr_lname.' Sent you investigation & prescription';
                    }
                    elseif (!empty($medicines[0])) {
                            $create_notification->message = 'Hello '.$receiver_fname.' '.$receiver_lname.', Dr.'.$dr_fname.''.$dr_lname.' Sent you prescription';
                    }elseif(!empty($investigation[0]))
                    {
                        $create_notification->message = 'Hello '.$receiver_fname.' '.$receiver_lname.', Dr.'.$dr_fname.''.$dr_lname.' Sent you investigation';
                    }
                    else
                    {
                        $create_notification->message = 'Hello '.$receiver_fname.' '.$receiver_lname.', Dr.'.$dr_fname.''.$dr_lname.' Sent you emr';
                    }
                    $create_notification->save();
            }

            $referral=request('referral');

            if(!empty($referral[0]))
            {
                $referral=    request('referral');
                $doctor =  request('doctor');
                $diagnosis=request('diagnosis');
                $referraldetails =     request('referraldetails');
                $speciality_name=Speciality::select('name')->whereIn('id',$referral)->get();
                $doctor_name=User::select('first_name')->whereIn('id',$doctor)->get();


                foreach ($referral as $key => $e) {

                    if($e != null)
                    {

                            $visit_referral = new Visit_Referral;
                            $visit_referral->emr_id=isset($emr_lastId)?$emr_lastId:'';
                            $visit_referral->speciality_id=$e ? $e :"";
                            $speciality_name=Speciality::select('name')->where('id',$e)->first();

                            $doctor_name=User::select('first_name')->whereIn('id',$doctor)->first();
                            $visit_referral->doctor_name=$doctor_name->first_name;
                            $visit_referral->speciality_name=$speciality_name->name;
                            $visit_referral->diagnosis=$diagnosis[$key]?$diagnosis[$key]:"";
                            $visit_referral->reason=$referraldetails[$key]?$referraldetails[$key]:"";
                            $visit_referral->patient_id = request('patient_id') ? request('patient_id'): "";
                            $visit_referral->doctor_id = request('doctor_id') ?request('doctor_id'):"";
                            $visit_referral->save();
                            $visit_id = $visit_referral->id;
                            $path = 'storage/pdf/referral/' .$visit_id. '_referral.pdf';
                            $visit_referral=Visit_Referral::where('id', $visit_id)->with('speciality','doctor')->get();

                            $pdf = PDF::loadView('admin.referral.refereal_pdf',compact('visit_referral'))->save($path);
                            Visit_Referral::where('id',$visit_id)->update(array('pdf'=>$path));
                    }
                }
            }

              return response()->json(['data'=>"Added successfully"], 200);
          }

    }

    public function addEmrDetails(Request $request)
    {
        $validator = Validator::make($request->all(), [
          'type_visit'=>'required',
          'patient_id'=>'required',
          'emr_no'=>'required',
          'physican_diagonis_id'=>'required',
        ]);
        if ($validator->fails()) {
            $errorMessage = implode(',', $validator->errors()->all());
            return response()->json(['errors' => $errorMessage], 422);
        } else {

            $emrDetails = new EmrDetails;
            $emrDetails->type_visit = request('type_visit');
            $emrDetails->patient_id = request('patient_id');
            $emrDetails->doctor_id=request('doctor_id');
            $emrDetails->emr_no = request('emr_no');
            $emrDetails->physican_note=request('physican_note');
            $emrDetails->physican_diagonis_id = request('physican_diagonis_id');
            $emrDetails->visit_status=request('visit_status');
            $emrDetails->doctorbookingform_id=request('doctorbookingform_id');
            $emrDetails->save();
            $emr_lastId = $emrDetails->id;

                $investigation_detail=request('investigation_detail');
                $investigation_array = json_decode($investigation_detail);

                if(isset($investigation_array))
                {
                    
                    foreach ($investigation_array as $key => $value) {

                        $visit_investigation=new Visit_Investigation();
                        $visit_investigation->emr_id=isset($emr_lastId)?$emr_lastId:'';
                        $visit_investigation->investigation_id=$value->investigation_id;
                        $visit_investigation->note=$value->note;
                        $visit_investigation->investigation_name=$value->investigation_name;
                        $visit_investigation->patient_id=request('patient_id');
                        $visit_investigation->doctor_id=request('doctor_id');
                        $visit_investigation->type_name=request('type');
                        $visit_investigation->save();
                        $investigation_name=Investigation::select('testname_english')->where('id',$value->investigation_id)->first();
                        $visit_id = $visit_investigation->id;
                        $path = 'storage/pdf/lab_reports/' .$visit_id. '_labereport.pdf';
                        $clinic=DoctorClinic::where('user_id',request('doctor_id'))->with('clinic')->first();
                        $type=request('type');
                        

                        if($investigation_name->type_name='X-ray' || $investigation_name->type_name='x-ray')
                        {
                                $pdf = PDF::loadView('admin.investigation.new_xrayreport',compact('visit_investigation','clinic'))->save($path);
                        }

                        if($investigation_name->type_name=='Lab-Report'|| $investigation_name->type_name='lab-report')
                        {
                                $pdf = PDF::loadView('admin.investigation.investigationpdf',compact('visit_investigation','clinic'))->save($path);
                        }
                        Visit_Investigation::where('id',$visit_id)->update(array('pdf'=>$path));
                    }
                }


                $prescription_detail=request('prescription_detail');
                $prescription_array = json_decode($prescription_detail);

                if(isset($prescription_array))
                {
                    foreach ($prescription_array as $key => $value) {

                        $visit_prescription=new Visit_Prescription();
                        $visit_prescription->emr_id=isset($emr_lastId)?$emr_lastId:'';
                        $visit_prescription->medicine_id=$value->medicine_id;
                        $visit_prescription->medicine_name=$value->medicine_name;
                        $visit_prescription->dose=$value->dose;
                        $visit_prescription->unit=$value->unit;
                        $visit_prescription->duration=$value->duration;
                        $visit_prescription->route=$value->route;
                        $visit_prescription->frequency=$value->frequency;
                        $visit_prescription->frequency2=$value->frequency2;
                        $visit_prescription->frequency3=$value->frequency3;
                        $visit_prescription->patient_id=request('patient_id');
                        $visit_prescription->doctor_id=request('doctor_id');
                        $visit_prescription->save();
                        $visit_id = $visit_prescription->id;
                        $visit_prescriptionid=$visit_id;
                        $path = 'storage/pdf/prescription/' .$visit_id. '_labereport.pdf';
                        $clinic=DoctorClinic::where('user_id',request('doctor_id'))->with('clinic')->first();
                        $visit_medicine=Visit_Prescription::where('patient_id', request('patient_id'))->with('medicine','doctor','clinic')->get();


                        $pdf = PDF::loadView('admin.patient.visit_pdf',compact('visit_prescription','clinic','visit_prescriptionid'))->save($path);
                        Visit_Prescription::where('id',$visit_id)->update(array('pdf'=>$path));
                    }
                }

                if($investigation_detail && $prescription_detail || $investigation_detail || $prescription_detail )
                {
                    $receiver_name = User::whereId(request('patient_id'))->first();

                    $doctor_name = User::whereId(request('doctor_id'))->first();

                    $receiver_device_id = isset($receiver_name)?$receiver_name->device_id:'';

                    $receiver_fname=isset($receiver_name)?$receiver_name->first_name:'';

                    $receiver_lname=isset($receiver_name)?$receiver_name->last_name:'';

                    $dr_fname=isset($doctor_name)?$doctor_name->first_name:'';

                    $dr_lname=isset($doctor_name)?$doctor_name->last_name:'';

                    $data = array(
                            'sender_id' => isset($doctor_name)?$doctor_name->id:'',
                            'receiver_id' => isset($receiver_name)?$receiver_name->id:'',
                            'notification_type' => 'other'
                    );

                    if(isset($investigation_detail))
                    {
                        /* $doctor_msg = array('message' => 'Hello '.$receiver_fname.' '.$receiver_lname.', Dr.'.$dr_fname.''.$dr_lname.' Sent you investigation', 'data' => $data); */

                        $pmsg = array(
                                'body' => 'Hello '.$receiver_fname.' '.$receiver_lname.', Dr.'.$dr_fname.''.$dr_lname.' Sent you investigation',
                                'title' => isset($doctor_name)?'Message From Dr.'.$doctor_name->first_name.' '.$doctor_name->last_name:'',
                                'icon' => 'myicon',
                                'sound' => 'mySound'
                         );

                        PushNotification::SendPushNotification($pmsg, $data, [$receiver_device_id]);

                    }

                    if(isset($prescription_detail))
                    {
                        /* $doctor_msg = array(
                            'message' => 'Hello '.$receiver_fname.' '.$receiver_lname.', Dr.'.$dr_fname.''.$dr_lname.' Sent you precription',
                            'data' => $data
                        ); */

                        $pmsg = array(
                                'body' => 'Hello '.$receiver_fname.' '.$receiver_lname.', Dr.'.$dr_fname.''.$dr_lname.' Sent you prescription',
                                'title' => isset($doctor_name)?'Message From Dr.'.$doctor_name->first_name.' '.$doctor_name->last_name:'',
                                'icon' => 'myicon',
                                'sound' => 'mySound'
                         );

                        PushNotification::SendPushNotification($pmsg, $data, [$receiver_device_id]);
                    }

                        $create_notification = new Notification;
                        $create_notification->from_id = request('doctor_id');
                        $create_notification->to_id = request('patient_id');

                        if(isset($investigation_detail) &&isset($prescription_detail) )
                        {
                            $create_notification->message = 'Hello '.$receiver_fname.' '.$receiver_lname.', Dr.'.$dr_fname.''.$dr_lname.' Sent you investigation & prescription';
                        }
                        elseif (isset($prescription_detail)) {
                                $create_notification->message = 'Hello '.$receiver_fname.' '.$receiver_lname.', Dr.'.$dr_fname.''.$dr_lname.' Sent you prescription';
                        }
                        else
                        {
                            $create_notification->message = 'Hello '.$receiver_fname.' '.$receiver_lname.', Dr.'.$dr_fname.''.$dr_lname.' Sent you investigation';
                        }
                        $create_notification->save();
                }


                $referral_detail=request('referral_detail');
                $referral_array = json_decode($referral_detail);

                if(isset($referral_array))
                {
                    foreach ($referral_array as $key => $value) {

                        $visit_referral=new Visit_Referral();
                        $visit_referral->emr_id=isset($emr_lastId)?$emr_lastId:'';
                        $visit_referral->speciality_id=$value->speciality_id;
                        $visit_referral->doctor_id=$value->doctor_id;
                        $visit_referral->doctor_name=$value->doctor_name;
                        $visit_referral->speciality_name=$value->speciality_name;
                        $visit_referral->diagnosis=$value->diagnosis;
                        $visit_referral->reason=$value->reason;
                        $visit_referral->patient_id=request('patient_id');
                        $visit_referral->save();
                        $visit_id = $visit_referral->id;
                        $path = 'storage/pdf/referral/' .$visit_id. '_referral.pdf';
                        $visit_referral=Visit_Referral::where('id', $visit_id)->with('speciality','doctor')->get();

                        $pdf = PDF::loadView('admin.referral.refereal_pdf',compact('visit_referral'))->save($path);
                        Visit_Referral::where('id',$visit_id)->update(array('pdf'=>$path));
                    }
                }
        }

        return response()->json(['success' => true ], 200);

    }

    public function emrEdit(Request $request,$id)
    {

        $EmrDetails=EmrDetails::where('id',$id)->first();

        $Visit_Referral=Visit_Referral::where('emr_id',$id)->count();
        $Visit_Investigation=Visit_Investigation::where('emr_id',$id)->count();
        $Visit_Prescription=Visit_Prescription::where('emr_id',$id)->count();

        $investigationsarray=Visit_Investigation::where('emr_id',$id)->pluck('id','investigation_id')->toArray();
        $specialitys=Speciality::where('status',1)->get();
        $investigations=Investigation::where('status',1)->get();
        $medicines = Medicine::where('status',1)->get();
        $documentType=DocumentType::where('status',1)->get();
        // $medicinesarray=Visit_Prescription::where('emr_id',$id)->pluck('id','medicine_id')->toArray();
        $medicinesarray = [];

        $specialityarray=Visit_Referral::where('emr_id',$id)->pluck('id','speciality_id')->toArray();
        // dd($specialityarray);
       // $previsit =DoctorBookingForm::where('patient_id',isset($EmrDetails->patient_id)?$EmrDetails->patient_id:'')->first();

        return view('front.emr.EmrEdit',['EmrDetails'=>$EmrDetails,'Visit_Referral'=>$Visit_Referral,'Visit_Investigation'=>$Visit_Investigation,'Visit_Prescription'=>$Visit_Prescription,'investigationsarray'=>$investigationsarray,'investigations'=>$investigations,'medicines'=>$medicines,'medicinesarray'=>$medicinesarray,'specialitys'=>$specialitys,'specialityarray'=>$specialityarray,'documentType'=>$documentType]);
    }

    public function updateEmr(Request $request)
    {


        $physicannote=request('physicannote');

        $physicandiagnosis=request('physicandiagnosis');

        $visit_status=1;

        $emr_id=$request->id;

        $emardetals=EmrDetails::where('id',$emr_id)->update([
                'physican_note'=>$physicannote,
                'physican_diagonis_id'=>$physicandiagnosis,
                'visit_status'=>$visit_status
        ]);

        $medicines=request('medicines');

        if(isset($medicines))
            {


                $visit_prescription = Visit_Prescription::where('emr_id',$emr_id)->first();
                $visit_data_id = $visit_prescription->id;
                $visit_prescriptionid=$visit_data_id;
                Visit_Data_Prescription::where('visit_prescription_id',$visit_prescription->id)->delete();
                $id = request('medicines');
                $dose = request('dose');
                $dosetype = request('dosetype');
                $frequency1 = request('frequency1');
                $frequency2 = request('frequency2');
                $frequency3 = request('frequency3');
                $duration = request('duration');
                $route = request('route');

                foreach ($medicines as $key => $e) {
                  
                    if($e != null)
                    {
                        if($e=='others')
                        {
                                $medicinestext=request('medicinestext');

                                            $medicine = new Medicine;
                                            $medicine->name=$medicinestext[$key]?$medicinestext[$key]:"0";
                                            $medicine->dose = $dose[$key] ? $dose[$key]: "0";
                                            $medicine->unit = $dosetype[$key] ? $dosetype[$key]:"";
                                            $medicine->frequency = $frequency1[$key] ? $frequency1[$key]:"0";
                                            $medicine->frequency2 = $frequency2[$key] ? $frequency2[$key]: "0";
                                            $medicine->frequency3 = $frequency3[$key] ? $frequency3[$key]:"0";
                                            $medicine->duration = $duration[$key] ? $duration[$key]: "";
                                            $medicine->route = $route[$key] ? $route[$key]: "";
                                            $medicine->save();
                                            $e = $medicine->id;
                                            $visit_data_prescription = new Visit_Data_Prescription;
                                            $visit_data_prescription->visit_prescription_id =isset($visit_data_id)?$visit_data_id:'';
                                            $visit_data_prescription->medicine_id = $e ? $e:"";
                                            $medicine_name=Medicine::select('name')->where('id',$e)->first();
                                            $visit_data_prescription->medicine_name = $medicine_name->name;
                                            $visit_data_prescription->dose = $dose[$key] ? $dose[$key]: "0";
                                            $visit_data_prescription->unit = $dosetype[$key] ? $dosetype[$key]:"";
                                            $visit_data_prescription->frequency = $frequency1[$key] ? $frequency1[$key]:"0";
                                            $visit_data_prescription->frequency2 = $frequency2[$key] ? $frequency2[$key]: "0";
                                            $visit_data_prescription->frequency3 = $frequency3[$key] ? $frequency3[$key]:"0";
                                            $visit_data_prescription->duration = $duration[$key] ? $duration[$key]: "";
                                            $visit_data_prescription->route = $route[$key] ? $route[$key]: "";
                                            $visit_data_prescription->save();
                        }
                        else
                        {
                            $visit_data_prescription = new Visit_Data_Prescription;
                            $visit_data_prescription->visit_prescription_id =isset($visit_data_id)?$visit_data_id:'';
                            $visit_data_prescription->medicine_id = $e ? $e:"";
                            $medicine_name=Medicine::select('name')->where('id',$e)->first();
                            $visit_data_prescription->medicine_name = $medicine_name->name;
                            $visit_data_prescription->dose = $dose[$key] ? $dose[$key]: "0";
                            $visit_data_prescription->unit = $dosetype[$key] ? $dosetype[$key]:"";
                            $visit_data_prescription->frequency = $frequency1[$key] ? $frequency1[$key]:"0";
                            $visit_data_prescription->frequency2 = $frequency2[$key] ? $frequency2[$key]: "0";
                            $visit_data_prescription->frequency3 = $frequency3[$key] ? $frequency3[$key]:"0";
                            $visit_data_prescription->duration = $duration[$key] ? $duration[$key]: "";
                            $visit_data_prescription->route = $route[$key] ? $route[$key]: "";
                            $visit_data_prescription->save();
                        }
                        
                    }
                }
                $visit_prescription_data =Visit_Data_Prescription::where('visit_prescription_id', $visit_data_id)->get();
                // dd($visit_data_prescription);
                $path = 'storage/pdf/prescription/' .$visit_data_id. '_labereport.pdf';
                $clinic=DoctorClinic::where('user_id',request('doctor_id'))->with('clinic')->first();
                $visit_medicine= Visit_Prescription::where('patient_id', request('patient_id'))->with('medicine','doctor','clinic')->get();
                $doctor_name=User::where('id',request('doctor_id'))->first();
                        $patient_name=User::where('id',request('patient_id'))->first();
                $pdf = PDF::loadView('admin.patient.visit_pdf',compact('visit_prescription','visit_prescription_data','clinic','doctor_name','patient_name','visit_prescriptionid'))->save($path);
                Visit_Prescription::where('id',$visit_data_id)->update(array('pdf'=>$path))  ;
            }

        $investigation=request('investigation');

        if(isset($investigation))
        {
                Visit_Investigation::where('emr_id',$emr_id)->delete();
                $investigation=request('investigation');
                $notes =     request('notes');


                foreach ($investigation as $key => $e) {

                    $subinvestigation=request('subinvestigation');
                    // dd($subinvestigation);
                    if($e != null)
                    {
                        if($e=='others')
                        {
                        
                            $investigationtext=request('investigationtext');
                            $subinvestigationtext=request('subinvestigationtext');

                            $DocumentType = new DocumentType;
                            $DocumentType->name=$investigationtext[$key]?$investigationtext[$key]:"0";
                            $DocumentType->save();
                            $e = $DocumentType->id;

                            $Investigation= new Investigation;
                            $Investigation->testname_english=$subinvestigationtext[$key]?$subinvestigationtext[$key]:"0";
                            $Investigation->type_id=$e;
                            $Investigation->save();
                            $type_id = $Investigation->id;

                            $visit_investigation = new Visit_Investigation;
                            $visit_investigation->emr_id=isset($emr_id)?$emr_id:'';
                            $visit_investigation->investigation_id = $type_id ? $type_id :"";
                            $investigation_name=Investigation::select('testname_english','type_name')->where('id',$type_id)->first();
                            $visit_investigation->note = $notes[$key]?$notes[$key]:"";
                            $visit_investigation->type_id = $subinvestigation[$key]?$subinvestigation[$key]:"";
                            $visit_investigation->investigation_name = $investigation_name->testname_english;
                            $visit_investigation->patient_id = request('patient_id') ? request('patient_id'): "";
                            $visit_investigation->doctor_id = request('doctor_id') ?request('doctor_id'):"";
                            $visit_investigation->type_name=$investigation_name->type_name;
                            $visit_investigation->save();
                            $visit_id = $visit_investigation->id;
                            $path = 'storage/pdf/lab_reports/' .$visit_id. '_labereport.pdf';
                            $clinic=DoctorClinic::where('user_id',request('doctor_id'))->with('clinic')->first();
                            $typename=strtolower(str_replace(' ', '-', $investigation_name->type_name));
                            if($typename=='labreport')
                            {
                                $pdf = PDF::loadView('admin.investigation.investigationpdf',compact('visit_investigation','clinic'))->save($path);
                            }

                            if($typename=='xray')
                            {
                                $pdf = PDF::loadView('admin.investigation.new_xrayreport',compact('visit_investigation','clinic'))->save($path);
                            }
                            Visit_Investigation::where('id',$visit_id)->update(array('pdf'=>$path));                            

                        }
                        else
                        {
                            $visit_investigation = new Visit_Investigation;
                            $visit_investigation->emr_id=isset($emr_id)?$emr_id:'';
                            $visit_investigation->investigation_id = $e ? $e :"";
                            // $investigation_name=Investigation::select('testname_english','type_name')->where('id',$subinvestigation[$key])->first();
                            $visit_investigation->note = $notes[$key]?$notes[$key]:"";
                            $visit_investigation->type_id = $subinvestigation[$key]?$subinvestigation[$key]:"";
                            $typename=DocumentType::where('id',$e)->first();
                            $investigation_name=Investigation::select('testname_english','type_name')->where('id',$subinvestigation[$key])->first();
                            $visit_investigation->investigation_name = isset($investigation_name->testname_english)?$investigation_name->testname_english:'';
                            $visit_investigation->patient_id = request('patient_id') ? request('patient_id'): "";
                            $visit_investigation->doctor_id = request('doctor_id') ?request('doctor_id'):"";
                            $visit_investigation->type_name=isset($investigation_name->type_name)?$investigation_name->type_name:'';
                            $visit_investigation->save();
                            $visit_id = $visit_investigation->id;
                            $path = 'storage/pdf/lab_reports/' .$visit_id. '_labereport.pdf';
                            $clinic=DoctorClinic::where('user_id',request('doctor_id'))->with('clinic')->first();

                            $typename=strtolower(str_replace(' ', '-', isset($investigation_name->type_name)?$investigation_name->type_name:''));
                            if($typename=='labreport')
                            {
                                $pdf = PDF::loadView('admin.investigation.investigationpdf',compact('visit_investigation','clinic'))->save($path);
                            }

                            if($typename=='xray')
                            {
                                $pdf = PDF::loadView('admin.investigation.new_xrayreport',compact('visit_investigation','clinic'))->save($path);
                            }
                            Visit_Investigation::where('id',$visit_id)->update(array('pdf'=>$path));    
                        }
                        
                    }
                }
        }


        $referral=request('referral');

            if(isset($referral))
            {
                Visit_Referral::where('emr_id',$emr_id)->delete();
                $referral=    request('referral');
                $doctor =  request('doctor');
                $diagnosis=request('diagnosis');
                $referraldetails =     request('referraldetails');




                foreach ($referral as $key => $e) {

                    if($e != null)
                    {


                                $visit_referral = new Visit_Referral;
                                $visit_referral->emr_id=isset($emr_id)?$emr_id:'';
                                $visit_referral->speciality_id=$e ? $e :"";
                                $speciality_name=Speciality::select('name')->where('id',$e)->first();
                                $visit_referral->speciality_name=$speciality_name->name;
                                $doctor_name=User::select('first_name')->whereIn('id',$doctor)->first();
                                $visit_referral->doctor_name=isset($doctor_name)?$doctor_name->first_name:"";
                                $visit_referral->diagnosis=$diagnosis[$key]?$diagnosis[$key]:"";
                                $visit_referral->reason=$referraldetails[$key]?$referraldetails[$key]:"";
                                $visit_referral->patient_id = request('patient_id') ? request('patient_id'): "";
                                $visit_referral->doctor_id = request('doctor_id') ?request('doctor_id'):"";
                                $visit_referral->save();
                                $visit_id = $visit_referral->id;
                                $path = 'storage/pdf/referral/' .$visit_id. '_referral.pdf';
                                $visit_referral=Visit_Referral::where('id', $visit_id)->with('speciality','doctor')->get();

                                $pdf = PDF::loadView('admin.referral.refereal_pdf',compact('visit_referral'))->save($path);
                                Visit_Referral::where('id',$visit_id)->update(array('pdf'=>$path));
                    }
                }
            }

             return redirect()->route('front.home.emr');
    }

    public function deleteEmr(Request $request)
    {

    }

    public function getdiagonis(Request $request)
    {
        $doctor_id=request('doctor_id');
        $availableTutorials = [];
        $uri = 'https://id.who.int/icd/entity/search?q='.$doctor_id;
        $icd_api_client = new ICD_API_Client($uri);

        $response = $icd_api_client->get();

        if($response)
        {
            $array = $response->destinationEntities;
            foreach ($array as  $value) {
                $sub_array = [];
                $sub_array['label'] = strip_tags($value->title);
                $sub_array['id'] = $value->id;
                $availableTutorials[] = $sub_array;
            }

        }
        return response()->json($availableTutorials);
    }


    public function getspecialitywiseDoctor(Request $request)
    {
        $speciality_id = request('speciality_id');

        $count= request('count');

        $id=request('id');
        $stack = array(request('count'), request('id'));

        $response = User::whereHas('speciality',function($q) use ($speciality_id){
                $q->where('speciality_id',$speciality_id);
            })->with(['speciality' => function($p){
                $p->with('speciality');
            }])->with('education','experience')->where('status',1)->get();

            $response1 = [];
            foreach ($response as $value) {

                $array=array(
                        "first_name"=>isset($value->first_name) ?$value->first_name:'',
                        "last_name"=>isset($value->last_name) ?$value->last_name:'',
                        "count"=>isset($value) ?$count:'',
                        "id"=>isset($value) ?$id:'',
                        'doctor_id'=>isset($value->id)?$value->id:'',
                );
                $response1[]=$array;

            }
        return response()->json($response1);
    }

     public function getsubinvestigation(Request $request)
    {
        $speciality_id = request('investigation_id');

        $count= request('count');

        $id=request('id');

        $stack = array(request('count'), request('id'));

        $response = Investigation::where('type_id',$speciality_id)->get();
        // dd($speciality_id);
            $response1 = [];
            foreach ($response as $value) {

                $array=array(
                        "testname_english"=>isset($value->testname_english) ?$value->testname_english:'',
                        "count"=>isset($value) ?$count:'',
                        "id"=>isset($value) ?$id:'',
                        'investigation_id'=>isset($value->id)?$value->id:'',
                );
                $response1[]=$array;

            }
        return response()->json($response1);
    }

    public function getPrescription(Request $request)
    {
        $id=request('emr_id');

        $visit_prescriptions = Visit_Prescription::where('emr_id',$id)->first();
        // dd($visit_prescriptions->id);
         if($visit_prescriptions)
        {
            $visit_prescription = Visit_Data_Prescription::where('visit_prescription_id',$visit_prescriptions->id)->get();
            return $visit_prescription;
        }
        else
        {
            return 0;
        }
    }

    public function getinvestigation(Request $request)
    {
        $id=request('emr_id');

        $visit_investigation=Visit_Investigation::where('emr_id',$id)->get();

         if($visit_investigation)
        {

            return $visit_investigation;
        }
        else
        {
            return 0;
        }
    }

    public function getrefferal(Request $request)
    {
        $id=request('emr_id');

        $visit_referral=Visit_Referral::where('emr_id',$id)->get();

         if($visit_referral)
        {
            return $visit_referral;
        }
        else
        {
            return 0;
        }
    }

    public function removerefferal(Request $request)
    {
        $referral_id = request('referral_id');

        $visit_referral = Visit_Referral::where('id',$referral_id)->delete();;

        if($visit_referral)
        {
            return 0;
        }

        else
        {
            return 1;
        }
    }

    public function removeprescription(Request $request)
    {
        $prescription_id = request('prescription_id');

        $visit_prescription = Visit_Prescription::where('id',$prescription_id)->delete();;

        if($visit_prescription)
        {
            return 0;
        }

        else
        {
            return 1;
        }
    }

    public function removeinvestigation(Request $request)
    {
        $invest_id = request('invest_id');

        $visit_investigation = Visit_Investigation::where('id',$invest_id)->delete();;

        if($visit_investigation)
        {
            return 0;
        }

        else
        {
            return 1;
        }
    }

    public function getreports(Request $request)
    {
        $reports_id = request('reports_id');

        $user_id=Auth::user();

        $id=$user_id->id;

        $labreports=Visit_Investigation::where('id',$reports_id)->where('doctor_id',$id)->with('patient','doctor','investigation','uploadBy')->orderBy('id', 'desc')->get();

        $html='';
         foreach ($labreports as $labreport) {

             $html .='<h3><center>Lab Report Details</center></h3>
            <table class="table" style="border:none;">
              <tbody>
                <tr>
                  <td style="border:none;"><b>Patient Name: </b>'.(($labreport->patient)?$labreport->patient->first_name:'').'</td>
                </tr>
                <tr>
                  <td style="border:none;"><b>EMR Number: </b> '.(($labreport->patient)?$labreport->patient->emr_number:'').'</td>
                </tr>
                <tr>
                  <td style="border:none;"scope="row"><b>Report Type: </b> '.$labreport->investigation->testname_english.'</td>
                </tr>
                <tr>
                  <td style="border:none;"scope="row"><b>Report No: </b> '.$labreport->id.'</td>
                </tr>
                <tr>
                  <td style="border:none;"scope="row"><b>Description: </b> '.$labreport->note.'</td>
                </tr>
                <tr>
                  <td style="border:none;"scope="row"><b>Generated By: </b> '.(($labreport->doctor)?$labreport->doctor->first_name:'').'</td>

                </tr>
                <tr>
                  <td style="border:none;"scope="row"><b>Date Of Report Creation: </b> '.date("d-m-y", strtotime($labreport->created_at)).'</td>
                </tr><tr><td style="border:none;"scope="row"><b>Report Result: </td> </tr><tr> ';
                if($labreport->result){
                $reports_file=explode("| ",$labreport->result);
                foreach($reports_file as $reports)  {
                $html .= '<td><img src="'.env('STORAGE_FILE_PATH').'/'.$reports.'" alt="" width="100px" height="100px" class="img-responsive"></td> ';
                }}else{
                    $html .= '</tr><tr><td style="border:none;"scope="row"><b>Report result not found</b></td> </tr> </tbody>
                    </table>';
                }

         }




        return $html;

    }

    public function doctoreducation(Request $request) {

        $doctor_id = request('doctor_id');

        $doctor_education=DoctorEducation::where('user_id',$doctor_id)->get();

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


        $doctor_education = DoctorEducation::where('user_id',$doctor_id)->get();

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

        $doctor_experience=DoctorExperience::where('user_id',$doctor_id)->get();

        if($doctor_experience)
        {
            return $doctor_experience;
        }
        else
        {
            return 0;
        }
    }

    public function remove_experience(Request $request) {

        $doctor_id = request('doctor_id');

        $doctor_experience = DoctorExperience::where('user_id',$doctor_id)->get();

        if($doctor_experience)
        {
            return 0;
        }
        else
        {
            return 1;
        }
    }

    public function chatmessages(Request $request,$id)
    {
        $receptorUser = User::where('id', '=', $id)->first();

        if($receptorUser == null) {
            return view('front.index', compact('userName'));
        }else {
            //$users = User::where('id', '!=', Auth::user()->id)->take(10)->get();

            $chat = $this->hasChatWith($receptorUser->id);
            $receiver_id=$receptorUser->id;
            $sender_name=isset($user->first_name)?$user->first_name.$user->last_name:'';
            $user=auth()->user();
            $sender_id=$user->id;

            $userss = User::where('id',$sender_id)->first();
            $lastvisit = EmrDetails::where('patient_id',$sender_id)->orderBy('id', 'desc')->first();
            if($lastvisit==null || $lastvisit->type_visit==null)    {
                $type_visit='First Visit';
            }else{
                if($lastvisit->type_visit=='First Visit' || $lastvisit->type_visit=='first visit'){
                    $memberid='Succesive Visit 0';
                    $visit_id=++$memberid;
                }else{
                    $memberid = $lastvisit->type_visit;
                    $visit_id=++$memberid;
                }
                $type_visit=$visit_id;
            }

            $emr_number=$userss->emr_number;
             $medicines = Medicine::where('status',1)->get();

        $investigations=Investigation::where('status',1)->get();

        $specialitys=Speciality::where('status',1)->get();

        $documentType=DocumentType::where('status',1)->get();

            return view('front.user.chat', compact('receptorUser', 'chat','user','receiver_id','sender_name','sender_id','type_visit','emr_number','medicines','investigations','specialitys','documentType'));
        }
    }

    public function hasChatWith($userId)
    {
        $unique_node = Auth::user()->id . '-' . $userId;

        $chat = Messages::where('sender_id', Auth::user()->id)
            ->where('receiver_id', $userId)
            ->orWhere('sender_id', $userId)
            ->where('receiver_id', Auth::user()->id)
            ->get();

        if(!$chat->isEmpty()){
            return $chat->first();
        }else{
            return $this->createChat(Auth::user()->id,$userId);
        }
    }

    public function createChat($userId1, $userId2)
    {

        $unique_node = $userId1 . '-' . $userId2;

        $chat = Messages::create([
            'id'=>$unique_node,
            'sender_id' => $userId1,
            'receiver_id' => $userId2
        ]);

        return $chat;
    }

    public function loginquickblox($id){
        // echo $id;exit;
        //  use Config;
        $nonce = rand();
        $timestamp = time(); // time() method must return current timestamp in UTC but seems like hi is return timestamp in current time zone
        $signature_string = "application_id=".env('APPLICATION_ID')."&auth_key=".env('AUTH_KEY')."&nonce=".$nonce."&timestamp=".$timestamp."&user[login]=".env('USER_LOGIN')."&user[password]=".env('USER_PASSWORD');
        $signature = hash_hmac('sha1', $signature_string , env('AUTH_SECRET'));

        $post_body = http_build_query(array(
                 'application_id' => env('APPLICATION_ID'),
                 'auth_key' => env('AUTH_KEY'),
                 'timestamp' => $timestamp,
                 'nonce' => $nonce,
                 'signature' => $signature,
                 'user[login]' => env('USER_LOGIN'),
                 'user[password]' => env('USER_PASSWORD')
                 ));

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, env('QB_API_ENDPOINT') . '/' . env('QB_PATH_SESSION')); // Full path is - https://api.quickblox.com/session.json
        curl_setopt($curl, CURLOPT_POST, true); // Use POST
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post_body); // Setup post body
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // Receive server response
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_POSTREDIR, true);
        // Execute request and read response
        $response = curl_exec($curl);
        if ($response) {
         // echo $response . "\n";
        } else {
                 $error = curl_error($curl). '(' .curl_errno($curl). ')';
                 echo $error . "\n";
        }
        // print_r($response);
         // Close connection
        curl_close($curl);
        // exit;
    }
    public function videocall(Request $request,$id)
    {
        $sender_id = auth()->user();
        $sinch_ticket = SinchTicketGenerator::generateTicket($sender_id->mobile);


        $doctor = User::whereId($id)->first();

        $da=DoctorAvailability::where('patient_id',$id)->orWhere('doctor_id',$id)->update(['status'=>'0']);

        $mobile=isset($doctor->mobile)?$doctor->mobile:'';

        $lastvisit = EmrDetails::where('patient_id',$id)->orderBy('id', 'desc')->first();

        //$previsit =DoctorBookingForm::where('patient_id',isset($id_patient)?$id_patient:'')->first();


        if($lastvisit==null || $lastvisit->type_visit==null)
        {
            $type_visit='First Visit';
        }
        else
        {
            if($lastvisit->type_visit=='First Visit' || $lastvisit->type_visit=='first visit')
            {
                $memberid='Succesive Visit 0';
                $visit_id=++$memberid;

            }
            else
            {
                $memberid = $lastvisit->type_visit;
                $visit_id=++$memberid;

            }
            $type_visit=$visit_id;

        }

        return view('front.user.video_2',[
          'sinch_ticket' => $sinch_ticket,
          'email'=>$sender_id->email,
          'password'=>$sender_id->password,
          'mobile'=>$mobile,
          'id'=>$id,'type_visit'=>$type_visit,'patient_id'=>$id,'emr_number'=>isset($users->$doctor)?$users->$doctor:''
        ]);
    }

    public function send_request($userid)
    {

       $user_id= $userid;

       $sender_id = auth()->user();

       $id=request('id');

       //$doctor = User::whereId($user_id)->first();
       $doctor = User::where('mobile',$user_id)->first();
        $patient_id=User::where('id',$id)->first();
        $patient_device_id=$patient_id->device_id;

        $doctor_device_id = $doctor->device_id;


        $create_room_id = new VideoCallRoomDetail;
        $create_room_id->from_id = $sender_id->id;
        $create_room_id->to_id = $id;
        $create_room_id->room_id = '111111';
        $create_room_id->type='video';
        $create_room_id->booking_id='1';
        $create_room_id->save();


        $create_notification = new Notification;
        $create_notification->from_id = $sender_id->id;
        $create_notification->to_id = $id;
        $create_notification->message = 'Incoming web video call from '.$sender_id->first_name.' '.$sender_id->last_name;
        $create_notification->type='video';
        $create_notification->booking_id='1';
        $create_notification->save();



        // End Room Id
        $data = array(
            'patient_id' => '$sender_id->id',
            'doctor_id' =>' $user_id',
            'call_room_number' =>'aaaaa',
            'notification_type' => 'video_call_request',
            'call_type' => 'video',
            'booking_id'=>'1'
        );


        $pmsg = array(
                'body' => 'Incoming video call from '.$sender_id->first_name.' '.$sender_id->last_name.'- EMR No:'.$sender_id->emr_number,
                'title' => 'Incoming Video call',
                'icon' => 'myicon',
                'sound' => 'mySound'
        );

        PushNotification::SendPushNotification($pmsg, $data, [$patient_device_id]);
    }

    public function send_video_push($userid)
    {

        $sender = auth()->user();
        $receiver = User::where('mobile',$userid)->first();
        if($sender->hasRole('doctor')){
          $doctor_id = $sender->id;
          $patient_id = $receiver->id;
        }else{
          $patient_id = $sender->id;
           $doctor_id = $receiver->id;

        }
        if($receiver) {

            // End Room Id
            $data = array(
                'patient_id' => $patient_id,
                'doctor_id' =>$doctor_id,
                'call_room_number' =>'aaaaa',
                'notification_type' => 'video_call_request',
                'call_type' => 'video',
                'booking_id'=>'1'
            );


            $pmsg = array(
                    'body' => 'Incoming video call from '.$sender->first_name.' '.$sender->last_name.'- EMR No:'.$sender->emr_number,
                    'title' => 'Incoming Video call',
                    'icon' => 'myicon',
                    'sound' => 'mySound'
            );

            return PushNotification::SendPushNotification($pmsg, $data, [$receiver->device_id]);
          }
    }

    public function send_video_push_request($userid,$doctor)
    {

        $sender = User::where('mobile',$doctor)->first();
        $receiver = User::where('mobile',$userid)->first();
        // // if($sender->hasRole('doctor')){
        // //   $doctor_id = $sender->id;
        // //   $patient_id = $receiver->id;
        // // }else{
           $patient_id = $receiver->id;
           $doctor_id = $sender->id;

        // }
        if($receiver) {

            // End Room Id
            $data = array(
                'patient_id' => $patient_id,
                'doctor_id' =>$doctor_id,
                'call_room_number' =>'aaaaa',
                'notification_type' => 'video_call_request',
                'call_type' => 'video',
                'booking_id'=>'1'
            );


            $pmsg = array(
                    'body' => 'Incoming video call from '.$sender->first_name.' '.$sender->last_name.'- EMR No:'.$sender->emr_number,
                    'title' => 'Incoming Video call',
                    'icon' => 'myicon',
                    'sound' => 'mySound'
            );

            return PushNotification::SendPushNotification($pmsg, $data, [$receiver->device_id]);
          }
    }

    public function endvideocall(Request $request,$id)
    {

        $user=User::where('id',Auth::user()->id)->first();

        //$sender_id = auth()->user();

        if($user->roles()->first()->id=='2')
        {
            return 1;
            //return redirect()->route('front.home.dashboard');
        }
        if($user->roles()->first()->id=='3')
        {
            return 2;
            //return redirect()->route('front.home.addemr',$id);
        }

    }


    public function checkavoilable(){
        if(Auth::check()){
            $doctor_available = DoctorAvailability::where('doctor_id',auth()->user()->id)->first();
            if($doctor_available == null)
            {
                $doctor_available = DoctorAvailability::create([
                            'doctor_id' => auth()->user()->id,
                            'status' => 0]);
            }else
            {
                if($doctor_available->status == 0){
                    $doctor_available = DoctorAvailability::where('doctor_id',auth()->user()->id)->update(['status'=>1]);
                    return "Unavailable";
                }else{
                    $doctor_available = DoctorAvailability::where('doctor_id',auth()->user()->id)->update(['status'=>0]);
                    return "Available";
                }
            }
        }
    }

    public function notcheckavoilable(){
        // auth()->user()->id;
        if(Auth::check()){
            $doctor_available = DoctorAvailability::where('doctor_id',auth()->user()->id)->first();
            if($doctor_available == null)
            {
                $doctor_available = DoctorAvailability::create([
                            'doctor_id' => auth()->user()->id,
                            'status' => 0]);
            }else
            {
                $doctor_available = DoctorAvailability::where('doctor_id',auth()->user()->id)->update(['status'=>1]);
            }
            return redirect()->back();
        }
        return redirect()->back();
    }

// chat
    public function callchathistory(){
        return view('front.appointment.callchathistory');
    }
    public function getcallhistory(Request $request){

        $user_id = auth()->user()->id;

        $response=[];
        $rolearray = auth()->user()->roles()->get();
        foreach ($rolearray as $role)
        {
            if ($role->name == 'patient')
            {
                $callhistory = Chathistory::select('call_history.*','users.first_name','users.emr_number','users.last_name','users.mobile','users.profile_pic','users.gender')->join('users', 'call_history.doctor_id', '=', 'users.id')
                ->Where('call_history.userid',$user_id)
                ->orderBy('created_at', 'DESC')->get();
            }else{
                $callhistory=Chathistory::select('call_history.*','users.first_name','users.emr_number','users.last_name','users.mobile','users.profile_pic','users.gender')
                ->join('users', 'call_history.userid', '=', 'users.id')
                ->Where('call_history.doctor_id',$user_id)
                ->orderBy('created_at', 'DESC')->get();
            }
        }
        $sub = [];
        foreach ($callhistory as $key => $call){
                $sub[$key][] = "<div>".$call->emr_number."</div>";
                $sub[$key][] = "<div>".$call->first_name."</div>";
                $sub[$key][] = "<div>".date_format($call->created_at,"d-m-Y H:i:s")."</div>";
                $sub[$key][]='&nbsp
                <button class="btn-transparent videocall_btn" value="'.(($call['userid']) ? $call['userid']:'').'"  ><i class="fa fa-video-camera"></i></button>';
        }
        $userjson = json_encode(["data" => $sub]);
        echo $userjson;
    }

    public function getchathistory(Request $request)
    {

            $rolearray = auth()->user()->roles()->get();
            foreach ($rolearray as $role)
            {
                if ($role->name == 'patient')
                {
                $chathistory = Chat::select('chats.*','users.first_name','users.last_name','users.mobile','users.profile_pic','users.gender')->leftjoin('users', 'chats.user_id', '=', 'users.id')
                ->Where('chats.doctor_id',auth()->user()->id)
                ->orderBy('created_at', 'DESC')->get();
                    // $chathistory  = Chat::where('user_id', auth()->user()->id)->get();
                }else{
                    $chathistory = Chat::select('chats.*','users.first_name','users.last_name','users.mobile','users.profile_pic','users.gender')->leftjoin('users', 'chats.user_id', '=', 'users.id')
                ->Where('chats.doctor_id',auth()->user()->id)
                ->orderBy('created_at', 'DESC')->get();
                    // $chathistory  = Chat::where('doctor_id', auth()->user()->id)->get();
                }
            }
            $chatsub = [];
            foreach ($chathistory as $keys => $chat){
                    $c_datetime = date_create($chat->c_datetime);
                    $chatsub[$keys][] = "<div>".$chat->first_name."</div>";
                    $chatsub[$keys][] = "<div>".$chat->message."</div>";
                    $chatsub[$keys][] = "<div>". (date_format($c_datetime,"d-m-Y H:i:s")) ."</div>";
                    $chatsub[$keys][] = '<a href="'.route("front.home.chat",($chat['user_id']) ? $chat['user_id']:'').'"><i class="fa fa-comments"></i></a>';
            }
            $chatjson = json_encode(["data" => $chatsub]);
            echo $chatjson;
    }

    public function medicalrecord(Request $request)
    {
        $medicine = '';
        $medicines = request('medicines');
        if($medicines){
            $medicine = Medicine::where('id',$medicines)->first();
        }
        // $response1 = [];
        // foreach ($medicine as $value) {

        //     $array=array(
        //             "id"=>isset($value->id) ?$value->id:'',
        //             "name"=>isset($value->name) ?$value->name:'',
        //             "last_name"=>isset($value->dose) ?$value->dose:'',
        //             "count"=>isset($route) ?$count:'',
        //             "id"=>isset($value) ?$id:'',
        //             'doctor_id'=>isset($value->id)?$value->id:'',
        //     );
        //     $response1[]=$array;

        // }
        return response()->json($medicine);
    }



    public function getnotification(){
        $userid = auth()->user()->id;
        $cout = Notification::where('to_id',$userid)->where('type','=','chat')->count();
        $document=Notification::where('to_id',$userid)->where('type','=','chat')->latest()->first();

        if(isset($document))
        {
            $user = User::where('id',$document->from_id)->first();
            $patient_name=$user->first_name;
            $link='https://askurdr.com/front/chat/'.$document->from_id;
        }

        $newarray=array(
            'count'=>$cout,
            'path'=>isset($link)?$link:'',
            'patientname'=>isset($patient_name)?$patient_name:'-'
        );

        return $newarray;
    }

     public function getdocumentcount(){
        $userid = auth()->user()->id;
        $cout = VideoCallDocumentDetail::where('from_id',$userid)->count();
        
        return $cout;
    }

    public function getdocument(){
        $userid = auth()->user()->id;
        $cout = VideoCallDocumentDetail::where('from_id',$userid)->count();
        $document=VideoCallDocumentDetail::where('from_id',$userid)->latest()->first();

        if(isset($document))
        {
            $user = User::where('id',$document->to_id)->first();
            $patient_name=$user->first_name;
        }

        $newarray=array(
            'count'=>$cout,
            'path'=>$document->document,
            'patientname'=>isset($patient_name)?$patient_name:'-'
        );
        return $newarray;
    }


    public function sendpushnotification(Request $request){
        // dd($request->id);
        if($request->id){
            $userid = auth()->user()->id;
            $user = User::where('id',$request->id)->first();
            $device_id = $user->device_id;
            $data = array(
                'sender_id' => $request->id,
                'receiver_id' => isset($userid)?$userid:'',
                'notification_type' => 'message',
                
            );

            $pmsg = array(
                'body' => auth()->user()->first_name." ". auth()->user()->last_name ." send message",
                'title' => 'Message From '.auth()->user()->first_name.' '.auth()->user()->last_name,
                'icon' => 'myicon',
                'sound' => 'mySound'
            );

            PushNotification::SendPushNotification($pmsg, $data, [$device_id]);
        }
        // $cout = Notification::where('to_id',$userid)->count();
        // return $cout;
    }
    
    public function documentvideocall(Request $request)
    {
        return view('front.documentvideocall.index');
    }

    public function videocallArray(Request $request)
    {

        $user_id=Auth::user();

        $id=$user_id->id;

        $response = [];

        $patient=VideoCallDocumentDetail::where('from_id',$id)->get();
        
        $patients = $patient->toArray();


        foreach ($patients as $patient) {

                $sub = [];

                $id = $patient['id'];

                $sub[] = $id;

                $patient_name=User::where('id',$patient['to_id'])->first();

                $sub[] = ($patient_name) ? ucfirst($patient_name->first_name).' '.$patient_name->last_name: "-";

                $sub[]='<a href="'.env('STORAGE_FILE_PATH').$patient['document'].'" target="_"><i class="fa fa-file-pdf-o"></i></a>';

                $sub[] = $response[] = $sub;
        }

        $userjson = json_encode(["data" => $response]);

        echo $userjson;
    }

    public function clearnotification(Request $request)
    {
        $user_id=Auth::user();
        
        $id=$user_id->id;

        Notification::where('to_id',$id)->delete();

        return redirect()->back();

    }



    // public function create_pdf_bill(){
    //     $userid = auth()->user()->id;
    //     $user = auth()->user();
    //     $path = 'storage/pdf/bill/' .$userid. '_bill.pdf';
    //     $pdf = PDF::loadView('admin.callbill.userbill')->save($path);
    //     try {
    //             Mail::send('emailtemplate.sendbill', ['user' => $user], function ($m) use ($user) {
    //                 $m->from('purvesh151@gmail.com', 'Your Application');
    //                 $m->to('purvesh.innovius@gmail.com', 'purvesh')->subject('Your Bill!');
    //                 $m->attach($pdf);
    //             });    
    //     } catch (Exception $e) {
            
    //     }
        
    // }


    // public function create_pdf_bill(){
    //     // dd("asdas");
    //     $userid = auth()->user()->id;
    //     $path = 'storage/pdf/bill/' .$userid. '_bill.pdf';
    //     $pdf = PDF::loadView('admin.callbill.userbill')->save($path);
        
    // }



}
