<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\MasterAdminSetting;
use App\CountryCodeIso;
use App\DoctorBill;
use App\Chathistory;
use App\Payment_history;
use App\User;
use App\EmrDetails;
use Auth;
use Config;
use Illuminate\Support\Facades\Crypt;

class MasterController extends Controller
{
   

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
        $MasterAdminSetting=MasterAdminSetting::first();
        if($MasterAdminSetting)
        {
            return view('admin.MasterAdminSetting.create',['MasterAdminSetting'=>$MasterAdminSetting]);
        }
        else{
            return view('admin.MasterAdminSetting.create');
        }
    }

    public function storeMasterAdminSetting(Request $request)
    {
        $vat = new MasterAdminSetting();
        $vat->mobile=request('mobile');
        $vat->ar_mobile=request('ar_mobile');
        $vat->email=request('email');
        $vat->ar_email=request('ar_email');
        $vat->description=request('description');
        $vat->ar_description=request('ar_description');
        $vat->price=request('price');
        $vat->save();

        return redirect()->route('admin.vat.index')
                      ->with(self::SUCCESS, 'MasterAdminSetting added successfully.');
    }

    public function updateMasterAdminSetting(Request $request)
    {
        $vat=MasterAdminSetting::find($request->id);

        $vat->mobile=request('mobile');
        $vat->ar_mobile=request('ar_mobile');
        $vat->email=request('email');
        $vat->ar_email=request('ar_email');
        $vat->description=request('description');
        $vat->ar_description=request('ar_description');
        $vat->price=request('price');

        $vat->save();

        return redirect()->route('admin.vat.index')
                    ->with(self::SUCCESS, 'MasterAdminSetting updated successfully.');

    }
    public function bill()
    {
        return view('admin.Bill.index');
    }

    public function billArray()
    {
        $DoctorSpeciality=DoctorBill::select('doctor_bill.*','emrdetails.type_visit','emrdetails.emr_no','emrdetails.physican_note','emrdetails.physican_note as description','emrdetails.physican_diagonis_id','emrdetails.call_type','doctor.first_name as dr_firstname','doctor.last_name as dr_lastname','patient.first_name as pt_firstname','patient.last_name as pt_lastname','patient.age as pt_age','patient.gender as pt_gender','doctor_bill.discount_fees as Fees','doctor_bill.vat as Vat','doctor_bill.vat_fees as Grandtotal')
                ->leftjoin('emrdetails', 'doctor_bill.emr_id', '=', 'emrdetails.id')
                ->leftjoin('users as patient', 'doctor_bill.patient_id', '=', 'patient.id')
                ->leftjoin('users as doctor', 'doctor_bill.doctor_id', '=', 'doctor.id')
                ->get();
$response = [];
        foreach ($DoctorSpeciality as $Ds) {

            $sub = [];

            $id = $Ds->id;

            $sub[] = $id;
            
            $sub[] = $Ds->dr_firstname.' '.$Ds->dr_lastname;

            $sub[] = $Ds->pt_firstname.' '.$Ds->pt_lastname;
            
            $sub[] = $Ds->Fees;

            $sub[] = $Ds->Vat;
            
            $sub[] = $Ds->Grandtotal;

            $sub[] = $response[] = $sub;

        }

        $userjson = json_encode(["data" => $response]);
        echo $userjson;
    }

    public function callLog(Request $request)
    {
        return view('admin.Call.index');   
    }

    public function callLogArray(Request $request)
    {
                $DoctorSpeciality=Chathistory::select('call_history.*','doctor.first_name as dr_firstname','doctor.last_name as dr_lastname','patient.first_name as pt_firstname','patient.last_name as pt_lastname')
                
                ->leftjoin('users as patient', 'call_history.userid', '=', 'patient.id')
                ->leftjoin('users as doctor', 'call_history.doctor_id', '=', 'doctor.id')
                ->get();
$response = [];
        foreach ($DoctorSpeciality as $Ds) {

            $sub = [];

            $id = $Ds->id;

            $sub[] = $id;
            
            $sub[] = $Ds->dr_firstname.' '.$Ds->dr_lastname;

            $sub[] = $Ds->pt_firstname.' '.$Ds->pt_lastname;
            
            $sub[] = $Ds->calltype;

            $sub[] = $Ds->total_call_time;
            
            $sub[] = $response[] = $sub;

        }

        $userjson = json_encode(["data" => $response]);
        echo $userjson;
    }

    public function followup(Request $request)
    {
        return view('admin.followup.index');   
    }

    public function followupArray(Request $request)
    {
        $EmrDetails=EmrDetails::select('emrdetails.*','doctor.first_name as dr_firstname','doctor.last_name as dr_lastname','patient.first_name as pt_firstname','patient.last_name as pt_lastname')            
            ->leftjoin('users as patient', 'emrdetails.patient_id', '=', 'patient.id')
            ->leftjoin('users as doctor', 'emrdetails.doctor_id', '=', 'doctor.id')
            ->where('emrdetails.call_type','=','followup')
            ->get();

        $response = [];

        foreach ($EmrDetails as $Ed) {

            $sub = [];

            $id = $Ed->id;

            $sub[] = $id;
            
            $sub[] = $Ed->dr_firstname.'-'.$Ed->dr_lastname;

            $sub[] = $Ed->pt_firstname.'-'.$Ed->pt_lastname;
            
            $sub[] = $Ed->followup_date;

            $sub[] = $Ed->call_type;
            
            $sub[] = $response[] = $sub;

        }

        $userjson = json_encode(["data" => $response]);
        echo $userjson;
    }

    public function payment(Request $request)
    {
        return view('admin.Payment.index');   
    }

    public function paymentArray(Request $request)
    {
                $payment=Payment_history::where('status',1)
                ->get();
        $response = [];
        foreach ($payment as $ps) {

            $sub = [];

            $id = $ps->id;

            $sub[] = $id;

            $pname=User::where('id',$ps->user_id)->first();
            
            $sub[] = $pname->first_name.' '.$pname->last_name;

            $sub[] = $ps->price;
            
            $sub[] = $ps->created_at->format('d-m-Y H:i:s');
            
            $sub[] = $response[] = $sub;

        }

        $userjson = json_encode(["data" => $response]);
        echo $userjson;
    }

    public function subinvestigationindex()
    {

    }

    public function addsubinvestigation()
    {

    }

    public function storesubinvestigation()
    {

    }

    public function editsubinvestigation()
    {

    }


    public function updatesubinvestigation()
    {

    }

    public function deletesubinvestigation()
    {

    }

    public function subinvestigationArray()
    {

    }

    
}
