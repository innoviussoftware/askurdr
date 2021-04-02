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

class InsuranceController extends Controller
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
        return view('admin.insurance.index');
    }

      public function insurancedetailsarray(Request $request)
    {

        $response = [];
        
        $payment_details=DB::table('payment_detail')->select('payment_detail.*','users.*')->where('payment_detail.type',2)->join('users','payment_detail.user_id','=','users.id')->get();
        
        $payment_details = $payment_details->toArray();

         foreach ($payment_details as $payment_detail) {
             
            $sub = [];
            $id = $payment_detail->id;

            $sub[] = $id;

            $sub[] = ($payment_detail->first_name) ? ucfirst($payment_detail->first_name).' '.$payment_detail->last_name : "-";
            
            $sub[] = ($payment_detail->insurance_number) ? ucfirst($payment_detail->insurance_number): "-";

            $sub[] = ($payment_detail->insurance_name) ? ucfirst($payment_detail->insurance_name) : "-";

            $subeducation=[];
 
            $reports_file=explode("| ",$payment_detail->insurance_photo);

            foreach ($reports_file as $reports) {
                
                $subeducation[]='<img src="'.env('STORAGE_FILE_PATH').'/'.$reports.'"  width="50px" height="auto" class="img-responsive">';
            }

            $sub[]=$subeducation;
            $sub[] = ($payment_detail->insurance_photo) ? ucfirst($payment_detail->insurance_photo) : "-";


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
