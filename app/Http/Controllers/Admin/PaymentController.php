<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Config;
use DB;
use App\Payment_details;
use App\DocumentType;
use Illuminate\Support\Facades\Crypt;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $payment_details;

    public function __construct(Payment_details $payment_details)
    {
        $this->payment_details = $payment_details;
    }

    const SUCCESS = 'success';

    public function index()
    {
        //
        return view('admin.paymentdetails.index');
    }

      public function payementdetailsarray(Request $request)
    {

        $response = [];
        
        $payment_details=DB::table('payment_detail')->select('payment_detail.*','paymentplan.type as paymenttype','paymentplan.price as paymentprice','users.*')->join('users','payment_detail.user_id','=','users.id')->join('paymentplan','payment_detail.package_id','=','paymentplan.id')->get();
        
        $payment_details = $payment_details->toArray();

         foreach ($payment_details as $payment_detail) {
             
            $sub = [];
            $id = $payment_detail->id;

            $sub[] = $id;
            
            $sub[] = ($payment_detail->first_name) ? ucfirst($payment_detail->first_name).' '.$payment_detail->last_name : "-";

            $sub[] = ($payment_detail->emr_number) ? $payment_detail->emr_number: "-";

            $sub[] = ($payment_detail->paymenttype) ? ucfirst($payment_detail->paymenttype) : "-";

            if ($payment_detail->type== 1) {
                
                $sub[] = '<span class="btn btn-success btn-sm">Self Payment</span>';
            } 
            elseif ($payment_detail->type== 2) {
                $sub[] = '<span class="btn btn-success btn-sm">Insurance</span>';
            }
            else{
                $sub[] = '<span class="btn btn-success btn-sm">NULL</span>';
            }

            if ($payment_detail->payment_status== 0) {
                
                $sub[] = '<span class="btn btn-danger btn-sm">Unpaid</span>';
            } 
            elseif ($payment_detail->payment_status== 1) {
                $sub[] = '<span class="btn btn-success btn-sm">Paid</span>';
            }
            else{
                $sub[] = '<span class="btn btn-success btn-sm">NULL</span>';
            }

            $sub[] = ($payment_detail->paymentprice) ? ucfirst($payment_detail->paymentprice) : "-";

            $sub[] = ($payment_detail->plan_startdate) ? $payment_detail->plan_startdate:"-";

            $sub[] = ($payment_detail->plan_enddate) ? $payment_detail->plan_enddate:"-";

            $sub[] = ($payment_detail->transaction_id) ? ucfirst($payment_detail->transaction_id) : "-";

            $sub[] = $response[] = $sub;
        }
        $userjson = json_encode(["data" => $response]);
        echo $userjson;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
}
