<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Config;
use App\Investigation;
use App\DocumentType;
use Illuminate\Support\Facades\Crypt;

class InvestigationController extends Controller
{

    private $investigation;
    public function __construct(Investigation $investigation)
    {
        $this->investigation = $investigation;
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

        return view('admin.investigation.index');
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
        $doc_types=DocumentType::where('status',1)->get();
        return view('admin.investigation.create', compact('page','doc_types'));
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
                    'test_english' => 'required',
                    'test_arabic'=>'required',
                    'test_type'=>'required',
        ],
        [
                    'test_english.required'=>'Please enter test name in english',
                    'test_arabic.required'=>'Please enter test name in arabic',
                    'test_type.required'=>'Please select test type',
        ]
        );

        $investigation = new Investigation();
        $investigation->testname_english = $request->test_english;
        $investigation->testname_arabic = $request->test_arabic;
        $investigation->type_id = $request->test_type;        
        $investigation->type_name=$request->type_name;
        $investigation->save();

        return redirect()->route('admin.investigation.index')
                      ->with(self::SUCCESS, 'Investigation added successfully.');
    }

     public function investigationarray(Request $request)
    {
        $response = [];
        $investigation = $this->investigation->getAll();

        $investigations = $investigation->toArray();
        foreach ($investigations as $investigation) {
                
            $sub = [];
            $id = $investigation['id'];

            $sub[] = $id;
            
            $sub[] = ($investigation['testname_english']) ? ucfirst($investigation['testname_english']) : "-";

            $sub[] = ($investigation['testname_arabic']) ? ucfirst($investigation['testname_english']) : "-";

            $sub[] = ($investigation['document_type']['name'])? ucfirst($investigation['document_type']['name']) : "-";
            
            $investigation_id = Crypt::encryptString($id);

            if ($investigation['status'] == 1) {
                $verified_url = route('admin.investigation.changestatus', array($investigation_id , 0));
                $sub[] = '<a onclick="return confirm_alert(`' . $verified_url . '`,`Are you sure you want to inactive this investigation ?`)"  href="#"><span class="btn btn-success btn-sm" data-toggle="tooltip" title="click here to inactive">Active</span></a>' . ' ';
            } elseif ($investigation['status'] == 0) {
                $verified_url = route('admin.investigation.changestatus', array($investigation_id, 1));
                $sub[] = '<a onclick="return confirm_alert(`' . $verified_url . '`,`Are you sure you want to active this investigation ?`)"  href="#"><span class="btn btn-danger btn-sm" data-toggle="tooltip" title="click here to active">Inactive</span></a>' . ' ';
            }

            $delete_url = route('admin.investigation.delete', [$investigation_id]);

            $action = '<div class="btn-part"><a class="edit" href="' . route('admin.investigation.edit', $investigation_id) . '"><i class="fa fa-pencil-alt"></i></a>' . ' ';
            $action .= '<a class="delete" onclick="return confirm_alert(`' . $delete_url . '`,`Are you sure you want to delete this Investigation ?`)"  href="#"><i class="fa fa-trash"></i>&nbsp;</a></div>';

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
        $page = '/admin/doctor';
        $investigation = $this->investigation->getById($id);
        $doc_types=DocumentType::where('status',1)->get();
        return view('admin.investigation.create', compact('page','investigation','doc_types'));
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
                    'test_english' => 'required',
                    'test_arabic'=>'required',
                    'test_type'=>'required',
        ],
        [
                    'test_english.required'=>'Please enter test name in english',
                    'test_arabic.required'=>'Please enter test name in arabic',
                    'test_type.required'=>'Please select test type',
        ]
        );

        $update_attributes = array(
            'testname_english' => $request->test_english,
            'testname_arabic' => $request->test_arabic,
            'type_id' => $request->test_type,
            'type_name'=>$request->type_name,
        );

        $investigation = $this->investigation->updateById($request->id, $update_attributes);

        return redirect()->route('admin.investigation.index')
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

        $investigation_delete = $this->investigation->deleteById($investigation_id);

        return redirect()->route('admin.investigation.index')->with('success', 'Investigation deleted successfully.');
    }

     public function changestatus($id, $status)
    {
       
        $id = Crypt::decryptString($id);

        $investigation = $this->investigation->getById($id);

        $update_attributes = array('status' => $status);

        $state_update = $this->investigation->updateById($id, $update_attributes);

        if ($status == 1) {
            $msg = 'Investigation is active successfully.';
        } elseif ($status == 0) {
            $msg = 'Investigation is inactive successfully.';
        }

        return redirect()->route('admin.investigation.index')->with('success', ucfirst($investigation->testname_english)." ".$msg);
    }
}
