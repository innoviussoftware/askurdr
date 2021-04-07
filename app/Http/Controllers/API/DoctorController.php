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
use App\DoctorClinic;
use App\DocumentType;
use App\Speciality;
use App\MasterAdminSetting;
use App\DoctorBooking;
use App\DoctorAvailability;
use App\Notification;
use App\VideoCallRoomDetail;
use App\DoctorBookingForm;
use App\EmrDetails;
use App\Visit_Investigation;
use App\Visit_Prescription;
use App\Visit_Data_Prescription;
use App\Visit_Referral;
use App\Prescription;
use App\PrescriptionMedicines;
use App\Investigation;
use App\DoctorLanguage;
use App\DoctorBill;
use App\Insurancecompany;
use App\ClinicWalletHistory;
use DB;
use PDF;
use Mail;
use App\Notifications\WelcomeUser;
use App\Notifications\DoctorBookingMail;
use App\Notifications\PatientBooking;
use App\Notifications\MailResetPasswordNotification;
use App\Helpers\Notification\PushNotification;
use Illuminate\Support\Facades\Storage;
use App\VideoCallDocumentDetail;
use App\Chathistory;
use App\Payment_history;
use App\DoctorWallet;
use App\Vat;
class DoctorController extends Controller
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

    public function clinicwisedoctor(Request $request)
    {
        $validator = Validator::make($request->all(), [
          'clinic_id'=>'required',
          'language'=>'required'
        ]);

        if ($validator->fails()) {
            $errorMessage = implode(',', $validator->errors()->all());
            return response()->json(['errors' => $errorMessage], 422);
        } else {
            $clinic_id = request('clinic_id');
            if(request('language') == 'ar'){
                $doctor = User::select('id','ar_first_name as first_name','last_name')->whereHas('clinic',function($q) use ($clinic_id){
                    $q->where('clinic_id',$clinic_id);
                })->where('status',1)->get();
            }else{
                $doctor = User::select('id','first_name','last_name')->whereHas('clinic',function($q) use ($clinic_id){
                    $q->where('clinic_id',$clinic_id);
                })->where('status',1)->get();
            }

            return response()->json(['doctors' => $doctor], 200);
        }
    }

    public function doctordetail(Request $request)
    {
        // $user = auth()->user();
        $doctor_id = request('doctor_id');        

        $doctor = User::whereId($doctor_id)->with(['clinic' => function($q){
            $q->with('clinic');
        }])->with(['speciality' => function($p){
            $p->with('speciality');
        }])->with('education','experience','days')->first();

        return response()->json(['doctors' => $doctor], 200);

    }


    public function specialitywisedoctor(Request $request)
    {
        // dd("Asd");
        $user = Auth::user();  
        if(request('speciality_id') != null)
        {
            $speciality_id = request('speciality_id');
            if(request('language') == 'ar'){
                $response = User::select('*','users.ar_askid as ask_doctor_id','users.ar_first_name as first_name','users.ar_doctorcode as group_code',DB::raw('fees * discount /100  as discountprice'))->whereHas('speciality',function($q) use ($speciality_id){
                    $q->where('speciality_id',$speciality_id);
                })->with(['speciality' => function($p){
                    $p->with('speciality');
                }])->with('education','experience')->where('status',1)->get();

                foreach ($response as $key => $value) {
                   $doctorid = $value->id;
                   $language = DoctorLanguage::where('user_id',$doctorid)->get();
                        $followupdate=EmrDetails::where('patient_id',$user->id)->where('doctor_id',$doctorid)->latest()->first();
                        
                        $currentdate=date('Y-m-d');
                        if(isset($followupdate)){
                            if($followupdate->enddate <= $currentdate)
                            {
                                    $value['followup_or_not'] = 'true';
                                    $followupdate=EmrDetails::where('id',$followupdate->id)->update(['call_type'=>'followup']);
                                    $value['call_type'] = 'followup';
                            }
                            else{
                                    $value['followup_or_not'] = 'false';
                                    $followupdate=EmrDetails::where('id',$followupdate->id)->update(['call_type'=>'regular']);
                                    $value['call_type'] = 'regular';
                            }
                        }
                        if($language){
                            $lan = '';
                            foreach ($language as $lkey => $lvalue) {
                                $lan .=  $lvalue->language->ar_name.',';
                            }
                            $lan = rtrim($lan, ',');
                            $value['speak_language'] = $lan;

                        }

                        $value['followup_date'] = isset($followupdate->followup_date)?$followupdate->followup_date:'';
                        $value['call_type'] = 'regular';
                        $value['followup_or_not'] = isset($followupdate)?$value['followup_or_not']:'false';
                }
                
                
            }else{
               $response = User::select('*','users.ask_id as ask_doctor_id','users.doctor_code as group_code',DB::raw('fees * discount /100  as discountprice'))->whereHas('speciality',function($q) use ($speciality_id){
                    $q->where('speciality_id',$speciality_id);
                })->with(['speciality' => function($p){
                    $p->with('speciality');
                }])->with('education','experience')->where('status',1)->get();

                  foreach ($response as $key => $value) {
                   $doctorid = $value->id;
                   $language = DoctorLanguage::where('user_id',$doctorid)->get();
                        $followupdate=EmrDetails::where('patient_id',$user->id)->where('doctor_id',$doctorid)->latest()->first();
                        
                        $currentdate=date('Y-m-d');
                        if(isset($followupdate)){
                            if($followupdate->enddate <= $currentdate)
                            {
                                    $value['followup_or_not'] = 'true';
                                    $followupdate=EmrDetails::where('id',$followupdate->id)->update(['call_type'=>'followup']);
                                    $value['call_type'] = 'followup';
                            }
                            else{
                                    $value['followup_or_not'] = 'false';
                                    $followupdate=EmrDetails::where('id',$followupdate->id)->update(['call_type'=>'regular']);
                                    $value['call_type'] = 'regular';
                            }
                        }
                        if($language){
                            $lan = '';
                            foreach ($language as $lkey => $lvalue) {
                                $lan .=  $lvalue->language->name.',';
                            }
                            $lan = rtrim($lan, ',');
                            $value['speak_language'] = $lan;

                        }

                        $value['followup_date'] = isset($followupdate->followup_date)?$followupdate->followup_date:'';
                        $value['call_type'] = 'regular';
                        $value['followup_or_not'] = isset($followupdate)?$value['followup_or_not']:'false';
                }
                
                
            }
        }
        else
        {
            if(request('language') == 'ar'){
                $response = User::select('*','users.ar_askid as ask_doctor_id','users.ar_first_name as first_name',DB::raw('fees * discount /100  as discountprice'))->whereHas('roles', function ($q) {
                    $q->where('id', 2);
                })->with(['speciality' => function($p){
                    $p->with('speciality');
                }])->with(['clinic' => function($r){
                    $r->with('clinic');
                }])->with('education','experience')->where('status',1)->get();
                  foreach ($response as $key => $value) {
                   $doctorid = $value->id;
                   $language = DoctorLanguage::where('user_id',$doctorid)->get();
                        $followupdate=EmrDetails::where('patient_id',$user->id)->where('doctor_id',$doctorid)->latest()->first();
                        
                        $currentdate=date('Y-m-d');
                        if(isset($followupdate)){
                            if($followupdate->enddate <= $currentdate)
                            {
                                    $value['followup_or_not'] = 'true';
                                    $followupdate=EmrDetails::where('id',$followupdate->id)->update(['call_type'=>'followup']);
                                    $value['call_type'] = 'followup';
                            }
                            else{
                                    $value['followup_or_not'] = 'false';
                                    $followupdate=EmrDetails::where('id',$followupdate->id)->update(['call_type'=>'regular']);
                                    $value['call_type'] = 'regular';
                            }
                        }
                        if($language){
                            $lan = '';
                            foreach ($language as $lkey => $lvalue) {
                                $lan .=  $lvalue->language->ar_name.',';
                            }
                            $lan = rtrim($lan, ',');
                            $value['speak_language'] = $lan;

                        }

                        $value['followup_date'] = isset($followupdate->followup_date)?$followupdate->followup_date:'';
                        $value['call_type'] = 'regular';
                        $value['followup_or_not'] = isset($followupdate)?$value['followup_or_not']:'false';
                }
                
            }else{
                $response = User::select('*','users.ask_id as ask_doctor_id',DB::raw('fees * discount /100  as discountprice'))->whereHas('roles', function ($q) {
                    $q->where('id', 2);
                })->with(['speciality' => function($p){
                    $p->with('speciality');
                }])->with(['clinic' => function($r){
                    $r->with('clinic');
                }])->with('education','experience')->where('status',1)->get();
                  foreach ($response as $key => $value) {
                   $doctorid = $value->id;
                   $language = DoctorLanguage::where('user_id',$doctorid)->get();
                        $followupdate=EmrDetails::where('patient_id',$user->id)->where('doctor_id',$doctorid)->latest()->first();
                        
                        $currentdate=date('Y-m-d');
                        if(isset($followupdate)){
                            if($followupdate->enddate <= $currentdate)
                            {
                                    $value['followup_or_not'] = 'true';
                                    $followupdate=EmrDetails::where('id',$followupdate->id)->update(['call_type'=>'followup']);
                                    $value['call_type'] = 'followup';
                            }
                            else{
                                    $value['followup_or_not'] = 'false';
                                    $followupdate=EmrDetails::where('id',$followupdate->id)->update(['call_type'=>'regular']);
                                    $value['call_type'] = 'regular';
                            }
                        }
                        if($language){
                            $lan = '';
                            foreach ($language as $lkey => $lvalue) {
                                $lan .=  $lvalue->language->name.',';
                            }
                            $lan = rtrim($lan, ',');
                            $value['speak_language'] = $lan;

                        }

                        $value['followup_date'] = isset($followupdate->followup_date)?$followupdate->followup_date:'';
                        $value['call_type'] = 'regular';
                        $value['followup_or_not'] = isset($followupdate)?$value['followup_or_not']:'false';
                }
                
            }
        }

        return response()->json($response, 200);
    }

    public function bookingform(Request $request)
    {
        $validator = Validator::make($request->all(), [
          'patient_id'=>'required',
          'doctor_id'=>'required',
          'description'=>'required',
          'reason'=>'required',
          'report'=>'required',
          'from_where'=>'required',
        ]);

        $report_file_data = '';
        if(request('report') == 1)
        {
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
        }

        $doctor_booking_form = new DoctorBookingForm;
        $doctor_booking_form->patient_id = request('patient_id');
        $doctor_booking_form->doctor_id = request('doctor_id');
        $doctor_booking_form->reason = request('reason');
        $doctor_booking_form->description = request('description');
        $doctor_booking_form->report = request('report');
        $doctor_booking_form->booking_id=request('booking_id');
        $doctor_booking_form->report_file = $report_file_data;
        $doctor_booking_form->from_where=request('from_where');
        $doctor_booking_form->save();

        return response()->json(['success' => true ], 200);

    }


    public function doctorbooking(Request $request)
    {
        $validator = Validator::make($request->all(), [
          'patient_id'=>'required',
          'doctor_id'=>'required',
          'date'=>'required',
          'time'=>'required',
        ]);

        $date = date('Y-m-d',strtotime(request('date')));
        $time = request('time');

        $check_doctor_booking = DoctorBooking::where('doctor_id',request('doctor_id'))->where('date',$date)->where('time',request('time'))->count();

        if($check_doctor_booking > 3)
        {
            return response()->json(['errors' => 'This doctor already booked on this date and time slot.'], 422);
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
            $doctor_booking->patient_id = request('patient_id');
            $doctor_booking->date = $date;
            $doctor_booking->time = request('time');
            $doctor_booking->time_slot = $appointment_date;
            $doctor_booking->save();

            $doctor = User::whereId(request('doctor_id'))->first();
            $patient = User::whereId(request('patient_id'))->first();

            $doctor_device_id = $doctor->device_id;

            $data = array(
                'patient_id' => $patient->id,
                'doctor_id' => $doctor->id,
                'notification_type' => 'Booking'
            );

            /* $doctor_msg = array('message' => 'Hello '.$doctor->first_name.', You have new appointment booking request from '.$patient->first_name.' '.$patient->last_name.' at '.request('date').' '.$appointment_date, 'data' => $data); */

            $pmsg = array(
                'body' => 'Hello '.$doctor->first_name.', You have new appointment booking request from '.$patient->first_name.' '.$patient->last_name.' at '.request('date').' '.$appointment_date,
                'title' => 'New appointment Booking',
                'icon' => 'myicon',
                'sound' => 'mySound'
            );

            PushNotification::SendPushNotification($pmsg, $data, [$doctor_device_id]);

            $create_notification = new Notification;
            $create_notification->from_id = $patient->id;
            $create_notification->to_id = request('doctor_id');
            $create_notification->message = 'Hello incoming video call from '.$patient->first_name.' '.$patient->last_name;
            $create_notification->save();

            try {
               // $patient->notify(new PatientBooking($patient,$doctor,$doctor_booking,$appointment_date));
                //$doctor->notify(new DoctorBookingMail($doctor,$patient,$doctor_booking,$appointment_date));
            } catch (Exception $e) {
            }

            // return response()->json([
            //     'success' => true,
            //     'doctor_booking'=>$doctor_booking,
            //      ], 200);
            return response()->json([ 'data'=>$doctor_booking ], 200);

        }

    }

    public function sendEmail(Request $request)
    {
        $patient_id=request('patient_id');

        $doctor_id=request('doctor_id');

        $doctor_booking_id=request('doctor_booking_id');

        $appointment_time = request('time');

        $doctor = User::whereId(request('doctor_id'))->first();

        $patient = User::whereId(request('patient_id'))->first();

        $doctor_booking=DoctorBooking::whereId(request('doctor_booking_id'))->first();

        try
        {
                $patient->notify(new PatientBooking($patient,$doctor,$doctor_booking,$appointment_time));
                $doctor->notify(new DoctorBookingMail($doctor,$patient,$doctor_booking,$appointment_time));
        }
        catch (Exception $e)
        {

        }

        return response()->json(['success' => true ], 200);
    }

    public function getappointment()
    {
        $date = date('Y-m-d');

        $time = date('H');


        $doctor_id = auth()->user()->id;

        $doctor_appointment = DoctorBooking::with(['patient' => function($q){
            $q->select('id','first_name','last_name','mobile','emr_number','profile_pic','quickblox_id');
        }])->where('date','=',$date)->where('doctor_id',$doctor_id)->get();



        $response = array();

        // foreach($doctor_appointment as $d)
        // {

        //   $time_value = date('H',strtotime($d->time));

        //     if($time <= $time_value)
        //      {

        //          $response[] = $d;
        //      }
        // }

        foreach($doctor_appointment as $d)
        {
                 $response[] = $d;
        }
        return response()->json(['booking' => $response ], 200);
    }

    public function getpatientappointment()
    {
        $date = date('Y-m-d');
        $time = date('g A');
        $patient_id = auth()->user()->id;

        $patient_appointment = DoctorBooking::with(['doctor' => function($q){
            $q->select('id','first_name','last_name','mobile','quickblox_id');
            $q->with(['clinic' => function($p){
                $p->with(['clinic']);
            }]);
        }])->where('date','>=',$date)->where('patient_id',$patient_id)->get();

        return response()->json(['booking' => $patient_appointment ], 200);
    }

    public function getpastpatientappointment()
    {
        $date = date('Y-m-d');
        $time = date('g A');
        $patient_id = auth()->user()->id;

        // dd($patient_id);
        $patient_appointment = DoctorBooking::with(['doctor' => function($q){
            $q->select('id','first_name','last_name','mobile','quickblox_id');
            $q->with(['clinic' => function($p){
                $p->with(['clinic']);
            }]);
        }])->where('date','<=',$date)->where('doctor_id',$patient_id)->get();
        // dd($patient_appointment);
        return response()->json(['data' => $patient_appointment ], 200);
    }

    public function sendcallrequest(Request $request)
    {

        $validator = Validator::make($request->all(), [
          'doctor_id'=>'required',
        ]);

        $patient_id = auth()->user()->id;
        $type=request('type');
        $booking_id=request('booking_id');

        //Notification
        $patient = User::whereId($patient_id)->first();

        $doctor = User::whereId(request('doctor_id'))->first();
        $doctor_device_id = $doctor->device_id;
        // dd($doctor_device_id);
        // Create Room id
        $room_id = 'eclinic_'.rand(100000,999999);


        $create_room_id = new VideoCallRoomDetail;
        $create_room_id->from_id = $patient_id;
        $create_room_id->to_id = request('doctor_id');
        $create_room_id->room_id = $room_id;
        $create_room_id->type=$type;
        $create_room_id->booking_id=$booking_id;
        $create_room_id->save();

        
        
        
        // End Room Id
        $data = array(
            'patient_id' => $patient_id,
            'doctor_id' => $doctor->id,
            'call_room_number' => $room_id,
            'notification_type' => 'video_call_request',
            'call_type' => $type,
            'booking_id'=>$booking_id,
            'followup_date'=>request('followup_date'),
            'followup_call_type'=>request('followup_call_type'),
            //new params
            'room_id' => $create_room_id->room_id,
            'patient_doc_id'=>request('patient_doc_id'),
        );
        

        if($type=='audio')
        {
            //$doctor_msg = array('message' => 'Incoming audio call from '.$patient->first_name.' '.$patient->last_name.'- EMR No:'.$patient->emr_number , 'data' => $data);

            $pmsg = array(
                'body' => 'Incoming audio call from '.$patient->first_name.' '.$patient->last_name.'- EMR No:'.$patient->emr_number,
                'title' => 'Incoming Audio call',
                'icon' => 'myicon',
                'sound' => 'mySound',
            );
            PushNotification::SendPushNotification($pmsg, $data, [$doctor_device_id]);
        }

        if($type=='video')
        {
            //$doctor_msg = array('message' => 'Incoming video call from '.$patient->first_name.' '.$patient->last_name.'- EMR No:'.$patient->emr_number , 'data' => $data);

            $pmsg = array(
                'body' => 'Incoming video call from '.$patient->first_name.' '.$patient->last_name.'- EMR No:'.$patient->emr_number ,
                'title' => 'Incoming Video call',
                'icon' => 'myicon',
                'sound' => 'mySound'
            );
            PushNotification::SendPushNotification($pmsg, $data, [$doctor_device_id]);
        }




        $create_notification = new Notification;
        $create_notification->from_id = $patient_id;
        $create_notification->to_id = request('doctor_id');
        $create_notification->message = 'Hello incoming video call from '.$patient->first_name.' '.$patient->last_name;
        $create_notification->type=$type;
        $create_notification->booking_id=$booking_id;
        $create_notification->save();

        return response()->json(['data' => $data,'success' => true ], 200);

    }


    public function sendcallrequesttopatient(Request $request)
    {

        $validator = Validator::make($request->all(), [
          'patient_id'=>'required',
        ]);

        $doctor_id = auth()->user()->id;
        $type=request('type');
        $booking_id=request('booking_id');
        //Notification
        $doctor = User::whereId($doctor_id)->first();
        $patient = User::whereId(request('patient_id'))->first();
        // dd($patient);
        $patient_device_id = $patient->device_id;

        // Create Room Id
        $room_id = 'eclinic_'.rand(100000,999999);


        $create_room_id = new VideoCallRoomDetail;
        $create_room_id->from_id = $doctor_id;
        $create_room_id->to_id = request('patient_id');
        $create_room_id->room_id = $room_id;
        $create_room_id->type=$type;
        $create_room_id->booking_id=$booking_id;
        $create_room_id->save();

        // End Room Id
        $data = array(
            'doctor_id' => $doctor_id,
            'patient_id' => $patient->id,
            'call_room_number' => $room_id,
            'notification_type' => 'video_call_request',
            'call_type'=>$type,
            'booking_id'=>$booking_id
        );

        if($type=='audio')
        {
                // $patient_msg = array('message' => 'Incoming audio call from '.$doctor->first_name, 'data' => $data);

                $pmsg = array(
                        'body' => 'Incoming audio call from Dr.'.$doctor->first_name,
                        'title' => 'Incoming audio call',
                        'icon' => 'myicon',
                        'sound' => 'mySound'
                );
                PushNotification::SendPushNotification($pmsg, $data, [$patient_device_id]);
        }

        if($type=='video')
        {
                // $patient_msg = array('message' => 'Incoming video call from '.$doctor->first_name, 'data' => $data);

                $pmsg = array(
                        'body' => 'Incoming video call from Dr.'.$doctor->first_name,
                        'title' => 'Incoming Video call',
                        'icon' => 'myicon',
                        'sound' => 'mySound'
                );

                PushNotification::SendPushNotification($pmsg, $data, [$patient_device_id]);
        }



        $create_notification = new Notification;
        $create_notification->from_id = $doctor_id;
        $create_notification->to_id = request('patient_id');
        $create_notification->message = 'Hello '.$patient->first_name.' '.$patient->last_name.' incoming video call from '.$doctor->first_name;
        $create_notification->type=$type;
        $create_notification->booking_id=$booking_id;   
        $create_notification->save();

        return response()->json(['data' => $data,'success' => true ], 200);

    }


    public function getnotification()
    {
        $to_id = auth()->user()->id;
        $notification = Notification::with(['from_user' => function($q){
            $q->select('first_name','last_name','id');
        },'to_user' => function($p){
            $p->select('first_name','last_name','id');
        }])->where('to_id',$to_id)->get();

        return response()->json(['notification' => $notification,'success' => true ], 200);

    }

    public function deletenotification(Request $request)
    {
        $notification = Notification::whereId(request('notification_id'))->delete();
        return response()->json(['success' => true ], 200);
    }

    public function previsitBookingForm(Request $request)
    {
            $patient_id=request('patient_id');

            $booking_id=request('booking_id');

            if($booking_id > 0)
            {
                $previsit=DoctorBookingForm::where('booking_id',$booking_id)->orderBy('id', 'desc')->first();
            }
            else
            {
                $previsit=DoctorBookingForm::where('patient_id',$patient_id)->orderBy('id', 'desc')->first();
            }


            return response()->json($previsit, 200);
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
        $date=request('followup_date');
        $emrDetails->followup_date=$date;
        $emrDetails->call_type=request('call_type');
        $date_time=date('Y-m-d', strtotime($date. ' + 14 days'));
        $emrDetails->enddate=$date_time;
        $emrDetails->save();
        $emr_lastId = $emrDetails->id;

            $investigation_detail= request('investigation_detail');

            if($investigation_detail[0] !==null || $investigation_detail[0] !=='""')
            {
            
                $investigation_array = json_decode($investigation_detail);
                
                foreach ($investigation_array as $key => $value) {
                    // dd($value);
                    $visit_investigation=new Visit_Investigation();
                    $visit_investigation->emr_id=isset($emr_lastId)?$emr_lastId:'';
                    $visit_investigation->investigation_id=$value->investigation_id;
                    
                    $visit_investigation->note=$value->note;
                    $visit_investigation->investigation_name = $value->investigation_name;
                    $visit_investigation->type_id =$value->type_id;
                    $visit_investigation->investigation_name =$value->type_name ;
                    $visit_investigation->patient_id=request('patient_id');
                    $visit_investigation->doctor_id=request('doctor_id');
                    $visit_investigation->type_name=$value->type;
                    $visit_investigation->save();
                    $visit_id = $visit_investigation->id;
                    $path = 'storage/pdf/lab_reports/' .$visit_id. '_labereport.pdf';
                    $clinic=DoctorClinic::where('user_id',request('doctor_id'))->with('clinic')->first();
                    $type=$value->type;
                    if($type='X-ray' || $type='x-ray')
                    {
                        $pdf = PDF::loadView('admin.investigation.new_xrayreport',compact('visit_investigation','clinic'))->save($path);
                    }

                    if($type='Lab-Report' || $type='lab-report')
                    {
                        $pdf = PDF::loadView('admin.investigation.investigationpdf',compact('visit_investigation','clinic'))->save($path);
                    }
                    Visit_Investigation::where('id',$visit_id)->update(array('pdf'=>$path));
                }
            }


            $prescription_detail=request('prescription_detail');
           
            // if($prescription_detail[0] !='""')
            // {
            //     dd('here');
            // }
            
            if($prescription_detail[0] !=null|| $prescription_detail[0] !='""')
            {
                
                 $prescription_array = json_decode($prescription_detail);
                //  dd($prescription_array);
            $visit_prescription = new Visit_Prescription;
            $visit_prescription->emr_id= $emr_lastId?$emr_lastId:'';
            $visit_prescription->patient_id = request('patient_id') ? request('patient_id'): "";
            $visit_prescription->doctor_id = request('doctor_id') ?request('doctor_id'):"";
            $visit_prescription->save();
            $visit_prescriptionid = $visit_prescription->id;
                foreach ($prescription_array as $key => $value) {
                    $visit_data_prescription = new Visit_Data_Prescription();
                    $visit_data_prescription->visit_prescription_id = isset($visit_prescription->id)?$visit_prescription->id:'';
                    $visit_data_prescription->medicine_id=$value->medicine_id;
                    $visit_data_prescription->medicine_name=$value->medicine_name;
                    $visit_data_prescription->dose= $value->dose ? $value->dose : 0;
                    $visit_data_prescription->unit=$value->unit;
                    $visit_data_prescription->duration=$value->duration;
                    $visit_data_prescription->route=$value->route;
                    $visit_data_prescription->frequency= $value->frequency ? $value->frequency : 0;
                    $visit_data_prescription->frequency2=$value->frequency2 ? $value->frequency2 : 0;
                    $visit_data_prescription->frequency3=$value->frequency3 ?$value->frequency3 : 0;
                     $visit_data_prescription->emr_id=$emr_lastId?$emr_lastId:'';
                    $visit_data_prescription->save();
                    $visit_id = $visit_data_prescription->id;
                }
                $visit_prescription_data = Visit_Data_Prescription::where('visit_prescription_id', $visit_prescriptionid)->get();
                // print_r($visit_prescription_data);
                // dd($visit_prescription_data->id);
                $path = 'storage/pdf/prescription/' .$visit_prescriptionid. '_prescription.pdf';
                $clinic=DoctorClinic::where('user_id',request('doctor_id'))->with('clinic')->first();
                $visit_medicine=Visit_Prescription::where('patient_id', request('patient_id'))->with('medicine','doctor','clinic','patient')->get();
                $doctor_name=User::where('id',request('doctor_id'))->first();
                        $patient_name=User::where('id',request('patient_id'))->first();
                $pdf = PDF::loadView('admin.patient.visit_pdf',compact('visit_prescription','visit_prescription_data','clinic','doctor_name','patient_name','visit_prescriptionid'))->save($path);
                Visit_Prescription::where('id',$visit_prescriptionid)->update(array('pdf'=>$path));
            }
              // dd($visit_prescription_data);
            if($investigation_detail[0] !='""' && $prescription_detail[0] !='""' || $investigation_detail[0] !='""' || $prescription_detail[0] !='""' )
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

                if($investigation_detail[0] !==null)
                {
                    /* $doctor_msg = array('message' => 'Hello '.$receiver_fname.' '.$receiver_lname.', Dr.'.$dr_fname.''.$dr_lname.' Sent you investigation', 'data' => $data); */
                    $data = array(
                        'sender_id' => isset($doctor_name)?$doctor_name->id:'',
                        'receiver_id' => isset($receiver_name)?$receiver_name->id:'',
                        'notification_type' => 'investigation'
                    );
                
                    $pmsg = array(
                            'body' => 'Hello '.$receiver_fname.' '.$receiver_lname.', Dr.'.$dr_fname.''.$dr_lname.' Sent you investigation',
                            'title' => isset($doctor_name)?'Message From Dr.'.$doctor_name->first_name.' '.$doctor_name->last_name:'',
                            'icon' => 'myicon',
                            'sound' => 'mySound'
                     );

                    PushNotification::SendPushNotification($pmsg, $data, [$receiver_device_id]);
                }

                if($prescription_detail[0] !==null)
                {
                    /* $doctor_msg = array(
                        'message' => 'Hello '.$receiver_fname.' '.$receiver_lname.', Dr.'.$dr_fname.''.$dr_lname.' Sent you precription',
                        'data' => $data
                    ); */
                    
                    $data = array(
                        'sender_id' => isset($doctor_name)?$doctor_name->id:'',
                        'receiver_id' => isset($receiver_name)?$receiver_name->id:'',
                        'notification_type' => 'prescription'
                );

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

                    if($investigation_detail[0]!==null && $prescription_detail[0] !==null )
                    {
                        $create_notification->message = 'Hello '.$receiver_fname.' '.$receiver_lname.', Dr.'.$dr_fname.''.$dr_lname.' Sent you investigation & prescription';
                    }
                    elseif ($prescription_detail[0] !==null) {
                            $create_notification->message = 'Hello '.$receiver_fname.' '.$receiver_lname.', Dr.'.$dr_fname.''.$dr_lname.' Sent you prescription';
                    }
                    else
                    {
                        $create_notification->message = 'Hello '.$receiver_fname.' '.$receiver_lname.', Dr.'.$dr_fname.''.$dr_lname.' Sent you investigation';
                    }
                    $create_notification->save();
            }


            $referral_detail=request('referral_detail');
            

            if($referral_detail[0] !==null || $referral_detail[0] !== '')
            {
                $referral_array = json_decode($referral_detail);
                foreach ($referral_array as $key => $value) {

                    $visit_referral=new Visit_Referral();
                    $visit_referral->emr_id=isset($emr_lastId)?$emr_lastId:'';
                    $visit_referral->speciality_id=$value->speciality_id;
                    $visit_referral->doctor_id=$value->doctor_id;
                    $visit_referral->doctor_name= $value->doctor_name;
                    // $visit_referral->doctor_name= "sadsad";
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

        return response()->json(['emr_lastId'=>$emr_lastId,'success' => true ], 200);

    }


    public function editemrDetails(Request $request)
    {


            $emr_id=request('emr_id');

            $physicannote=request('physicannote');

            $physicandiagnosis=request('physicandiagnosis');

            $visit_status=request('visit_status');

            $emardetals=EmrDetails::where('id',$emr_id)->update([
                'physican_note'=>$physicannote,
                'physican_diagonis_id'=>$physicandiagnosis,
                'visit_status'=>$visit_status
            ]);


            $investigation_detail=request('investigation_detail');
            Visit_Investigation::where('emr_id',$emr_id)->delete();
            $investigation_array = json_decode($investigation_detail);
            if($investigation_detail[0] !==null || $investigation_detail[0] !=='=')
            {

                    foreach ($investigation_array as $key => $value) {


                            $visit_investigation=new Visit_Investigation();
                            $visit_investigation->emr_id=isset($emr_id)?$emr_id:'';
                            $visit_investigation->investigation_id=$value->investigation_id;
                            $visit_investigation->investigation_name=$value->investigation_name;
                            $visit_investigation->type_id =$value->type_id;
                            $visit_investigation->investigation_name =$value->subinvestigation_name;
                            $visit_investigation->note=$value->note;
                            $visit_investigation->type_name=$value->type_name;
                            $visit_investigation->patient_id=request('patient_id');
                            $visit_investigation->doctor_id=request('doctor_id');
                            $visit_investigation->save();
                            $visit_id = $visit_investigation->id;
                            $path = 'storage/pdf/lab_reports/' .$visit_id. '_labereport.pdf';
                            $type=$value->type;
                            if($type='X-ray' || $type='x-ray')
                            {
                                    $pdf = PDF::loadView('admin.investigation.new_xrayreport',compact('visit_investigation','clinic'))->save($path);
                            }

                            if($type='Lab-Report' || $type='lab-report')
                            {
                                    $pdf = PDF::loadView('admin.investigation.investigationpdf',compact('visit_investigation','clinic'))->save($path);
                            }

                            Visit_Investigation::where('id',$visit_id)->update(array('pdf'=>$path));
                    }
            }


            $prescription_detail=request('prescription_detail');
            Visit_Prescription::where('emr_id',$emr_id)->delete();
            $prescription_array = json_decode($prescription_detail);
            $visit_prescription = new Visit_Prescription;
            $visit_prescription->emr_id= $emr_id?$emr_id:'';
            $visit_prescription->patient_id = request('patient_id') ? request('patient_id'): "";
            $visit_prescription->doctor_id = request('doctor_id') ?request('doctor_id'):"";
            $visit_prescription->save();
            $visit_prescriptionid = $visit_prescription->id;
            if($prescription_detail[0] !==null || $prescription_detail[0] !=='""')
            {
                foreach ($prescription_array as $key => $value) {

                        $visit_prescription = new Visit_Data_Prescription();
                        $visit_prescription->visit_prescription_id = isset($visit_prescriptionid)?$visit_prescriptionid:'';
                        $visit_prescription->medicine_id=$value->medicine_id;
                        $visit_prescription->medicine_name=$value->medicine_name;
                        $visit_prescription->dose=$value->dose;
                        $visit_prescription->unit=$value->unit;
                        $visit_prescription->duration=$value->duration;
                        $visit_prescription->route=$value->route;
                        $visit_prescription->frequency=$value->frequency ? $value->frequency : 0;
                        $visit_prescription->frequency2=$value->frequency2 ? $value->frequency2 : 0;
                        $visit_prescription->frequency3=$value->frequency3 ? $value->frequency3 : 0;
                        $visit_prescription->emr_id=$emr_id?$emr_id:'';
                        $visit_prescription->save();
                        $visit_id = $visit_prescription->id;
                         $visit_prescription_data = Visit_Data_Prescription::where('visit_prescription_id', $visit_prescriptionid)->get();
                        $path = 'storage/pdf/prescription/' .$visit_id. '_prescription.pdf';
                        $clinic=DoctorClinic::where('user_id',request('doctor_id'))->with('clinic')->first();
                        $doctor_name=User::where('id',request('doctor_id'))->first();
                        $patient_name=User::where('id',request('patient_id'))->first();
                        $visit_medicine=Visit_Prescription::where('patient_id', request('patient_id'))->with('medicine','doctor','clinic')->get();

                        $pdf = PDF::loadView('admin.patient.visit_pdf',compact('visit_prescription','visit_prescription_data','clinic','doctor_name','patient_name','visit_prescriptionid'))->save($path);
                        Visit_Prescription::where('id',$visit_id)->update(array('pdf'=>$path));
                }
            }

            if($investigation_detail[0] !==null && $prescription_detail[0] !==null || $investigation_detail[0] !==null || $prescription_detail[0] !==null )
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

                if($investigation_detail[0] !==null)
                {
                    /* $doctor_msg = array('message' => 'Hello '.$receiver_fname.' '.$receiver_lname.', Dr.'.$dr_fname.''.$dr_lname.' Sent you investigation', 'data' => $data); */
                    
                    $data = array(
                        'sender_id' => isset($doctor_name)?$doctor_name->id:'',
                        'receiver_id' => isset($receiver_name)?$receiver_name->id:'',
                        'notification_type' => 'investigation'
                    );
                
                    $pmsg = array(
                        'body' => 'Hello '.$receiver_fname.' '.$receiver_lname.', Dr.'.$dr_fname.''.$dr_lname.' Sent you investigation',
                        'title' => isset($doctor_name)?'Message From '.$doctor_name->first_name.' '.$doctor_name->last_name:'',
                        'icon' => 'myicon',
                        'sound' => 'mySound'
                    );

                    PushNotification::SendPushNotification($pmsg, $data, [$receiver_device_id]);

                }

                if($prescription_detail[0] !==null)
                {
                    /* $doctor_msg = array(
                        'message' => 'Hello '.$receiver_fname.' '.$receiver_lname.', Dr.'.$dr_fname.''.$dr_lname.' Sent you precription',
                        'data' => $data
                    );
 */
                    $data = array(
                        'sender_id' => isset($doctor_name)?$doctor_name->id:'',
                        'receiver_id' => isset($receiver_name)?$receiver_name->id:'',
                        'notification_type' => 'prescription'
                    );
                    
                    $pmsg = array(
                        'body' => 'Hello '.$receiver_fname.' '.$receiver_lname.', Dr.'.$dr_fname.''.$dr_lname.' Sent you prescription',
                        'title' => isset($doctor_name)?'Message From '.$doctor_name->first_name.' '.$doctor_name->last_name:'',
                        'icon' => 'myicon',
                        'sound' => 'mySound'
                    );

                    PushNotification::SendPushNotification($pmsg, $data, [$receiver_device_id]);
                }





                    $create_notification = new Notification;
                    $create_notification->from_id = request('doctor_id');
                    $create_notification->to_id = request('patient_id');

                    if($investigation_detail[0] !==null && $prescription_detail[0] !==null)
                    {
                        $create_notification->message = 'Hello '.$receiver_fname.' '.$receiver_lname.', Dr.'.$dr_fname.''.$dr_lname.' Sent you investigation & prescription';
                    }
                    elseif ($prescription_detail[0] !==null) {
                            $create_notification->message = 'Hello '.$receiver_fname.' '.$receiver_lname.', Dr.'.$dr_fname.''.$dr_lname.' Sent you prescription';
                    }
                    else
                    {
                        $create_notification->message = 'Hello '.$receiver_fname.' '.$receiver_lname.', Dr.'.$dr_fname.''.$dr_lname.' Sent you investigation';
                    }
                    $create_notification->save();
            }


            $referral_detail=request('referral_detail');
            Visit_Referral::where('emr_id',$emr_id)->delete();
            if($referral_detail[0] !==null || $referral_detail[0] !=='""')
            {
                $referral_array = json_decode($referral_detail);
                foreach ($referral_array as $key => $value) {
    
                            $visit_referral=new Visit_Referral();
                            $visit_referral->emr_id=isset($emr_id)?$emr_id:'';
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
            

             return response()->json(['success' => true ], 200);


    }

    public function deleteEmrDetails(Request $request)
    {
        $id=request('id');

        $type=request('type');

        if($type=='investigation')
        {
            $visit_investigation=Visit_Investigation::where('id',$id)->delete();

            return response()->json(['success' => true ], 200);
        }

        if($type=='referral')
        {

            $visit_referral=Visit_Referral::where('id',$id)->delete();

            return response()->json(['success' => true ], 200);
        }

        if($type=='prescription')
        {

            $visit_prescription=Visit_Prescription::where('id',$id)->delete();

            return response()->json(['success' => true ], 200);
        }


    }


    public function sendTextMessageNorification(Request $request)
    {
        $sender_id  = request('sender_id');

        $receiver_id= request('receiver_id');

        $message=request('message');

        $sender_name = User::whereId($sender_id)->first();

        $receiver_name = User::whereId($receiver_id)->first();

        $receiver_device_id = isset($receiver_name)?$receiver_name->device_id:'';

        $data = array(
                'sender_id' => $sender_name->id,
                'receiver_id' => isset($receiver_name)?$receiver_name->id:'',
                'notification_type' => 'message',
                'profile_pic'=>env('STORAGE_FILE_PATH').$sender_name->profile_pic
        );

        /* $doctor_msg = array('message' => 'Hello '.$sender_name->first_name.' '.$sender_name->last_name.' Send Message', 'data' => $data); */

        $pmsg = array(
                'body' => $message,
                //'title' => 'Message From '.$sender_name->first_name.' '.$sender_name->last_name,
                'title' => 'Message From '.$sender_name->first_name.' '.$sender_name->last_name,
                'icon' => 'myicon',
                'sound' => 'mySound'
        );

        $pp =  PushNotification::SendPushNotification($pmsg, $data, [$receiver_device_id]);

        $create_notification = new Notification;
        $create_notification->from_id = $sender_id;
        $create_notification->to_id = $receiver_id;
        $create_notification->message = $message;
        $create_notification->type = 'chat';
        $create_notification->save();
        // dd($pp);
        return response()->json(['data' => $data,'success' => true ], 200);

    }

    public function patientList(Request $request)
    {

        // dd("Asd");
        $doctor_id = request('doctor_id');

        if($doctor_id)
        {
            $patient = array();
            // $patients=DoctorBooking::where('doctor_id',$doctor_id)->get();

            // foreach ($patients as $value) {

            //     $patient[]=$value->patient_id;
            // }
            $emrDetails=EmrDetails::where('doctor_id',$doctor_id)->get();
            foreach ($emrDetails as $value) {
                $patient[]=$value->patient_id;
            }
            // $patients = User::with('roles')->whereHas('roles', function ($q) {
            //             $q->where('id', 2);
            //         })->get();
            // dd($patients->id);
            $patients = User::whereIn('id', $patient)->get();

        }
        else
        {
            $patients = User::with('roles')->whereHas('roles', function ($q) {
                        $q->where('id', 3);
                    })->get();
        }
        return response()->json(['patients' => $patients,'success' => true ], 200);
    }

     public function prescriptionList(Request $request)
    {

        $Prescription=Prescription::with('prescriptionmedicines')->get();

        return response()->json(['prescription' => $Prescription,'success' => true ], 200);
    }

    public function getemr_details(Request $request)
    {
        $id=request('id');

        $doctor_id=request('doctor_id');

        // $emrDetails=EmrDetails::where('type_visit','=','First Visit')->where('patient_id',$id)->orderBy('id', 'desc')->with('investigation','prescription','refrerral')->take('1')->get();

        // if(!$emrDetails->isEmpty())
        // {

        //     $emrDetails1=EmrDetails::where('type_visit','=','Successive Visit')->where('patient_id',$id)->orderBy('id', 'desc')->get();

        //     if(!$emrDetails1->isEmpty())
        //     {
        //         $emrDetails = array_merge( $emrDetails->toArray(), $emrDetails1->toArray());

        //     }

        // }


        $emrDetails=EmrDetails::where('doctor_id',$doctor_id)->where('patient_id',$id)->orderBy('id', 'desc')->with('investigation','prescription','refrerral','doctorbooking')->get();

        // foreach($emrDetails as $a){
        //     $a->doctorbooking = $a->doctorbooking ? $a->doctorbooking : "";
        // }

        return response()->json(['emrDetails' => $emrDetails,'success' => true ], 200);

    }

    public function waitingList(Request $request,$doctor_id)
    {
        $doctor_id=request('doctor_id');

        $patients=DoctorBookingForm::select('id','patient_id','doctor_id')->where('doctor_id',$doctor_id)->where('from_where',2)->with(array('patient'=>function($query){
                    $query->select('id','first_name','last_name','emr_number','quickblox_id');
        }))->get('doctor_id','patient_id');

        return response()->json(['patients' => $patients,'success' => true ], 200);
    }

    public function checktimeSlot(Request $request)
    {
        $doctor_id= request('doctor_id');

        $date = date('Y-m-d',strtotime(request('date')));

        $time = request('time');

        $check_doctor_booking = DoctorBooking::where('doctor_id',request('doctor_id'))->where('date',$date)->where('time',request('time'))->count();

        if($check_doctor_booking > 3)
        {
            return response()->json(['success' => false], 200);
        }
        else
        {
            return response()->json(['success' => true], 200);
        }
    }

    public function getLabReport(Request $request)
    {
        $id= request('id');

        $type=request('type');

        if($type=='1')
        {
            $labreport=Visit_Investigation::where('doctor_id',$id)->with('patient','doctor','investigation','uploadBy')->orderBy('id', 'desc')->get();
        }

        if($type=='0')
        {
            $labreport=Visit_Investigation::where('patient_id',$id)->with('doctor','patient','investigation','uploadBy')->orderBy('id', 'desc')->get();
        }

        return response()->json(['labreport' => $labreport,'success' => true ], 200);
    }

   



    public function uploadlabResults(Request $request)
    {
        $id = request('investigation_id');

        $result= request('result');

        $uploadedby=request('uploadedby');

        if($result)
        {

                $report_file = request('result');

                $report_file_input = [];

                foreach ($report_file as $key => $r) {
                    $img = $r;
                    $custom_file_name = 'report-'.$key.time().'.'.$img->getClientOriginalExtension();
                    $labreport = $img->storeAs('lab_report', $custom_file_name);
                    $report_file_input[] = $labreport;
                }

                $report_file_data = implode(' | ', $report_file_input);
        }


        $labreport=Visit_Investigation::where('id',$id)->update([
                'result'=>$report_file_data,
                'uploaded_by'=>$uploadedby,
                'status'=> 1
        ]);


        $labreport=Visit_Investigation::where('id',$id)->get();


        return response()->json(['labreport' => $labreport,'success' => true ], 200);

    }

    public function prescriptionListById(Request $request)
    {
        $id= request('id');

        $type=request('type');

        if($type=='1')
        {
            $prescription=Visit_Prescription::where('doctor_id',$id)->with('doctor','patient')->get();
        }

        if($type=='0')
        {
            $prescription=Visit_Prescription::where('patient_id',$id)->with('patient','doctor')->get();
        }

        return response()->json(['prescription' => $prescription,'success' => true ], 200);
    }

    public function pdfInvestigation(Request $request)
    {
        $patient_id= request('patient_id');

        $patient = User::whereId($patient_id)->first();

        $Visit_Investigation=Visit_Investigation::where('patient_id',$patient_id)->with('patient','doctor')->get();

        foreach ($Visit_Investigation as $value) {

            $id=$value->id;

            $emr_id=$value->emr_id;

            $path = 'storage/pdf/orders/' .$id. '_labereport.pdf';

            $area = $value->result;

            foreach (explode('|',$area) as $image) {

                $images[]=$image;
            }

            $newpath[]=$path;

            $ids[]=$id;

            $data=EmrDetails::where('id',$emr_id)->get();

            if($data->isNotEmpty())
            {
                $investigation=Visit_Investigation::where('id',$id)->with('patient','doctor')->get();

                $pdf = PDF::loadView('admin.investigation.investigationpdf',compact('investigation','patient','images'))->save($path);

            }
        }


        if(isset($ids) && isset($newpath))
        {
            $array3=array_combine($ids, $newpath);

            foreach ($array3 as $key => $value) {

                    Visit_Investigation::where('id',$key)->update(array('pdf'=>$value));
            }
        }

        $reports = Visit_Investigation::where('patient_id',$patient_id)->get();

        return response()->json(['reports' => $reports,'success' => true ], 200);
    }

    public function gelabreportByid(Request $request)
    {

        $document_type_id=request('document_type_id');

        $investigation=Investigation::where('type_id',$document_type_id)->pluck('id')->toArray();

        $type=request('type');

        $id=request('id');

        if($type==1)
        {
            $labreport=Visit_Investigation::whereIn('investigation_id',$investigation)->where('doctor_id',$id)->with('patient','doctor')->orderBy('id', 'desc')->get();
        }

        if($type==0)
        {
            $labreport=Visit_Investigation::whereIn('investigation_id',$investigation)->where('patient_id',$id)->with('patient','doctor')->orderBy('id', 'desc')->get();
        }

        return response()->json(['labreport' => $labreport,'success' => true ], 200);
    }

    public function getPatientWiseRefereal(Request $request)
    {
        $patient_id=request('patient_id');

        $patient=Visit_Referral::where('patient_id',$patient_id)->where('status',1)->get();

        return response()->json(['patient' => $patient,'success' => true ], 200);
    }

    public function getAllCount(Request $request)
    {
        $patient_id=request('patient_id');

        $date = date('Y-m-d');

        $time = date('g A');


        $labreport=Visit_Investigation::where('patient_id',$patient_id)->count();

        $prescription=Visit_Prescription::where('patient_id',$patient_id)->count();

        $patient_appointment = DoctorBooking::with(['doctor' => function($q){
            $q->select('id','first_name','last_name','mobile');
            $q->with(['clinic' => function($p){
                $p->with(['clinic']);
            }]);
        }])->where('date','>=',$date)->where('patient_id',$patient_id)->count();

        return response()->json(['labreport' => $labreport,'prescription'=>$prescription,'patient_appointment'=>$patient_appointment,'success' => true ], 200);
    }

    public function getLastVisitOfPatient(Request $request)
    {
        $patient_id=request('patient_id');

        $lastvisit = EmrDetails::where('patient_id',$patient_id)->orderBy('id', 'desc')->first();

        return response()->json(['lastvisit' => isset($lastvisit)?$lastvisit: (object) array(),'success' => true ], 200);
    }

    public function changedoctorStatus(Request $request)
    {
        $id=request('id');

        $type=request('type');

        $status=request('status');

        if($type==0)
        {
            // avoilable doctor status 
            $da=DoctorAvailability::where('patient_id',$id)->update(['status'=>$status]);

            return response()->json(['success' => true ], 200);
        }

        if($type==1)
        {
            //unavoilable  doctor status 
            $da=DoctorAvailability::where('doctor_id',$id)->update(['status'=>$status]);

            return response()->json(['success' => true ], 200);
        }

        if($type==2)
        {
            //waiting  doctor status 
            $da=DoctorAvailability::where('doctor_id',$id)->update(['status'=>$status]);

            return response()->json(['success' => true ], 200);
        }
    }

    public function getdoctoravailabilitystatus(Request $request)
    {

        $id=request('id');

        $type=request('type');

        if($type==0)
        {
            $da=DoctorAvailability::where('patient_id',$id)->get();

            return response()->json(['users_available'=>$da,'success' => true ], 200);
        }

        if($type==1)
        {
            $da=DoctorAvailability::where('doctor_id',$id)->get();

            return response()->json(['users_available'=>$da,'success' => true ], 200);
        }

    }

    public function insurancecompanylist(Request $request)
    {
        $insurancecompany=Insurancecompany::where('status',1)->get();

        return response()->json(['insurancecompany' => $insurancecompany], 200);
    }


    public function changeddoctorstatus(Request $request)
    {


        $userrole = auth()->user()->roles;
        $type = request('status');

        if($userrole['0']->name == "doctor")
        {

            $doctoravailability =  DoctorAvailability::where('doctor_id',auth()->user()->id)->update([
                'status'=> $type
            ]);
            $doctoravailability_status = DoctorAvailability::where('doctor_id',auth()->user()->id)->get();
            // dd(auth()->user()->id);
            return response()->json(['data'=>$doctoravailability_status], 200);
        }

        if($userrole['0']->name == "patient")
        {
            $doctoravailability = DoctorAvailability::where('patient_id',auth()->user()->id)->update([
                'status'=> $type
            ]);
            $doctoravailability_status = DoctorAvailability::where('patient_id',auth()->user()->id)->get();
            return response()->json(['data'=>$doctoravailability_status], 200);
        }
    }


    public function pushtesting(){
        $user = auth()->user();


        $doctor_device_id = $user->device_id;
        // $doctor_device_id = 'fOZMofC_yb8:APA91bGo35PtfPPjy-Qjm_tjoMiC9jiEbTc4xE-uyO8tv3xQfkQbahO43gjpXyBgG9KuvNWlt3aooS9mgvmSk77vLFAty1ehLckHB10WBjg9t9JgpgsNdTYGRCyphZXudB8O8tzL50a4';

        $doctor_device_id = 'fLdTCO7o73M:APA91bFl7pBPRrJyAqeAkmBMi6qmJex5vGB_YP4BFGKAYkiZiO01VbBzSHin-t5rCw9y9R0L7WiceKreIoXb9R3CzNPPiGGfKze9dqNnwexckQ2Yp0klb7TCtIYGgXyG73XDR1Uqrlt1';

        $pmsg = array(
                'body' => 'test data',
                'title' => 'Message From mm llast',
                'icon' => 'myicon',
                'sound' => 'mySound'
        );
        $data = array(
                'sender_id' => 96,
                'receiver_id' => 348,
                'notification_type' => 'other'
        );
        // dd($doctor_device_id);
        $p = PushNotification::SendPushNotification($pmsg, $data, [$doctor_device_id]);
         dd($p);
    }


    public function sendcallnotificationrequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
          'user_id'=>'required',
          'receiver_id'=>'required',
        ]);

        $patient_id = auth()->user()->id;
        if($patient_id == request('user_id')){
            //Send user notification
            $patient = User::whereId(request('user_id'))->first();
            if($patient){
                $doctor_device_id = $patient->device_id;
                $room_id = 'eclinic_'.rand(100000,999999);
                $data = array(
                    'patient_id' => $patient_id,
                    'doctor_id' => request('receiver_id'),
                    'call_room_number' => $room_id,
                    'notification_type' => 'video_call_request',
                    'call_type' => 'video',
                    'booking_id'=> 0
                );
                $pmsg = array(
                    'body' => 'Please accepted video call request',
                    'title' => 'Incoming Video call',
                    'icon' => 'myicon',
                    'sound' => 'mySound'
                );
                PushNotification::SendPushNotification($pmsg, $data, [$doctor_device_id]);
            }
        }else{
            //Send Receiver notification
            $doctor = User::whereId(request('receiver_id'))->first();
            if($doctor){
                $doctor_device_id = $doctor->device_id;
                $room_id = 'eclinic_'.rand(100000,999999);
                $data = array(
                    'patient_id' => request('receiver_id'),
                    'doctor_id' => $patient_id,
                    'call_room_number' => $room_id,
                    'notification_type' => 'video_call_request',
                    'call_type' => 'video',
                    'booking_id'=> 0
                );
                $pmsg = array(
                    'body' => 'Please accepted video call request',
                    'title' => 'Incoming Video call',
                    'icon' => 'myicon',
                    'sound' => 'mySound'
                );
                PushNotification::SendPushNotification($pmsg, $data, [$doctor_device_id]);
            }
        }
        return response()->json(['data' => 'Please accepted video call request','success' => true ], 200);

    }

    public function getdocumentvideocall(Request $request)
    {
        $validator = Validator::make($request->all(), [
          'user_id'=>'required',
          'receiver_id'=>'required',
        ]);

        //$getdocumentbyid = VideoCallDocumentDetail::select('id','document','created_at','updated_at')->where('from_id',request('user_id'))->where('to_id',request('receiver_id'))->orwhere('to_id',request('user_id'))->orwhere('from_id',request('receiver_id'))->limit(1)->orderBy('id','DESC')->get();
        
        $getdocumentbyid = VideoCallDocumentDetail::select('id','document','created_at','updated_at')->where('from_id',request('user_id'))->where('to_id',request('receiver_id'))->orwhere('to_id',request('user_id'))->orwhere('from_id',request('receiver_id'))->orderBy('id','DESC')->get();
        return response()->json(['data' => $getdocumentbyid,'success' => true ], 200);

    }

    public function uploaddocumentvideocall(Request $request)
    {
        $validator = Validator::make($request->all(), [
          'user_id'=>'required',
          'receiver_id'=>'required',
          'document'=>'required',
          // 'call_id'=>'required',
        ]);
        // $document = '';
        if(request('document'))
        {
            $img = request('document');
            $custom_file_name = 'doc-'.time().'.'.$img->getClientOriginalExtension();
            $document = $img->storeAs('storage/videodocument', $custom_file_name);
        }
        $videocalldocumentdetail = new VideoCallDocumentDetail;
        $videocalldocumentdetail->to_id = request('user_id');
        $videocalldocumentdetail->from_id = request('receiver_id');
        // $videocalldocumentdetail->call_id = request('call_id');
        $videocalldocumentdetail->document = $document;
        $videocalldocumentdetail->save();
        $getdocumentbyid = VideoCallDocumentDetail::select('id','document','created_at','updated_at')->find($videocalldocumentdetail->id);
        //start send  notification to user or dr document upload
        $this->senddocumentnotificationrequest(request('user_id'),request('receiver_id'));
        return response()->json(['data' => $getdocumentbyid,'success' => true ], 200);
    }


    public function senddocumentnotificationrequest($user_id,$receiver_id)
    {
        
        $patient_id = auth()->user()->id;
        if($patient_id == $user_id){
            //Send user notification
            $patient = User::whereId($receiver_id)->first();
            if($patient){
                $doctor_device_id = $patient->device_id;
                $room_id = 'eclinic_'.rand(100000,999999);
                $data = array(
                    'patient_id' => $patient_id,
                    'doctor_id' => $receiver_id,
                    'call_room_number' => $room_id,
                    'notification_type' => 'document',
                    'call_type' => 'video',
                    'booking_id'=> 0
                );
                $pmsg = array(
                    'body' => 'Patient Send document.',
                    'title' => 'Upload document',
                    'icon' => 'myicon',
                    'sound' => 'mySound'
                );
                PushNotification::SendPushNotification($pmsg, $data, [$doctor_device_id]);
            }
        }else{
            //Send Receiver notification
            $doctor = User::whereId($receiver_id)->first();
            if($doctor){
                $doctor_device_id = $doctor->device_id;
                $room_id = 'eclinic_'.rand(100000,999999);
                $data = array(
                    'patient_id' => $receiver_id,
                    'doctor_id' => $patient_id,
                    'call_room_number' => $room_id,
                    'notification_type' => 'video_call_request',
                    'call_type' => 'video',
                    'booking_id'=> 0
                );
                $pmsg = array(
                    'body' => 'Patient Send document.',
                    'title' => 'Upload document',
                    'icon' => 'myicon',
                    'sound' => 'mySound'
                );
                PushNotification::SendPushNotification($pmsg, $data, [$doctor_device_id]);
            }
        }

    }



    public function create_pdf_bill(Request $request){
        // dd($callhistoryid);
        $userid = auth()->user()->id;
        $user = auth()->user();
        // dd("asds");
        $callhistoryid = request('callhistoryid');
        $path = 'storage/pdf/bill/' .$userid. '_bill.pdf';
        $pdfpath = env('APP_URL').'storage/pdf/bill/' .$userid. '_bill.pdf';
        // dd($user->first_name);
        $callhistoryadd = Chathistory::select('call_history.*','users.first_name','users.ar_first_name','users.last_name','users.mobile','users.profile_pic','users.gender','users.fees')->join('users', 'call_history.doctor_id', '=', 'users.id')->where('call_history.id',$callhistoryid)->orderBy('call_history.id', 'DESC')->first();
            // dd($callhistoryadd);
        if($callhistoryadd){
            $calltime = $callhistoryadd->total_call_time;
            $calltime = '02:50:00';
            $time = date('i', strtotime($calltime));
            $hours = date('H', strtotime($calltime));
            $convertminutes = '00';
            if($hours >= 1){
                $convertminutes = $hours * 60;
            }
            $converthoursminutes = $convertminutes + $time;
            $callcount = ceil($converthoursminutes/15);
            $callhistoryadd->numberofcall = $callcount;
        }
        
        PDF::loadView('admin.callbill.userbill',compact('user','callhistoryadd'))->save($path);
        exit;
        // dd($pdf)
        try {
                // Mail::send('emailtemplate.sendbill', ['user' => $user], function ($m) use ($user,$pdfpath) {
                //     $m->from('purvesh151@gmail.com', 'Your Application');
                //     $m->to('purvesh.innovius@gmail.com', 'purvesh')->subject('Your Bill!');
                //     $m->attach($pdfpath);
                // });  
        } catch (Exception $e) {
            
        }
        
    }
    
    public function addpayment(Request $request)
    {
        $call_type=request('call_type');

        $user_id = auth()->user()->id;

        $doctorid=request('doctor_id');
        

        if($call_type=='regular')
        {
            $doctors=User::where('id',$user_id)->first();

            $fees=isset($doctors)?$doctors->fees:'';//Doctor Fees 

            $commission_final=isset($doctors)?$doctors->commision:'';//Doctor Commission 

            $discount=isset($doctors)?$doctors->discount:'';//Doctor Discount 

            //Discount Price
            $vats=Vat::first();
            $patient_wallet=User::where('id',$doctorid)->first();
            $countrycode=isset($patient_wallet)?$patient_wallet->countrycode:'';
            
            $vat=isset($vats)?$vats->vat:'5';
            
            if($discount > 0)
            {
                $feesdiscount=$fees*$discount/100;   
                $discountprice=$fees-$feesdiscount;
                if($countrycode=='+966')
                {
                    $vat=$discountprice*$vat/100; //Vat Is Here 5%;
                    $total_fees=$vat+$discountprice;
                    $total_fees_with_vat=$total_fees;        
                }
                else
                {
                    $total_fees=$discountprice;
                    $total_fees_with_vat=$total_fees;
                }
                
            }
            else{
                
                if($countrycode=='+966')
                {
                    $vat=$fees*$vat/100; //Vat Is Here 5%;
                    $total_fees_with_vat=$vat+$fees;
                }
                else
                {
                    //$vat=$fees*$vat/100; //Vat Is Here 5%;
                    $total_fees_with_vat=$fees;    
                }
                
            }
            //Discount Price
            

            $doctor_commission=$total_fees_with_vat*$commission_final/100;

            //Patient Wallet Money

            $patient_wallet_money=isset($patient_wallet)?$patient_wallet->wallet_money:'';
            
            if($fees <= $patient_wallet_money)
            {   

                if($total_fees_with_vat >= $patient_wallet_money)
                {
                    $update_patient_wallet_money=$total_fees_with_vat-$patient_wallet_money;
                }
                else
                {
                    $update_patient_wallet_money=$patient_wallet_money-$total_fees_with_vat;//Update Wallet Money Patient
                }
                

                $patient_wallets=User::where('id',$doctorid)->update(['wallet_money'=>$update_patient_wallet_money]);//Update Patient Wallet

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

                        // $doctors=User::where('id',$doctorid)->update(['wallet_money'=>$fees]);
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

                        $update_clinic_money=$clinic_wallet_money+$restdr_money;

                        $clinic_wallets=Clinic::where('id',isset($clinic_wallet)?$clinic_wallet->clinic_id:'')->update(['wallet_money'=>$restdr_money]);//Update Patient 
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

                

                $payment_history = new Payment_history;
                $payment_history->user_id = request('doctor_id');      // user
                $payment_history->user_id2 = $user_id;  // doctor
                $payment_history->price = $total_fees_with_vat;
                $payment_history->message = "Pay fees of doctor SAR".$total_fees_with_vat;
                $payment_history->save();

                $doctorbill=new DoctorBill;
                $doctorbill->patient_id=request('doctor_id');
                $doctorbill->doctor_id=$user_id;
                $doctorbill->clinic_id=isset($clinic_wallet)?$clinic_wallet->clinic_id:'-';
                $doctorbill->doctor_fees=$fees;
                $doctorbill->discount_fees=isset($discountprice)?$discountprice:'-';
                $doctorbill->vat_fees=$total_fees_with_vat;
                $doctorbill->vat=$vat;
                $doctorbill->emr_id=request('emr_id');
                $doctorbill->bill_no=mt_rand(100000,999999);
                $doctorbill->Audio_video_type=request('Audio_video_type');
                $doctorbill->save();
                                    $doctorbillid = $doctorbill->id;

                                  //Report Bill
                    $path = 'storage/pdf/bill/' .$doctorbillid. '_bill.pdf';

                    $receiver_name = User::whereId(request('doctor_id'))->first();

                    $doctor_name = User::whereId($user_id)->first();

                    $receiver_device_id = isset($receiver_name)?$receiver_name->device_id:'';

                    $receiver_fname=isset($receiver_name)?$receiver_name->first_name:'';

                    $receiver_lname=isset($receiver_name)?$receiver_name->last_name:'';

                    $dr_fname=isset($doctor_name)?$doctor_name->first_name:'';

                    $dr_lname=isset($doctor_name)?$doctor_name->last_name:'';

                    $dr_code=isset($doctor_name)?$doctor_name->ask_id:'';

                    $emr=EmrDetails::where('id',request('emr_id'))->first();
                    
                    if($countrycode=='+966')
                    {
                        $pdf = PDF::loadView('admin.Bill.visitbill',compact('receiver_fname','receiver_lname','dr_fname','dr_lname','doctorbill','emr','dr_code'))->save($path);
                    }
                    else
                    {
                        $pdf = PDF::loadView('admin.Bill.withoutvat',compact('receiver_fname','receiver_lname','dr_fname','dr_lname','doctorbill','emr','dr_code'))->save($path);
                    }
                    
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

                return response()->json(['data'=>'succesfully payments'], 200);

            }
            else
            {
                return response()->json(['data'=>"Please add money to wallet."], 200);
            }
        }
        else
        {
            return response()->json(['data'=>'succesfully payments'], 200);
        }
    }

    public function getBill(Request $request)
    {
        $userid = auth()->user()->id;

        $rolearray = auth()->user()->roles()->first();

        if($rolearray->name == 'doctor'){
            if(request('language') == 'ar'){
                $DoctorSpeciality=DoctorBill::select('doctor_bill.*','emrdetails.type_visit','emrdetails.emr_no','emrdetails.physican_note','emrdetails.physican_note as description','emrdetails.physican_diagonis_id','emrdetails.call_type','doctor.ar_first_name as dr_firstname','doctor.last_name as dr_lastname','patient.ar_first_name as pt_firstname','patient.last_name as pt_lastname','patient.age as pt_age','patient.gender as pt_gender','doctor_bill.discount_fees as Fees','doctor_bill.vat as Vat','doctor_bill.vat_fees as Grandtotal')
                ->leftjoin('emrdetails', 'doctor_bill.emr_id', '=', 'emrdetails.id')
                ->leftjoin('users as patient', 'doctor_bill.patient_id', '=', 'patient.id')
                ->leftjoin('users as doctor', 'doctor_bill.doctor_id', '=', 'doctor.id')
                ->where('doctor_bill.doctor_id',$userid)
                ->orderBy('doctor_bill.id','desc')
                ->get();
            }
            else{
                $DoctorSpeciality=DoctorBill::select('doctor_bill.*','emrdetails.type_visit','emrdetails.emr_no','emrdetails.physican_note','emrdetails.physican_note as description','emrdetails.physican_diagonis_id','emrdetails.call_type','doctor.first_name as dr_firstname','doctor.last_name as dr_lastname','patient.first_name as pt_firstname','patient.last_name as pt_lastname','patient.age as pt_age','patient.gender as pt_gender','doctor_bill.discount_fees as Fees','doctor_bill.vat as Vat','doctor_bill.vat_fees as Grandtotal')
                ->leftjoin('emrdetails', 'doctor_bill.emr_id', '=', 'emrdetails.id')
                ->leftjoin('users as patient', 'doctor_bill.patient_id', '=', 'patient.id')
                ->leftjoin('users as doctor', 'doctor_bill.doctor_id', '=', 'doctor.id')
                ->where('doctor_bill.doctor_id',$userid)
                ->orderBy('doctor_bill.id','desc')
                ->get();
            }
            
        }else
        {
            if(request('language') == 'ar'){
                $DoctorSpeciality=DoctorBill::select('doctor_bill.*','emrdetails.type_visit','emrdetails.emr_no','emrdetails.physican_note as description','emrdetails.physican_note','emrdetails.call_type','emrdetails.physican_diagonis_id','doctor.ar_first_name as dr_firstname','doctor.last_name as dr_lastname','patient.ar_first_name as pt_firstname','patient.last_name as pt_lastname','patient.age as pt_age','patient.gender as pt_gender','doctor_bill.discount_fees as Fees','doctor_bill.vat as Vat','doctor_bill.vat_fees as Grandtotal')
                ->leftjoin('emrdetails', 'doctor_bill.emr_id', '=', 'emrdetails.id')
                ->leftjoin('users as patient', 'doctor_bill.patient_id', '=', 'patient.id')
                ->leftjoin('users as doctor', 'doctor_bill.doctor_id', '=', 'doctor.id')
                ->where('doctor_bill.patient_id',$userid)
                ->orderBy('doctor_bill.id','desc')
                ->get();
            }
            else{
                $DoctorSpeciality=DoctorBill::select('doctor_bill.*','emrdetails.type_visit','emrdetails.emr_no','emrdetails.call_type','emrdetails.physican_note as description','emrdetails.physican_note','emrdetails.physican_diagonis_id','doctor.first_name as dr_firstname','doctor.last_name as dr_lastname','patient.first_name as pt_firstname','patient.last_name as pt_lastname','patient.age as pt_age','patient.gender as pt_gender','doctor_bill.discount_fees as Fees','doctor_bill.vat as Vat','doctor_bill.vat_fees as Grandtotal')
                ->leftjoin('emrdetails', 'doctor_bill.emr_id', '=', 'emrdetails.id')
                ->leftjoin('users as patient', 'doctor_bill.patient_id', '=', 'patient.id')
                ->leftjoin('users as doctor', 'doctor_bill.doctor_id', '=', 'doctor.id')
                ->where('doctor_bill.patient_id',$userid)
                ->orderBy('doctor_bill.id','desc')
                ->get();
            }
            
        }

       

        //$DoctorBill=DoctorBill::where('doctor_id',$userid)->get();
        

        return response()->json(['data' => $DoctorSpeciality,'success' => true ], 200);
    }
    
    public function documentTypeList(Request $request)
    {
        $dt=DocumentType::get();
        return response()->json(['data' => $dt,'success' => true ], 200);
    }
    
    public function subdocumentTypeList(Request $request)
    {
        $documenttypeid=request('documenttypeid');
        $dt=Investigation::where('type_id',$documenttypeid)->get();
        return response()->json(['data' => $dt,'success' => true ], 200);
    }


}
