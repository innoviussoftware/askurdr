<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Paymentplan;
use Hash;
use Illuminate\Support\Facades\Crypt;

class PlanController extends Controller
{

    private $paymentplan;

    public function __construct(Paymentplan $paymentplan)
    {
        $this->paymentplan = $paymentplan;
    }
    
    const SUCCESS = 'success';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.paymentplan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page = '/admin/plan';
        return view('admin.paymentplan.create',compact('page'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
                'type'=>'required',
                'ar_type'=>'required',
                'price'=>'required|numeric'
                             
            ],
            [
                //'months.required'=>'Enter the months',
                //'years.required'=>'Enter the years',
                'price.required'=>'Enter the price',
                //'months.numeric'=>'Enter the months must be number',
                //'years.numeric'=>'Enter the years must be number',
                'price.numeric'=>'Enter the price must be number',
                'type.required'=>'Select the package of plan',
                'ar_type.required'=>'Select the package of plan arabic',
            ]
        );

        $input = $request->all();

        $input['created_at'] = date('Y-m-d h:i:s');

        $packages = $this->paymentplan->createPackage($input);

        return redirect()->route('admin.plan.index')
                      ->with(self::SUCCESS, 'Package added successfully.');
    }

     public function packagearray(Request $request)
    {
        $response = [];
        $paymentplan = $this->paymentplan->getAll();

        $paymentplan = $paymentplan->toArray();

        foreach ($paymentplan as $paymentplan) 
        {
            $sub = [];
            $id = $paymentplan['id'];

            $sub[] = $id;
            
            $sub[] = ($paymentplan['type']) ? ucfirst($paymentplan['type']) : "-";

            $sub[] = ($paymentplan['months']) ? substr(ucfirst($paymentplan['months']),0,30) : "-";

            $sub[] = ($paymentplan['years']) ? substr(ucfirst($paymentplan['years']),0,30) : "-";

            $sub[] = ($paymentplan['price']) ? substr(ucfirst($paymentplan['price']),0,30) : "-";
            
            $paymentplan_id = Crypt::encryptString($id);

            if ($paymentplan['status'] == 1) {
                $verified_url = route('admin.plan.changestatus', array($paymentplan_id , 0));
                $sub[] = '<a onclick="return confirm_alert(`' . $verified_url . '`,`Are you sure you want to inactive this package ?`)"  href="#"><span class="btn btn-success btn-sm" data-toggle="tooltip" title="click here to inactive">Active</span></a>' . ' ';
            } elseif ($paymentplan['status'] == 0) {
                $verified_url = route('admin.plan.changestatus', array($paymentplan_id, 1));
                $sub[] = '<a onclick="return confirm_alert(`' . $verified_url . '`,`Are you sure you want to active this package ?`)"  href="#"><span class="btn btn-danger btn-sm" data-toggle="tooltip" title="click here to active">Inactive</span></a>' . ' ';
            }

            $delete_url = route('admin.plan.delete', [$paymentplan_id]);

            $action = '<div class="btn-part"><a class="edit" href="' . route('admin.plan.edit', $paymentplan_id) . '"><i class="fa fa-pencil-alt"></i></a>' . ' ';
            $action .= '<a class="delete" onclick="return confirm_alert(`' . $delete_url . '`,`Are you sure you want to delete this package ?`)"  href="#"><i class="fa fa-trash"></i>&nbsp;</a></div>';

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
        $plan = $this->paymentplan->getById($id);
        $page = '/admin/plan';
        return view('admin.paymentplan.create', compact('plan','page'));
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
                'type'=>'required',
                'ar_type'=>'required',
                'price'=>'required|numeric'
                             
            ],
            [
                //'months.required'=>'Enter the months',
                //'years.required'=>'Enter the years',
                'price.required'=>'Enter the price',
                //'months.numeric'=>'Enter the months must be number',
                //'years.numeric'=>'Enter the years must be number',
                'price.numeric'=>'Enter the price must be number',
                'type.required'=>'Select the package of plan',
                'ar_type.required'=>'Select the package of plan arabic',
            ]
        );

        $update_attributes = array(
            'type' => $request->type,
            'ar_type' => $request->ar_type,
            'months'=>isset($request->months)?$request->months:'-',
            'years'=>isset($request->years)?$request->years:'-',
            'price'=>$request->price
        );
        
        $medicine = $this->paymentplan->updateById($request->id, $update_attributes);

        return redirect()->route('admin.plan.index')
                    ->with(self::SUCCESS, 'Package updated successfully.');
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
        
        $paymentplan_id = Crypt::decryptString($id);

        $package_delete = $this->paymentplan->deleteById($paymentplan_id);

        return redirect()->route('admin.plan.index')->with('success', 'Package deleted successfully.');
    }

    public function changestatus($id, $status)
    {
       
        $id = Crypt::decryptString($id);

        $paymentplan = $this->paymentplan->getById($id);

        $update_attributes = array('status' => $status);

        $state_update = $this->paymentplan->updateById($id, $update_attributes);

        if ($status == 1) {
            $msg = 'Package is active successfully.';
        } elseif ($status == 0) {
            $msg = 'Package is inactive successfully.';
        }

        return redirect()->route('admin.plan.index')->with('success', $msg);
    }

}
