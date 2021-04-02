<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use App\DoctorBooking;
use App\Role;
use App\DocumentType;
use App\User;
use App\Speciality;
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
use App\Visit_Referral;
use App\DoctorSpeciality;
use App\DoctorEducation;
use App\DoctorExperience;
use App\DoctorDays;
use App\DoctorAvailability;
// use App\Chat;
use App\Chathistory;
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


class UserController extends Controller
{
  public function getUserEmr($phone){
    // $user = User::where('mobile',$phone)->first();
    $user = User::where('national_id',$phone)->first();
    $lastvisit = EmrDetails::where('patient_id',$user->id)->orderBy('id', 'desc')->first();
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
    return response()->json(['patient_id' => $user->id, 'type_visit' => $type_visit, 'emr_number' => $user->emr_number]);
  }


  public function getUserCalltyp($from,$to){
    // $user = User::where('mobile',$phone)->first();
    $patient_user = User::where('national_id',$from)->first();

    $doctor_user = User::where('national_id',$to)->first();
    
    $followupdate=EmrDetails::where('patient_id',$patient_user->id)->where('doctor_id',$doctor_user->id)->latest()->first();

            if($followupdate)
            {
                if($followupdate->call_type == 'regular')
                {
                    $call_type='Follow Up Visit';
                }
                if($followupdate->call_type == 'followup')
                {
                    $call_type='Regular Visit';
                }
            }
            else
            {
                $call_type='Regular Visit';
            }

    return $call_type;
  }

  public function getUserCalllog($from,$to,$duration,$type)
  {
        
        $patient_user = User::where('national_id',$from)->first();

        $doctor_user = User::where('national_id',$to)->first();

        $chats=new Chathistory();
        $chats->userid=$patient_user->id;
        $chats->doctor_id=$doctor_user->id;
        $chats->calltype=$type;
        $chats->total_call_time=$duration;
        $chats->save();

        return 1;
  }

  public function changedoctorStatus($user_id)
  {
        $type = 2;

        $user = User::where('national_id',$user_id)->first();

        // return $type;
        
        $dd=DoctorAvailability::where('doctor_id',$user->id)->update(['status'=>$type]);
        
        return $dd;  
  }
}
