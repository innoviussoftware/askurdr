<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DocumentType;
use Auth;
use Config;
use Illuminate\Support\Facades\Crypt;

class DocumentTypeController extends Controller
{
    private $documenttype;
    public function __construct(DocumentType $documenttype)
    {
        $this->documenttype = $documenttype;
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
        return view('admin.document_type.index');
    }

    public function create()
    {
        // $current_user = Auth::user();
        // if ($current_user->can([Config::get('constants.modules.STATE')]) == false) {
        //     return abort(401);
        // }

        $page = '/admin/document-type';
        return view('admin.document_type.create', compact('page'));
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
        'name' => 'required|unique:document_type',
        'ar_name' => 'required|unique:document_type',
        ],
        [
                    'name.required' => 'Please enter document type',
                    'name.unique' => 'Document type name already exists',
                    'name.alpha'=>'Document type name cannot contain numberic value',
                    'ar_name.required' => 'Please enter document type',
                    'ar_name.unique' => 'Document type name already exists',
                    'ar_name.alpha'=>'Document type name cannot contain numberic value'
        ]);
        $input = $request->all();
        $input['created_at'] = date('Y-m-d h:i:s');

        $document = $this->documenttype->createDocumentType($input);

        return redirect()->route('admin.document_type.index')
                      ->with(self::SUCCESS, 'Document type added successfully.');
    }

    public function documenttypearray(Request $request)
    {
        $response = [];
        $document_type = $this->documenttype->getAll();

        $document_type = $document_type->toArray();
        foreach ($document_type as $document_type) {
            $sub = [];
            $id = $document_type['id'];

            $sub[] = $id;
            
            $sub[] = ($document_type['name']) ? ucfirst($document_type['name']) : "-";
            
            $document_id = Crypt::encryptString($id);

            if ($document_type['status'] == 1) {
                $verified_url = route('admin.document_type.changestatus', array($document_id , 0));
                $sub[] = '<a onclick="return confirm_alert(`' . $verified_url . '`,`Are you sure you want to inactive this document type ?`)"  href="#"><span class="btn btn-success btn-sm" data-toggle="tooltip" title="click here to inactive">Active</span></a>' . ' ';

            } elseif ($document_type['status'] == 0) {
                $verified_url = route('admin.document_type.changestatus', array($document_id, 1));
                $sub[] = '<a onclick="return confirm_alert(`' . $verified_url . '`,`Are you sure you want to active this document type ?`)"  href="#"><span class="btn btn-danger btn-sm" data-toggle="tooltip" title="click here to active">Inactive</span></a>' . ' ';
            }

            $delete_url = route('admin.document_type.delete', [$document_id]);

            $action = '<div class="btn-part"><a class="edit" href="' . route('admin.document_type.edit', $document_id) . '"><i class="fa fa-pencil-alt"></i></a>' . ' ';
            $action .= '<a class="delete" onclick="return confirm_alert(`' . $delete_url . '`,`Are you sure you want to delete this document type ?`)"  href="#"><i class="fa fa-trash"></i>&nbsp;</a></div>';

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
        $document_type = $this->documenttype->getById($id);
        $page = '/admin/document-type';
        return view('admin.document_type.create', compact('document_type','page'));
    }

    public function update(Request $request)
    {
        // $current_user = Auth::user();
        // if ($current_user->can([Config::get('constants.modules.STATE')]) == false) {
        //     return abort(401);
        // }

        $this->validate($request, [
            'name' => 'required|unique:document_type,name,'.$request->id,
            'ar_name' => 'required|unique:document_type,ar_name,'.$request->id,
        ],
        [
                    'name.required' => 'Please enter document type',
                    'name.unique' => 'Document type name already exists',
                    'ar_name.required' => 'Please enter document type arabic',
                    'ar_name.unique' => 'Document type name arabic already exists'

        ]);
       

        $check_document_type_name = DocumentType::where('name', $request->name)->count();

        if ($check_document_type_name > 0) {
            $dcument_type_name = DocumentType::where('name', $request->name)->first();
            if ($dcument_type_name->id != $request->id) {
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

        $document_type = $this->documenttype->updateById($request->id, $update_attributes);

        return redirect()->route('admin.document_type.index')
                    ->with(self::SUCCESS, 'Document type updated successfully.');
    }

    public function delete($id)
    {
        // $current_user = Auth::user();
        // if ($current_user->can([Config::get('constants.modules.STATE')]) == false) {
        //     return abort(401);
        // }

        $document_id = Crypt::decryptString($id);

        $document_delete = $this->documenttype->deleteById($document_id);
        return redirect()->route('admin.document_type.index')->with('success', 'Document type deleted successfully.');
    }

    public function changestatus($id, $status)
    {
        // $current_user = Auth::user();
        // if ($current_user->can([Config::get('constants.modules.STATE')]) == false) {
        //     return abort(401);
        // }

        $id = Crypt::decryptString($id);
        $document_type = $this->documenttype->getById($id);

        $update_attributes = array('status' => $status);

        $state_update = $this->documenttype->updateById($id, $update_attributes);
        if ($status == 1) {
            $msg = 'document type is active successfully.';
        } elseif ($status == 0) {
            $msg = 'document type is inactive successfully.';
        }

        return redirect()->route('admin.document_type.index')->with('success', ucfirst($document_type->name)." ".$msg);
    }

    
}
