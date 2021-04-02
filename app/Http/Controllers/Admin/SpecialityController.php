<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Speciality;
use Auth;
use Config;
use Illuminate\Support\Facades\Crypt;

class SpecialityController extends Controller
{
    private $speciaity;
    public function __construct(Speciality $speciality)
    {
        $this->speciality = $speciality;
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

        $speciality_count = Speciality::count();
        return view('admin.speciality.index', compact('speciality_count'));
    }

    public function create()
    {
        // $current_user = Auth::user();
        // if ($current_user->can([Config::get('constants.modules.STATE')]) == false) {
        //     return abort(401);
        // }

        $page = '/admin/speciality';
        return view('admin.speciality.create', compact('page'));
    }

    /*
    *Store State data form data
    */
    public function store(Request $request)
    {
        // $current_user = Auth::user();
        // if ($current_user->can([Config::get('constants.modules.STATE')]) == false) {
        //     return abort(401);
        // }
        // dd($request->all());
        $this->validate($request, [
        'name' => 'required|unique:speciality|max:50',
        'ar_name' => 'required|unique:speciality|max:50',
        ],
        [
                    'name.required' => 'Please enter speciality name',
                    'name.max' => 'speciality name may not be greater than 50 characters',
                    'name.unique' => 'Sorry! speciality name already exists, please try again with new record', 
                    'ar_name.required' => 'Please enter speciality name arabic',
                    'ar_name.max' => 'speciality name arabic may not be greater than 50 characters',
                    'ar_name.unique' => 'Sorry! speciality name arabic already exists, please try again with new record',    
        ]);
        // $input = $request->all();
        // $input['created_at'] = date('Y-m-d h:i:s');
        if ($request->file('image')) {
            $image = $request->image;
            $path = $image->store('speciality');
        }else{
            $path = '';
        }
        $speciality = new Speciality();
        $speciality->name =  $request->name;
        $speciality->ar_name =  $request->ar_name;
        $speciality->image =  $path;
        $speciality->save();

        // $speciality = $this->speciality->createSpeciality($input);

        

        return redirect()->route('admin.speciality.index')
                      ->with(self::SUCCESS, 'Speciality added successfully.');
    }

    public function specialityarray(Request $request)
    {
        $response = [];
        $speciality = $this->speciality->getAll();

        $speciality = $speciality->toArray();
        foreach ($speciality as $speciality) {
            $sub = [];
            $id = $speciality['id'];

            $sub[] = $id;
            
            $sub[] = ($speciality['name']) ? ucfirst($speciality['name']) : "-";
            
            $speciality_id = Crypt::encryptString($id);

            if ($speciality['status'] == 1) {
                $verified_url = route('admin.speciality.changestatus', array($speciality_id , 0));
                $sub[] = '<a onclick="return confirm_alert(`' . $verified_url . '`,`Are you sure you want to inactive this speciality ?`)"  href="#"><span class="btn btn-success btn-sm" data-toggle="tooltip" title="click here to inactive">Active</span></a>' . ' ';
            } elseif ($speciality['status'] == 0) {
                $verified_url = route('admin.speciality.changestatus', array($speciality_id, 1));
                $sub[] = '<a onclick="return confirm_alert(`' . $verified_url . '`,`Are you sure you want to active this speciality ?`)"  href="#"><span class="btn btn-danger btn-sm" data-toggle="tooltip" title="click here to active">Inactive</span></a>' . ' ';
            }

            $delete_url = route('admin.speciality.delete', [$speciality_id]);

            $action = '<div class="btn-part"><a class="edit" href="' . route('admin.speciality.edit', $speciality_id) . '"><i class="fa fa-pencil-alt"></i></a>' . ' ';
            $action .= '<a class="delete" onclick="return confirm_alert(`' . $delete_url . '`,`Are you sure you want to delete this speciality ?`)"  href="#"><i class="fa fa-trash"></i>&nbsp;</a></div>';

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
        $speciality = $this->speciality->getById($id);
        $page = '/admin/speciality';
        return view('admin.speciality.create', compact('speciality','page'));
    }

    public function update(Request $request)
    {
        // $current_user = Auth::user();
        // if ($current_user->can([Config::get('constants.modules.STATE')]) == false) {
        //     return abort(401);
        // }
        // dd($request->all());
        // dd("Asdasd");
        $this->validate($request, [
            'name' => 'required|max:50|unique:speciality,name,'.$request->id,
            'ar_name' => 'required|max:50|unique:speciality,ar_name,'.$request->id,
        ],
        [
                    'name.required' => 'Please enter speciality name',
                    'name.max' => 'speciality name may not be greater than 50 characters',
                    'name.unique' => 'Sorry! speciality name already exists, please try again with new record', 
                    'ar_name.required' => 'Please enter speciality name arabic',
                    'ar_name.max' => 'speciality name arabic may not be greater than 50 characters',
                    'ar_name.unique' => 'Sorry! speciality name arabic already exists, please try again with new record', 
        ]);

        $check_speciality_name = Speciality::where('name', $request->name)->count();

        if ($check_speciality_name > 0) {
            $speciality_name = Speciality::where('name', $request->name)->first();
            if ($speciality_name->id != $request->id) {
                $errors = ['name' => 'The name has already been taken'];
                return redirect()->back()
                    ->withInput($request->all())
                    ->withErrors($errors);
            }
        }

        if (isset($request->image)) {
            $image = $request->image;
            $path = $image->store('speciality');
            $speciality = Speciality::find($request->id);
            $speciality->name = $request->name;
            $speciality->ar_name = $request->ar_name;
            $speciality->image = $path;
            $speciality->save();
        } else {
            $update_attributes = array(
            'name' => $request->name,
            'ar_name' => $request->ar_name,
            );
            $speciality = $this->speciality->updateById($request->id, $update_attributes);
        }
        

        return redirect()->route('admin.speciality.index')
                    ->with(self::SUCCESS, 'Speciality updated successfully.');
    }

    public function delete($id)
    {
        // $current_user = Auth::user();
        // if ($current_user->can([Config::get('constants.modules.STATE')]) == false) {
        //     return abort(401);
        // }

        $speciality_id = Crypt::decryptString($id);

        // if(Speciality::whereId($speciality_id)->count() > 0)
        // {
        //     return redirect()->route('admin.speciality.index')->with('errors', 'System can not remove this speciality as doctor is already associated with this.');    
        // }

        $speciality_delete = $this->speciality->deleteById($speciality_id);
        return redirect()->route('admin.speciality.index')->with('success', 'Speciality deleted successfully.');
    }

    public function changestatus($id, $status)
    {
        // $current_user = Auth::user();
        // if ($current_user->can([Config::get('constants.modules.STATE')]) == false) {
        //     return abort(401);
        // }

        $id = Crypt::decryptString($id);
        $speciality = $this->speciality->getById($id);

        $update_attributes = array('status' => $status);

        $state_update = $this->speciality->updateById($id, $update_attributes);
        if ($status == 1) {
            $msg = 'speciality is active successfully.';
        } elseif ($status == 0) {
            $msg = 'speciality is inactive successfully.';
        }

        return redirect()->route('admin.speciality.index')->with('success', ucfirst($speciality->name)." ".$msg);
    }

    
}
