<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

use Hash;
use PDF;
use App\Clinic;
use App\DoctorClinic;
use App\Speciality;
use App\DoctorSpeciality;
use App\DoctorEducation;
use App\DoctorExperience;
use App\Medicine;
use App\Prescription;
use App\PrescriptionMedicines;
use App\Visit_Prescription;
use Auth;
use Config;
use Illuminate\Support\Facades\Crypt;
use App\Helpers\Notification\ICD_API_Client;

class PrescriptionController extends Controller
{
    private $clinic;
    private $doctor_clinic;
    private $user;
    private $speciality;
    private $doctor_speciality;
    private $prescription_medicines;
    private $prescription;
    public function __construct(Clinic $clinic,User $user,Speciality $speciality,DoctorClinic $doctor_clinic,Doctorspeciality $doctor_speciality,DoctorEducation $doctor_education,DoctorExperience $doctor_experience,PrescriptionMedicines $prescription_medicines,Prescription $prescription,Visit_Prescription $visit_prescription)
    {
        
        $this->clinic = $clinic;
        $this->doctor_clinic = $doctor_clinic;
        $this->user = $user;
        $this->speciality = $speciality;
        $this->doctor_speciality = $doctor_speciality;
        $this->doctor_education = $doctor_education;
        $this->doctor_experience = $doctor_experience;
        $this->prescription_medicines=$prescription_medicines;
        $this->prescription=$prescription;
        $this->visit_prescription=$visit_prescription;
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
        return view('admin.prescription.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $patients = User::with('roles')->whereHas('roles', function ($q) {
            $q->where('id', 3);
        })->get(); 
        $medicines = Medicine::where('status',1)->get();
        $page = '/admin/patient';
        return view('admin.prescription.create', compact('page','medicines'));
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
            'medicines' => 'required',
            'dose' => 'required',
            'route' => 'required',
            'diagnosis'=>'required',
            'duration' => 'required',
        ]);
                        $perscription_number = rand(100000,999999);
                        $prescription = new Prescription();
                        $prescription->diagnosis=$request->diagnosis;
                        $prescription->emr_number=$request->emr_number;
                        $prescription->prescription_number=$perscription_number;
                        $prescription->user_id = $request->doctor_id;
                        $prescription->notetopharmacy=$request->pharmacy;
                        $prescription->save();
                        $insertedId = $prescription->id;

        if(request('medicines'))
        {
            $medicines=request('medicines');

            $dose=request('dose');

            $route = request('route');

            $frequency = request('frequency1');

            $frequency_2 = request('frequency2');

            $frequency_3 = request('frequency3');

            $duration = request('duration');

                foreach ($medicines as $key => $e) {

                        if($e != null)
                        {
                            

                            $pres_medicines = new PrescriptionMedicines;
                            $pres_medicines->user_id = $e ? $request->doctor_id :"";
                            $pres_medicines->medicines_id = $medicines[$key] ? $medicines[$key]: "";
                            $pres_medicines->dose = $dose[$key] ? $dose[$key]: "";
                            $pres_medicines->route = $route[$key] ? $route[$key]: "";
                            $pres_medicines->frequency = $frequency[$key] ? $frequency[$key]: "";
                            $pres_medicines->frequency2 = $frequency_2[$key] ? $frequency_2[$key]: "";
                            $pres_medicines->frequency3 = $frequency_3[$key] ? $frequency_3[$key]: "";
                            $pres_medicines->duration = $duration[$key] ? $duration[$key]:"";
                            $pres_medicines->p_id=$insertedId;
                            $pres_medicines->save(); 
                        }
                }
        }

        return redirect()->route('admin.patient.index')
                      ->with('success', "Prescription Added Successfully.");
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
    public function edit($id,Request $request)
    {
        //
        $id = Crypt::decryptString($id);
        
        $prescription = $this->prescription->getById($id);

        $prescription_medicines=$this->prescription_medicines->where('user_id',$id)->pluck('medicines_id','id')->toArray();

        $medicines = Medicine::where('status',1)->get();

        $ped=$this->prescription_medicines->where('user_id',$id)->count();

        $page = '/admin/patient';

        if($prescription)
        {
            return view('admin.patient.edit', compact('prescription','prescription_medicines','medicines','ped'));    
        }
        else
        {
            return redirect()->route('admin.patient.index');
        }
        
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
            'medicines' => 'required',
            'dose' => 'required',
            'route' => 'required',
        ]);

        Prescription::where('user_id',$request->doctor_id)->delete();

        $perscription_number = rand(100000,999999);
        $prescription = new Prescription();
        $prescription->diagnosis=$request->diagnosis;
        $prescription->emr_number=$request->emr_number;
        $prescription->prescription_number=$perscription_number;
        $prescription->user_id = $request->doctor_id;
        $prescription->notetopharmacy=$request->pharmacy;
        $prescription->save();
        $insertedId = $prescription->id;
      
         if(request('medicines'))
        {
            $medicines=request('medicines');

            $dose=request('dose');

            $route = request('route');

            $frequency = request('frequency1');

            $frequency_2 = request('frequency2');

            $frequency_3 = request('frequency3');

            $duration = request('duration');

                foreach ($medicines as $key => $e) {

                        if($e != null)
                        {
                            
                            PrescriptionMedicines::where('p_id',$request->prescription_id)->delete();  

                            $pres_medicines = new PrescriptionMedicines;
                            $pres_medicines->user_id = $e ? $request->doctor_id :"";
                            $pres_medicines->medicines_id = $medicines[$key] ? $medicines[$key]: "";
                            $pres_medicines->dose = $dose[$key] ? $dose[$key]: "";
                            $pres_medicines->route = $route[$key] ? $route[$key]: "";
                            $pres_medicines->frequency = $frequency[$key] ? $frequency[$key]: "";
                            $pres_medicines->frequency2 = $frequency_2[$key] ? $frequency_2[$key]: "";
                            $pres_medicines->frequency3 = $frequency_3[$key] ? $frequency_3[$key]: "";
                            $pres_medicines->duration = $duration[$key] ? $duration[$key]:"";
                            $pres_medicines->p_id=$insertedId;
                            $pres_medicines->save(); 
                        }
                }
        }

      
        
        
        return redirect()->route('admin.patient.index')
                    ->with(self::SUCCESS, 'Prescription updated successfully.');
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

    public function prescription_array(Request $request)
    {
        $response = [];
        // $patients = User::with('roles')->whereHas('roles', function ($q) {
        //     $q->where('id', 3);
        // })->get();

        $prescription = $this->visit_prescription->getAll();
        
        $prescriptions = $prescription->toArray();
        
        foreach ($prescriptions as $prescription) {
            

            $sub = [];
            $id = $prescription['id'];

            $sub[] = $id;
            $sub[] = ($prescription['medicine_name']) ? ucfirst($prescription['medicine_name']) : "-";
            $sub[] = ($prescription['patient']['first_name']) ? ucfirst($prescription['patient']['first_name']) : "-";
            $sub[] = ($prescription['dose']) ? ucfirst($prescription['dose']) : "-";
            $sub[] = ($prescription['unit']) ? $prescription['unit'] : "-";
            $sub[] = ($prescription['duration']) ? ucfirst($prescription['duration']) : "-";
            $sub[] = ($prescription['route']) ? ucfirst($prescription['route']) : "-";
            $sub[] = ($prescription['strength']) ? ucfirst($prescription['strength']) : "-";
            //$sub[] = ($prescription['route']) ? ucfirst($prescription['route']) : "-";
            
            $patient_id = Crypt::encryptString($id);

            if ($prescription['status'] == 1) {
                $verified_url = route('admin.doctor.changestatus', array($patient_id , 0));
                $sub[] = '<a onclick="return confirm_alert(`' . $verified_url . '`,`Are you sure you want to inactive this patients ?`)"  href="#"><span class="btn btn-success btn-sm" data-toggle="tooltip" title="click here to inactive">Active</span></a>' . ' ';
            } elseif ($prescription['status'] == 0) {
                $verified_url = route('admin.doctor.changestatus', array($patient_id, 1));
                $sub[] = '<a onclick="return confirm_alert(`' . $verified_url . '`,`Are you sure you want to active this patients ?`)"  href="#"><span class="btn btn-danger btn-sm" data-toggle="tooltip" title="click here to active">Inactive</span></a>' . ' ';
            }
            $action = '<a class="edit" href="' . route('admin.patient.edit', $patient_id) . '"><button class="btn btn-info btn-sm"><i class="fa fa-edit"></i> </button></a>' . ' ';
                
            $action .= '<a class="edit" target="_blank" href="' . route('admin.prescription.pdf', $patient_id) . '"><button class="btn btn-info btn-sm"><i class="fas fa-file-pdf"></i></button></a>' . ' ';
            

            $delete_url = route('admin.doctor.delete', [$patient_id]);

            $sub[] = $action;
            $sub[] = $response[] = $sub;
        }

        $userjson = json_encode(["data" => $response]);
        echo $userjson;
    }

      public function changestatus($id, $status)
    {
        

        $id = Crypt::decryptString($id);

        $patient = $this->user->getById($id);

        $update_attributes = array('status' => $status);

        $doctor_update = $this->user->updateById($id, $update_attributes);

        if ($status == 1) {
            $msg = 'patient is active successfully.';
        } elseif ($status == 0) {
            $msg = 'patient is inactive successfully.';
        }

        return redirect()->route('admin.patient.index')->with('success', ucfirst($patient->name)." ".$msg);
    }

  public function downloadPDF($id,Request $request){

        $id = Crypt::decryptString($id);
        $patient = $this->prescription->getById($id);
        
        $patient_medicines=PrescriptionMedicines::where('user_id',$patient->user_id)->get();
        $pdf = PDF::loadView('admin.patient.pdf', compact('patient','patient_medicines'));
        return $pdf->stream('perscription.pdf', array('Attachment'=>0));
    }

    public function getprescriptions(Request $request)
    {
        $doctor_id = request('prescription_id');
        
        $prescription_medicines=Prescription::where('id',$doctor_id)->get();
        
        if($prescription_medicines)
        {
            return $prescription_medicines; 
        }
        else
        {
            return 0; 
        }
    }

    public function getprescriptions_medcines(Request $request)
    {
        $doctor_id = request('prescription_id');
        
        $prescription_medicines=PrescriptionMedicines::where('p_id',$doctor_id)->get();
        
        if($prescription_medicines)
        {
            return $prescription_medicines; 
        }
        else
        {
            return 0; 
        }
    }


    // public function getpp_medicines(Request $request)
    // {
    //     $value = request('id');

    //     $prescription_medicines=$this->prescription_medicines->where('user_id',$value)->get();
        
    //     if($prescription_medicines)
    //     {
    //         return $prescription_medicines; 
    //     }
    //     else
    //     {
    //         return 0; 
    //     }
    // }

    public function getdiagonis(Request $request)
    {

        $doctor_id=request('doctor_id');
        

        $availableTutorials = [];
        $uri = 'https://id.who.int/icd/entity/search?q='.$doctor_id;
        $icd_api_client = new ICD_API_Client($uri);

        $response = $icd_api_client->get();

        if($response)
        {
            $array = $response->DestinationEntities;
            foreach ($array as  $value) {
                $sub_array = [];
                $sub_array['label'] = $value->Title;
                $sub_array['value'] = $value->Id;
                $availableTutorials[] = $sub_array;
            }
            
        }
        return response()->json($availableTutorials);
    }

    public function getMedicines(Request $request)
    {
        $value = request('medicnes_id');

        $count= request('count');
        $id=request('id');

        $medicines = Medicine::where('id',$value)->get();
       
        if($medicines)
        {
            
            $array=array(
                "dose"=>isset($medicines[0]) ?$medicines[0]->dose:'',
                "route"=>isset($medicines[0]) ?$medicines[0]->route:'',
                "frequency"=>isset($medicines[0]) ?$medicines[0]->frequency:'',
                "frequency2"=>isset($medicines[0]) ?$medicines[0]->frequency2:'',
                "frequency3"=>isset($medicines[0]) ?$medicines[0]->frequency3:'',
                "duration"=>isset($medicines[0]) ?$medicines[0]->duration:'',
                "count"=>isset($medicines[0]) ?$count:'',
                "id"=>isset($medicines[0]) ?$id:'',
            );
            
            return json_encode($array);
        }
        else
        {
            return 0; 
        }
    }

    public function remove_prescriptions(Request $request)
    {
        $prescription_id = request('prescription_id');
        
        $prescription_medicines = $this->prescription_medicines->deleteById($prescription_id);
        
        if($prescription_medicines)
        {
            return 0; 
        }

        else
        {
            return 1; 
        }
    }

}
