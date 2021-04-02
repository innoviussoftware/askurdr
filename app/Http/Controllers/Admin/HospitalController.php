<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Clinic;
use Auth;
use Config;
use Illuminate\Support\Facades\Crypt;

class HospitalController extends Controller
{
    private $clinic;
    public function __construct(Clinic $clinic)
    {
        $this->clinic = $clinic;
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
        // dd("Asd");
        return view('admin.hospital.index');
    }

    public function create()
    {
        // $current_user = Auth::user();
        // if ($current_user->can([Config::get('constants.modules.STATE')]) == false) {
        //     return abort(401);
        // }

        $page = '/admin/hospital';
        return view('admin.hospital.create', compact('page'));
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
        'name' => 'required|unique:clinic',
        'ar_name' => 'required|unique:clinic',
        ],
        [
                    'name.required' => 'Please enter clinic name',
                    'name.unique' => 'Sorry! Clinic name Already Exists, please try again with new record',
                    'ar_name.required' => 'Please enter clinic name arabic',
                    'ar_name.unique' => 'Sorry! Clinic name arabic Already Exists, please try again with new record',
        ]);
        $input = $request->all();

        $input['created_at'] = date('Y-m-d h:i:s');

        $clinic = $this->clinic->createClinic($input);

        return redirect()->route('admin.hospital.index')
                      ->with(self::SUCCESS, 'Hospital added successfully.');
    }

    public function clinicarray(Request $request)
    {
        $response = [];
        $clinic = $this->clinic->getAll();

        $clinic = $clinic->toArray();
        foreach ($clinic as $clinic) {
            $sub = [];
            $id = $clinic['id'];

            $sub[] = $id;
            
            $sub[] = ($clinic['name']) ? ucfirst($clinic['name']) : "-";
            
            $clinic_id = Crypt::encryptString($id);

            if ($clinic['status'] == 1) {
                $verified_url = route('admin.hospital.changestatus', array($clinic_id , 0));
                $sub[] = '<a onclick="return confirm_alert(`' . $verified_url . '`,`Are you sure you want to inactive this clinic ?`)"  href="#"><span class="btn btn-success btn-sm" data-toggle="tooltip" title="click here to inactive">Active</span></a>' . ' ';
            } elseif ($clinic['status'] == 0) {
                $verified_url = route('admin.hospital.changestatus', array($clinic_id, 1));
                $sub[] = '<a onclick="return confirm_alert(`' . $verified_url . '`,`Are you sure you want to active this clinic ?`)"  href="#"><span class="btn btn-danger btn-sm" data-toggle="tooltip" title="click here to active">Inactive</span></a>' . ' ';
            }

            $delete_url = route('admin.hospital.delete', [$clinic_id]);

            $action = '<div class="btn-part"><a class="edit" href="' . route('admin.hospital.edit', $clinic_id) . '"><i class="fa fa-pencil-alt"></i></a>' . ' ';
            $action .= '<a class="delete" onclick="return confirm_alert(`' . $delete_url . '`,`Are you sure you want to delete this clinic ?`)"  href="#"><i class="fa fa-trash"></i>&nbsp;</a></div>';

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
        $clinic = $this->clinic->getById($id);
        $page = '/admin/clinic';
        return view('admin.hospital.create', compact('clinic','page'));
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
                    'name.required' => 'Please enter clinic name',
                    'name.unique' => 'Sorry! Clinic name Already Exists, please try again with new record',
                    'ar_name.required' => 'Please enter clinic name arabic',
                    'ar_name.unique' => 'Sorry! Clinic name arabic Already Exists, please try again with new record',
        ]);
        // dd($request->all());
        $check_clinic_name = Clinic::where('name', $request->name)->count();

        if ($check_clinic_name > 0) {
            $clinic_name = Clinic::where('name', $request->name)->first();
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

        $clinic = $this->clinic->updateById($request->id, $update_attributes);

        return redirect()->route('admin.hospital.index')
                    ->with(self::SUCCESS, 'Clinic updated successfully.');
    }

    public function delete($id)
    {
        // $current_user = Auth::user();
        // if ($current_user->can([Config::get('constants.modules.STATE')]) == false) {
        //     return abort(401);
        // }

        $clinic = Crypt::decryptString($id);

        $clinic_delete = $this->clinic->deleteById($clinic);
        return redirect()->route('admin.hospital.index')->with('success', 'Clinic deleted successfully.');
    }

    public function changestatus($id, $status)
    {
        // $current_user = Auth::user();
        // if ($current_user->can([Config::get('constants.modules.STATE')]) == false) {
        //     return abort(401);
        // }

        $id = Crypt::decryptString($id);
        $clinic = $this->clinic->getById($id);

        $update_attributes = array('status' => $status);

        $clinic_update = $this->clinic->updateById($id, $update_attributes);
        if ($status == 1) {
            $msg = 'hospital is active successfully.';
        } elseif ($status == 0) {
            $msg = 'hospital is inactive successfully.';
        }

        return redirect()->route('admin.hospital.index')->with('success', ucfirst($clinic->name)." ".$msg);
    }

    
}
