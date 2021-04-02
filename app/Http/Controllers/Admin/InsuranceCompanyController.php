<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Insurancecompany;
use Auth;
use Config;
use Illuminate\Support\Facades\Crypt;

class InsuranceCompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $insurancecompany;

    public function __construct(Insurancecompany $insurancecompany)
    {
        $this->insurancecompany = $insurancecompany;
    }

    const SUCCESS = 'success';

    public function index()
    {
        //
        return view('admin.insurancecompany.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $page = '/admin/insurancecompany';
        return view('admin.insurancecompany.create', compact('page'));
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
        'name' => 'required|unique:insurancecompany',
        'ar_name' => 'required|unique:insurancecompany',
        ],
        [
                    'name.required' => 'Please enter insurance company name',
                    'name.unique' => 'Sorry! Insurance Company name Already Exists, please try again with new record',
                    'ar_name.required' => 'Please enter insurance company name arabic',
                    'ar_name.unique' => 'Sorry! Insurance Company name arabic Already Exists, please try again with new record',
        ]);
        $input = $request->all();
        $input['created_at'] = date('Y-m-d h:i:s');

        $clinic = $this->insurancecompany->createInsuranceName($input);

        return redirect()->route('admin.insurance.index')
                      ->with(self::SUCCESS, 'Insurancecompany added successfully.');
    }

    public function insurancearray(Request $request)
    {
        $response = [];
        $insurancecompany = $this->insurancecompany->getAll();

        $insurancecompany = $insurancecompany->toArray();

        foreach ($insurancecompany as $insurancecompany) {

            $sub = [];

            $id = $insurancecompany['id'];

            $sub[] = $id;
            
            $sub[] = ($insurancecompany['name']) ? ucfirst($insurancecompany['name']) : "-";
            
            $clinic_id = Crypt::encryptString($id);

            if ($insurancecompany['status'] == 1) {
                $verified_url = route('admin.insurance.changestatus', array($clinic_id , 0));
                $sub[] = '<a onclick="return confirm_alert(`' . $verified_url . '`,`Are you sure you want to inactive this insurancecompany ?`)"  href="#"><span class="btn btn-success btn-sm" data-toggle="tooltip" title="click here to inactive">Active</span></a>' . ' ';
            } elseif ($insurancecompany['status'] == 0) {
                $verified_url = route('admin.insurance.changestatus', array($clinic_id, 1));
                $sub[] = '<a onclick="return confirm_alert(`' . $verified_url . '`,`Are you sure you want to active this insurancecompany ?`)"  href="#"><span class="btn btn-danger btn-sm" data-toggle="tooltip" title="click here to active">Inactive</span></a>' . ' ';
            }

            $delete_url = route('admin.insurance.delete', [$clinic_id]);

            $action = '<div class="btn-part"><a class="edit" href="' . route('admin.insurance.edit', $clinic_id) . '"><i class="fa fa-pencil-alt"></i></a>' . ' ';
            $action .= '<a class="delete" onclick="return confirm_alert(`' . $delete_url . '`,`Are you sure you want to delete this insurancecompany ?`)"  href="#"><i class="fa fa-trash"></i>&nbsp;</a></div>';

            $sub[] = $action;
            $sub[] = $response[] = $sub;

        }
        $userjson = json_encode(["data" => $response]);
        echo $userjson;
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
    public function edit($id)
    {
        //
        $id = Crypt::decryptString($id);
        $insurance = $this->insurancecompany->getById($id);
        $page = '/admin/insurance';
        return view('admin.insurancecompany.create', compact('insurance','page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
         $this->validate($request, [
        'name' => 'required|unique:insurancecompany,name,'.$request->id,
        'ar_name' => 'required|unique:insurancecompany,ar_name,'.$request->id,
        ],
        [
                    'name.required' => 'Please enter insurance company',
                    'name.unique' => 'Sorry! Insurance Company name Already Exists, please try again with new record',
                    'ar_name.required' => 'Please enter insurance company arabic',
                    'ar_name.unique' => 'Sorry! Insurance Company name arabic Already Exists, please try again with new record',
        ]);

        $check_Insurancecompany = Insurancecompany::where('name', $request->name)->count();

        if ($check_Insurancecompany > 0) {
            $Insurancecompany = Insurancecompany::where('name', $request->name)->first();
            if ($Insurancecompany->id != $request->id) {
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

        $insurancecompany = $this->insurancecompany->updateById($request->id, $update_attributes);

        return redirect()->route('admin.insurance.index')
                    ->with(self::SUCCESS, 'Insurancecompany updated successfully.');
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
        $insurancecompany = Crypt::decryptString($id);

        $insurancecompany_delete = $this->insurancecompany->deleteById($insurancecompany);
        return redirect()->route('admin.insurance.index')->with('success', 'Insurancecompany deleted successfully.');
    }

    public function changestatus($id, $status)
    {

        $id = Crypt::decryptString($id);

        $insurancecompany = $this->insurancecompany->getById($id);

        $update_attributes = array('status' => $status);

        $clinic_update = $this->insurancecompany->updateById($id, $update_attributes);
        if ($status == 1) {
            $msg = 'Insurancecompany is active successfully.';
        } elseif ($status == 0) {
            $msg = 'Insurancecompany is inactive successfully.';
        }

        return redirect()->route('admin.insurance.index')->with('success', ucfirst($insurancecompany->name)." ".$msg);
    }
}
