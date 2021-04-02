<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Language;
use App\Chathistory;
use App\User;
use App\DoctorClinic;
use App\Clinic;
use App\ClinicWalletHistory;
use App\DoctorWallet;
use Auth;
use Config;
use Illuminate\Support\Facades\Crypt;
use App\Vat;

class LanguageController extends Controller
{
    //

    private $lang;
    public function __construct(Language $lang)
    {
        $this->lang = $lang;
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
        return view('admin.lang.index');
    }

    public function create()
    {
        // $current_user = Auth::user();
        // if ($current_user->can([Config::get('constants.modules.STATE')]) == false) {
        //     return abort(401);
        // }

        $page = '/admin/lang';
        return view('admin.lang.create', compact('page'));
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
        'name' => 'required|unique:language',
        'ar_name' => 'required|unique:language',
        ],
        [
                    'name.required' => 'Please enter language name',
                    'name.unique' => 'Sorry! Language name Already Exists, please try again with new record',
                    'ar_name.required' => 'Please enter language name arabic',
                    'ar_name.unique' => 'Sorry! Language name arabic Already Exists, please try again with new record',
        ]);
        $input = $request->all();

        $input['created_at'] = date('Y-m-d h:i:s');

        $clinic = $this->lang->createlanguage($input);

        return redirect()->route('admin.lang.index')
                      ->with(self::SUCCESS, 'Language added successfully.');
    }

    public function langarray(Request $request)
    {
        $response = [];
        $clinic = $this->lang->getAll();

        $clinic = $clinic->toArray();
        foreach ($clinic as $clinic) {
            $sub = [];
            $id = $clinic['id'];

            $sub[] = $id;
            
            $sub[] = ($clinic['name']) ? ucfirst($clinic['name']) : "-";
            
            $clinic_id = Crypt::encryptString($id);

            if ($clinic['status'] == 1) {
                $verified_url = route('admin.lang.changestatus', array($clinic_id , 0));
                $sub[] = '<a onclick="return confirm_alert(`' . $verified_url . '`,`Are you sure you want to inactive this language ?`)"  href="#"><span class="btn btn-success btn-sm" data-toggle="tooltip" title="click here to inactive">Active</span></a>' . ' ';
            } elseif ($clinic['status'] == 0) {
                $verified_url = route('admin.lang.changestatus', array($clinic_id, 1));
                $sub[] = '<a onclick="return confirm_alert(`' . $verified_url . '`,`Are you sure you want to active this language ?`)"  href="#"><span class="btn btn-danger btn-sm" data-toggle="tooltip" title="click here to active">Inactive</span></a>' . ' ';
            }

            $delete_url = route('admin.lang.delete', [$clinic_id]);

            $action = '<div class="btn-part"><a class="edit" href="' . route('admin.lang.edit', $clinic_id) . '"><i class="fa fa-pencil-alt"></i></a>' . ' ';
            $action .= '<a class="delete" onclick="return confirm_alert(`' . $delete_url . '`,`Are you sure you want to delete this language ?`)"  href="#"><i class="fa fa-trash"></i>&nbsp;</a></div>';

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
        $clinic = $this->lang->getById($id);
        $page = '/admin/clinic';
        return view('admin.lang.create', compact('clinic','page'));
    }

    public function update(Request $request)
    {
        // $current_user = Auth::user();
        // if ($current_user->can([Config::get('constants.modules.STATE')]) == false) {
        //     return abort(401);
        // }

        $this->validate($request, [
        'name' => 'required|unique:clinic,name,'.$request->id,
        'ar_name' => 'required|unique:clinic,name,'.$request->id,
        ],
        [
                    'name.required' => 'Please enter language name',
                    'name.unique' => 'Sorry! Language name Already Exists, please try again with new record',
                    'ar_name.required' => 'Please enter language name arabic',
                    'ar_name.unique' => 'Sorry! Language name arabic Already Exists, please try again with new record',
        ]);
        // dd($request->all());
        $check_clinic_name = Language::where('name', $request->name)->count();

        if ($check_clinic_name > 0) {
            $clinic_name = Language::where('name', $request->name)->first();
            if ($clinic_name->id != $request->id) {
                $errors = ['name' => 'The name has already been taken'];
                return redirect()->back()
                    ->withInput($request->all())
                    ->withErrors($errors);
            }
        }

        $update_attributes = array(
            'name' => $request->name,
            'ar_name' => $request->ar_name,
        );

        $clinic = $this->lang->updateById($request->id, $update_attributes);

        return redirect()->route('admin.lang.index')
                    ->with(self::SUCCESS, 'Language updated successfully.');
    }

    public function delete($id)
    {
        // $current_user = Auth::user();
        // if ($current_user->can([Config::get('constants.modules.STATE')]) == false) {
        //     return abort(401);
        // }

        $clinic = Crypt::decryptString($id);

        $clinic_delete = $this->lang->deleteById($clinic);
        return redirect()->route('admin.lang.index')->with('success', 'Language deleted successfully.');
    }

    public function changestatus($id, $status)
    {
        // $current_user = Auth::user();
        // if ($current_user->can([Config::get('constants.modules.STATE')]) == false) {
        //     return abort(401);
        // }

        $id = Crypt::decryptString($id);
        $clinic = $this->lang->getById($id);

        $update_attributes = array('status' => $status);

        $clinic_update = $this->lang->updateById($id, $update_attributes);
        if ($status == 1) {
            $msg = 'Language is active successfully.';
        } elseif ($status == 0) {
            $msg = 'Language is inactive successfully.';
        }

        return redirect()->route('admin.lang.index')->with('success', ucfirst($clinic->name)." ".$msg);
    }
    
     public function walletindex()
    {
          return view('admin.commissionwallet.index');
    }

    public function walltearray()
    {
        $response = [];

        $calls=Chathistory::all();

        foreach ($calls as $calls) {
            $sub = [];

            $id = $calls->id;

            $sub[] = $id;

            $patient_name=User::where('id',$calls->userid)->first();//Patient Name
            
            
            $sub[] = isset($patient_name)?ucfirst($patient_name->first_name).' '.$patient_name->last_name:'';

            $clinic_id=User::where('id',$calls->doctor_id)->first();

            $DoctorClinic=DoctorClinic::where('user_id',$calls->doctor_id)->first();

            $clinic_name=Clinic::where('id',$DoctorClinic->clinic_id)->first();

            $sub[] = ($clinic_id) ? ucfirst($clinic_id->first_name).' '.$clinic_id->last_name:'-';//Doctor Name

            $sub[] = ($clinic_name) ? ucfirst($clinic_name->name) : "-"; //Clinic Name

            $tax='';
             if(isset($clinic_name))
            {
                if($clinic_name->name =='Ask' || $clinic_name->name =='ask')
                {
                    $tax=''; 
                }
                else
                {
                    if($clinic_id)
                    {
                            $commission=$clinic_id->commision;
                            $fees=$clinic_id->fees;
                            if($fees!= null && $commission != null)
                            {
                                $tax=$fees*$commission/100; 
                            }
                    }
                    else
                    {
                            $tax=''; 
                    }   
                }
            }

            //$tax=$clinic_id->fees*$clinic_id->commision/100;    
            
            $sub[] = ($tax) ? ucfirst($tax) : "-"; //Commission

            $sub[] = ($clinic_name) ? ucfirst($clinic_name->wallet_money) : "-"; //Wallet Money
            
            $sub[] = ($calls) ? $calls->created_at : "-"; //Wallet Money            
            
            $sub[] = $response[] = $sub;
        }
        
        $userjson = json_encode(["data" => $response]);

        echo $userjson;
    }

    public function clinicwallethistory(Request $request)
    {
        return view('admin.clinicwallet.index');
    }

    public function clinicwalletearray()
    {
        $response = [];

        $calls=ClinicWalletHistory::where('clinic_id','!=','1')->get();

        foreach ($calls as $calls) {
            $sub = [];

            $id = $calls->id;

            $sub[] = $id;

            $clinic_id=isset($calls)?$calls->clinic_id:'';

            $clinic_name=Clinic::where('id',$clinic_id)->first();

            $sub[] = ($clinic_name) ? ucfirst($clinic_name->name):"-";//Doctor Name

            $doctorname=User::where('id',$calls->doctor_id)->first();

            $patientname=User::where('id',$calls->patient_id)->first();

            $sub[] = ($clinic_name) ? ucfirst($doctorname->first_name.' '.$doctorname->last_name):"-";

            $sub[] = ($clinic_name) ? $patientname->emr_number:"-";

            $sub[] = ($calls) ? ucfirst(round($calls->commission,2)) : "-"; //Clinic Name

            $sub[] = ($clinic_name) ? ucfirst(round($calls->amount,2)) : "-"; //Wallet Money

            $sub[] = ($clinic_name) ? $calls->created_at : "-"; //Wallet Money            
            
            $sub[] = $response[] = $sub;
        }
        
        $userjson = json_encode(["data" => $response]);

        echo $userjson;
    }

    public function askclinicwallethistory(Request $request)
    {
        return view('admin.clinicwallet.askindex');
    }

    public function askclinicwalletearray()
    {
        $response = [];

        $calls=ClinicWalletHistory::where('clinic_id','=','1')->get();

        foreach ($calls as $calls) {
            $sub = [];

            $id = $calls->id;

            $sub[] = $id;

            $clinic_id=isset($calls)?$calls->clinic_id:'';

            $clinic_name=Clinic::where('id',$clinic_id)->first();

            $sub[] = ($clinic_name) ? ucfirst($clinic_name->name):"-";//Doctor Name

            $doctorname=User::where('id',$calls->doctor_id)->first();
            $patientname=User::where('id',$calls->patient_id)->first();

            $sub[] = ($clinic_name) ? ucfirst($doctorname->first_name.' '.$doctorname->last_name):"-";

            $sub[] = ($clinic_name) ? $patientname->emr_number:"-";

            $sub[] = ($calls) ? ucfirst(round($calls->commission,2)) : "-"; //Clinic Name

            $sub[] = ($clinic_name) ? ucfirst(round($calls->amount,2)) : "-"; //Wallet Money
            
            $sub[] = ($clinic_name) ? $calls->created_at : "-"; //Wallet Money            

            $sub[] = $response[] = $sub;
        }
        
        $userjson = json_encode(["data" => $response]);

        echo $userjson;
    }

    public function doctorcommsion(Request $request)
    {
        return view('admin.doctorcommission.index');
    }

    public function doctorcommsionArray(Request $request)
    {
        $response = [];

        $calls=DoctorWallet::all();

        foreach ($calls as $calls) {
            $sub = [];

            $id = $calls->id;

            $sub[] = $id;

            $doctor_id=isset($calls)?$calls->doctor_id:'';

            $patient_id=isset($calls)?$calls->patient_id :'';

            $doctorname=User::where('id',$doctor_id)->first();

            $ptname=User::where('id',$patient_id)->first();

            $sub[] = ($doctorname) ? ucfirst($doctorname->first_name.' '.$doctorname->last_name):"-";//Doctor Name

            $sub[] = ($ptname) ? $ptname->emr_number:"-";//Doctor Name

            $dciic=DoctorClinic::where('user_id',$doctor_id)->first();

            $clinic_name=Clinic::where('id',$dciic->clinic_id)->first();

            $sub[] = ($clinic_name) ? ucfirst($clinic_name->name):"-";

            $sub[] = ($doctorname) ? ucfirst(round($calls->commission,2)) : "-"; //Clinic Name

            $sub[] = ($doctorname) ? ucfirst(round($calls->amount,2)) : "-"; //Wallet Money
            
            $sub[] = ($doctorname) ? $calls->created_at : "-"; //Wallet Money            

            $sub[] = $response[] = $sub;
        }
        
        $userjson = json_encode(["data" => $response]);

        echo $userjson;
    }

    public function vat(Request $request)
    {
       $Vat=Vat::first();

        if($Vat)
        {
            return view('admin.vat.create',['Vat'=>$Vat]);
        }
        else{
            return view('admin.vat.create');
        }
    }

    //  public function create()
    // {
    //     // $current_user = Auth::user();
    //     // if ($current_user->can([Config::get('constants.modules.STATE')]) == false) {
    //     //     return abort(401);
    //     // }

        
        
    // } 

    public function storevat(Request $request)
    {
        $vat = new Vat();
        $vat->vat=request('vatprice');
        $vat->save();

        return redirect()->route('admin.vat.index')
                      ->with(self::SUCCESS, 'Vat added successfully.');
    }

    public function updatevat(Request $request)
    {
        $vat=Vat::find($request->id);

        $vat->vat= request('vatprice');

        $vat->save();

        return redirect()->route('admin.vat.index')
                    ->with(self::SUCCESS, 'Vat updated successfully.');

    }

}
