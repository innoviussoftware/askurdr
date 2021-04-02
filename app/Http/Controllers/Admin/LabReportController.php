<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Labreport;
use App\User;
use App\Investigation;
use App\Visit_Investigation;
use Illuminate\Support\Facades\Crypt;

class LabReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $investigation_report;

    public function __construct(Labreport $investigation_report)
    {
        $this->investigation_report = $investigation_report;
    }

    const SUCCESS = 'success';

    public function index()
    {
        //
        return view('admin.labreport.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        //$page = '/admin/doctor';
        $investigation=Investigation::where('status',1)->get();
        $patients = User::with('roles')->whereHas('roles', function ($q) {
            $q->where('id', 3);
        })->get();      
        return view('admin.labreport.create',compact('investigation','patients'));
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
                    'test_type' => 'required',
                    'patient_name'=>'required',
                    'note'=>'required',
                    'result'=>'required',
        ],
        [
                    'note.required'=>'Please enter note',
                    'patient_name.required'=>'Please select patient name',
                    'test_type.required'=>'Please select test type',
                    'result.required'=>'Please enter result of report'
        ]
        );

        $visit_investigation = new Visit_Investigation();
        $visit_investigation->investigation_id = $request->test_type;
        $visit_investigation->result = $request->result;
        $visit_investigation->patient_id = $request->patient_name;        
        $visit_investigation->note=$request->note;
        $visit_investigation->save();

        return redirect()->route('admin.investigationreport.index')
                      ->with(self::SUCCESS, 'Investigation added successfully.');
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

     public function investigationreportarray(Request $request)
    {
        $response = [];
        $investigation_reports = $this->investigation_report->getAll();
        $reports = $investigation_reports->toArray();
        foreach ($reports as $report) {


            $sub = [];
            $id = $report['id'];
 
            $sub[] = $id;
            
            $sub[] = ($report['visit_investigation']['testname_english'])? ucfirst($report['visit_investigation']['testname_english']) : "-";

            $sub[] = ($report['note']) ? ucfirst($report['note']) : "-";

            $sub[] = ($report['patient']['first_name']) ? ucfirst($report['patient']['first_name']) : "-";

            $sub[] = ($report['doctor']['first_name']) ? ucfirst($report['doctor']['first_name']) : "-";

            $investigation_id = Crypt::encryptString($id);

            // if ($report['status'] == 1) {
            //     $verified_url = route('admin.investigationreport.changestatus', array($investigation_id , 0));
            //     $sub[] = '<a onclick="return confirm_alert(`' . $verified_url . '`,`Are you sure you want to inactive this investigation ?`)"  href="#"><span class="btn btn-success btn-sm" data-toggle="tooltip" title="click here to inactive">Active</span></a>' . ' ';
            // } elseif ($report['status'] == 0) {
            //     $verified_url = route('admin.investigationreport.changestatus', array($investigation_id, 1));
            //     $sub[] = '<a onclick="return confirm_alert(`' . $verified_url . '`,`Are you sure you want to active this investigation ?`)"  href="#"><span class="btn btn-danger btn-sm" data-toggle="tooltip" title="click here to active">Inactive</span></a>' . ' ';
            // }

            $delete_url = route('admin.investigationreport.delete', [$investigation_id]);

            $action = '<div class="btn-part"><a class="edit" href="' . route('admin.investigationreport.edit', $investigation_id) . '"><i class="fa fa-pencil-alt"></i></a>' . ' ';
            $action .= '<a class="delete" onclick="return confirm_alert(`' . $delete_url . '`,`Are you sure you want to delete this report ?`)"  href="#"><i class="fa fa-trash"></i>&nbsp;</a></div>';

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
        $labreport = $this->investigation_report->getById($id);
        $investigation=Investigation::where('status',1)->get();
        $patients = User::with('roles')->whereHas('roles', function ($q) {
            $q->where('id', 3);
        })->get();      
        return view('admin.labreport.create',compact('investigation','patients','labreport'));
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
                    'test_type' => 'required',
                    'patient_name'=>'required',
                    'note'=>'required',
                    'result'=>'required',
        ],
        [
                    'note.required'=>'Please enter note',
                    'patient_name.required'=>'Please select patient name',
                    'test_type.required'=>'Please select test type',
                    'result.required'=>'Please enter result of report'
        ]
        );

        $update_attributes = array(
            'investigation_id' => $request->test_type,
            'note' => $request->note,
            'patient_id' => $request->patient_name,
            'result'=>$request->result,
        );

        $investigation = $this->investigation_report->updateById($request->id, $update_attributes);

        return redirect()->route('admin.investigationreport.index')
                    ->with(self::SUCCESS, 'Investigation updated successfully.');
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
        
        $investigation_id = Crypt::decryptString($id);

        $investigation_delete = $this->investigation_report->deleteById($investigation_id);

        return redirect()->route('admin.investigationreport.index')->with('success', 'Investigation deleted successfully.');
    }

}
