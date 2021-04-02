<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Speciality;
use App\User;
use App\Visit_Referral;
use Auth;
use Config;
use Illuminate\Support\Facades\Crypt;

class ReferalController extends Controller
{
    private $referral;
    
    private $user;
    private $speciality;
    
    public function __construct(User $user,Speciality $speciality,Visit_Referral $visit_Referral)
    {
        
        $this->visit_Referral = $visit_Referral;
        $this->user = $user;
        $this->speciality = $speciality;
    }

    const SUCCESS = 'success';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index()
    {
        //

        return view('admin.referral.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $page = '/admin/doctor';
        $speciality = Speciality::where('status',1)->get();
        $doctors = User::with('roles')->whereHas('roles', function ($q) {
            $q->where('id', 2);
        })->get();  
        $patients = User::with('roles')->whereHas('roles', function ($q) {
            $q->where('id', 3);
        })->get();         
        
        return view('admin.referral.create', compact('page','speciality','doctors','patients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

         $this->validate($request, [
            'speciality' => 'required',
            'doctor_name' => 'required',
            'patient_name'=>'required',
            'diagonis' => 'required|max:150',            
            'reason_refreal' => 'required|max:150',
        ],
        [
                    'speciality.required' => 'Please select speciality',
                    'doctor_name.required' => 'Please select doctor name',
                    'diagonis.required' => 'Please enter diagnosis',
                    'reason_refreal.required' => 'Please enter reason of refreal',
                    'patient_name.required' => 'Please select patient name',
        ]);

        $referal = new Visit_Referral();
        $referal->speciality_id = $request->speciality;
        $referal->doctor_id = $request->doctor_name;
        $referal->diagnosis = $request->diagonis;
        $referal->reason = $request->reason_refreal;
        $referal->patient_id = $request->patient_name;
        $referal->save();

        return redirect()->route('admin.refreal.index')
                      ->with('success', "Referral Added Successfully.");
    }

    public function referalarray(Request $request)
    {
        $response = [];
        $referral = $this->visit_Referral->getAll();

        $referrals = $referral->toArray();

        foreach ($referrals as $referral) {

           
            $sub = [];
            $id = $referral['id'];

            $sub[] = $id;
            
            
            $sub[] = ($referral['doctor']['first_name']) ? ucfirst($referral['doctor']['first_name'].$referral['doctor']['last_name']) : "-";
            $sub[] = ($referral['patient']['first_name']) ? ucfirst($referral['patient']['first_name'].$referral['patient']['last_name']) : "-";
            $sub[] = ($referral['speciality']['name']) ? ucfirst($referral['speciality']['name']) : "-";
            $sub[] = ($referral['diagnosis']) ? substr(ucfirst($referral['diagnosis']),0,30) : "-";
            $sub[] = ($referral['reason']) ? substr(ucfirst($referral['reason']),0,30) : "-";
            
            $refreal_id = Crypt::encryptString($id);

            if ($referral['status'] == 1) {
                $verified_url = route('admin.refreal.changestatus', array($refreal_id , 0));
                $sub[] = '<a onclick="return confirm_alert(`' . $verified_url . '`,`Are you sure you want to not approve this referral ?`)"  href="#"><span class="btn btn-success btn-sm" data-toggle="tooltip" title="click here to inactive">Approve</span></a>' . ' ';
            } elseif ($referral['status'] == 0) {
                $verified_url = route('admin.refreal.changestatus', array($refreal_id, 1));
                $sub[] = '<a onclick="return confirm_alert(`' . $verified_url . '`,`Are you sure you want to approve this referral ?`)"  href="#"><span class="btn btn-danger btn-sm" data-toggle="tooltip" title="click here to active">Not Approve</span></a>' . ' ';
            }

            $delete_url = route('admin.refreal.delete', [$refreal_id]);

            $action = '<div class="btn-part"><a class="edit" href="' . route('admin.refreal.edit', $refreal_id) . '"><i class="fa fa-pencil-alt"></i></a>' . ' ';
            $action .= '<a class="delete" onclick="return confirm_alert(`' . $delete_url . '`,`Are you sure you want to delete this referral ?`)"  href="#"><i class="fa fa-trash"></i>&nbsp;</a></div>';

            $sub[] = $action;
            $sub[] = $response[] = $sub;
        }
        $userjson = json_encode(["data" => $response]);
        echo $userjson;
    }

     public function edit($id)
    {
        //
        $id = Crypt::decryptString($id);
        $speciality = Speciality::where('status',1)->get();
        $doctors = User::with('roles')->whereHas('roles', function ($q) {
            $q->where('id', 2);
        })->get();    
        $patients = User::with('roles')->whereHas('roles', function ($q) {
            $q->where('id', 3);
        })->get();      
        $referral = $this->visit_Referral->getById($id);
       
        return view('admin.referral.create', compact('referral','page','speciality','doctors','patients'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        
          $this->validate($request, [
            'speciality' => 'required',
            'doctor_name' => 'required',
            'diagonis' => 'required',            
            'reason_refreal' => 'required',
            'patient_name'=>'required',
        ],
        [
                    'speciality.required' => 'Please select speciality',
                    'doctor_name.required' => 'Please select doctor name',
                    'diagonis.required' => 'Please enter diagnosis',
                    'reason_refreal.required' => 'Please enter reason of refreal',
                    'patient_name.required' => 'Please select patient name',

        ]);

        $update_attributes = array(
            'speciality_id' => $request->speciality,
            'doctor_id' => $request->doctor_name,
            'diagnosis' => $request->diagonis,
            'reason' => $request->reason_refreal,
            'patient_id'=>$request->patient_name
        );

        $referral = $this->visit_Referral->updateById($request->id, $update_attributes);

        return redirect()->route('admin.refreal.index')
                    ->with(self::SUCCESS, 'Referral updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

      public function delete($id)
    {
        
        $referral_id = Crypt::decryptString($id);

        $referral_delete = $this->visit_Referral->deleteById($referral_id);

        return redirect()->route('admin.refreal.index')->with('success', 'Referral deleted successfully.');
    }

      public function changestatus($id, $status)
    {
       
        $id = Crypt::decryptString($id);

        $referral = $this->visit_Referral->getById($id);

        $update_attributes = array('status' => $status);

        $state_update = $this->visit_Referral->updateById($id, $update_attributes);

        if ($status == 1) {
            $msg = 'Referral is approved.';
        } elseif ($status == 0) {
            $msg = 'Referral is not approved.';
        }

        return redirect()->route('admin.refreal.index')->with('success', $msg);
    }
}
