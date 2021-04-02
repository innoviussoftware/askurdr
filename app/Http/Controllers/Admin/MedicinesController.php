<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Medicine;
use Auth;
use Config;
use Illuminate\Support\Facades\Crypt;

class MedicinesController extends Controller
{
    private $medicine;
    public function __construct(Medicine $medicine)
    {
        $this->medicine = $medicine;
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
        $medicine_count = Medicine::count();
        return view('admin.medicines.index', compact('medicine_count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $page = '/admin/medicines';
        return view('admin.medicines.create', compact('page'));
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
                'name' => 'required|unique:medicines',
                'dose'=> 'required',
                'units'=>'required',
                'route'=>'required',
                'frequency'=>'required',
                'duration'=>'required',
        ],
        [
            'name.required'=>'Enter the medicines name',
            'name.unique'=>'Sorry! Medicines name already exists, please try again with new record',
            'dose.required'=>'Enter the dosage',
            'unit.required'=>'Enter the unit',
            'route.required'=>'Enter the route',
            'frequency.required'=>'Enter the frequency',
            'duration.required'=>'Enter the duration',
        ]
    );
        $input = $request->all();
        $input['created_at'] = date('Y-m-d h:i:s');

        $medicines = $this->medicine->createMedicines($input);

        return redirect()->route('admin.medicines.index')
                      ->with(self::SUCCESS, 'Medicine added successfully.');
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

    public function specialityarray(Request $request)
    {
        $response = [];
        $medicine = $this->medicine->getAll();

        $medicine = $medicine->toArray();
        foreach ($medicine as $medicine) {
            $sub = [];
            $id = $medicine['id'];

            $sub[] = $id;
            
            $sub[] = ($medicine['name']) ? ucfirst($medicine['name']) : "-";
            
            $medicine_id = Crypt::encryptString($id);

            if ($medicine['status'] == 1) {
                $verified_url = route('admin.medicines.changestatus', array($medicine_id , 0));
                $sub[] = '<a onclick="return confirm_alert(`' . $verified_url . '`,`Are you sure you want to inactive this medicine ?`)"  href="#"><span class="btn btn-success btn-sm" data-toggle="tooltip" title="click here to inactive">Active</span></a>' . ' ';
            } elseif ($medicine['status'] == 0) {
                $verified_url = route('admin.medicines.changestatus', array($medicine_id, 1));
                $sub[] = '<a onclick="return confirm_alert(`' . $verified_url . '`,`Are you sure you want to active this medicine ?`)"  href="#"><span class="btn btn-danger btn-sm" data-toggle="tooltip" title="click here to active">Inactive</span></a>' . ' ';
            }

            $delete_url = route('admin.medicines.delete', [$medicine_id]);

            $action = '<div class="btn-part"><a class="edit" href="' . route('admin.medicines.edit', $medicine_id) . '"><i class="fa fa-pencil-alt"></i></a>' . ' ';
            $action .= '<a class="delete" onclick="return confirm_alert(`' . $delete_url . '`,`Are you sure you want to delete this medicine ?`)"  href="#"><i class="fa fa-trash"></i>&nbsp;</a></div>';

            $sub[] = $action;
            $sub[] = $response[] = $sub;
        }
        $userjson = json_encode(["data" => $response]);
        echo $userjson;
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
        $medicine = $this->medicine->getById($id);
        $page = '/admin/medicines';
        return view('admin.medicines.create', compact('medicine','page'));
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
                'name' => 'required|unique:medicines,name,'.$request->id,
                'dose'=> 'required',
                'units'=>'required',
                'route'=>'required',
                'frequency'=>'required',
                'duration'=>'required',
        ],
        [
            'name.required'=>'Enter the medicines name',
            'name.unique'=>'Sorry! Medicines name already exists, please try again with new record',
            'dose.required'=>'Enter the dosage',
            'units.required'=>'Enter the unit',
            'route.required'=>'Enter the route',
            'frequency1.required'=>'Enter the frequency',
            'duration.required'=>'Enter the duration',
        ]
    );

        $check_medicine_name = Medicine::where('name', $request->name)->count();

        if ($check_medicine_name > 0) {
            $medicine_name = Medicine::where('name', $request->name)->first();
            if ($medicine_name->id != $request->id) {
                $errors = ['name' => 'The name has already been taken'];
                return redirect()->back()
                    ->withInput($request->all())
                    ->withErrors($errors);
            }
        }

        $update_attributes = array(
            'name' => $request->name,
            'dose'=>$request->dose,
            'unit'=>$request->units,
            'route'=>$request->route,
            'frequency'=>$request->frequency,
            'frequency2'=>$request->frequency2,
            'frequency3'=>$request->frequency3,
            'duration'=>$request->duration,
        );
        
        $medicine = $this->medicine->updateById($request->id, $update_attributes);

        return redirect()->route('admin.medicines.index')
                    ->with(self::SUCCESS, 'Medicine updated successfully.');
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
        
        $medicines_id = Crypt::decryptString($id);

        $speciality_delete = $this->medicine->deleteById($medicines_id);

        return redirect()->route('admin.medicines.index')->with('success', 'Medicine deleted successfully.');
    }

    public function changestatus($id, $status)
    {
       
        $id = Crypt::decryptString($id);

        $medicine = $this->medicine->getById($id);

        $update_attributes = array('status' => $status);

        $state_update = $this->medicine->updateById($id, $update_attributes);

        if ($status == 1) {
            $msg = 'Medicine is active successfully.';
        } elseif ($status == 0) {
            $msg = 'Medicine is inactive successfully.';
        }

        return redirect()->route('admin.medicines.index')->with('success', ucfirst($medicine->name)." ".$msg);
    }
}
