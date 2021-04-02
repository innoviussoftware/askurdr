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
use App\EmrDetails;
use Auth;
use Config;
use Illuminate\Support\Facades\Crypt;
use App\Helpers\Notification\ICD_API_Client;

class PatientController extends Controller
{
    private $clinic;
    private $doctor_clinic;
    private $user;
    private $speciality;
    private $doctor_speciality;
    private $prescription_medicines;
    private $prescription;
    public function __construct(Clinic $clinic,User $user,Speciality $speciality,DoctorClinic $doctor_clinic,Doctorspeciality $doctor_speciality,DoctorEducation $doctor_education,DoctorExperience $doctor_experience,PrescriptionMedicines $prescription_medicines,Prescription $prescription,EmrDetails $emrdetails,Visit_Prescription $visit_Prescription)
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
        $this->emrdetails=$emrdetails;
        $this->visit_Prescription=$visit_Prescription;
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
        return view('admin.patient.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        
        // $login_id = Auth::user()->id;
        $id = Crypt::decryptString($id);
        $doctor = $this->user->getById($id);
        

        $medicines = Medicine::where('status',1)->get();
        $page = '/admin/patient';
        return view('admin.patient.create', compact('page','medicines','doctor'));
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
            'units'=>'required',
            'diagnosis'=>'required',
            'duration' => 'required',
            'frequency1'=>'required',
            'pharmacy'=>'required',

        ],
       [
            'dose.required'=>'Enter the dose',
            'units.required'=>'Enter the unit',
            'route.required'=>'Enter the route',
            'duration.required'=>'Enter the duration',
            'route.required'=>'Enter the route',
            'frequency1.required'=>'Enter the frequency',
            'diagnosis.required'=>'Please enter the diagnosis',
            'pharmacy.required'=>'Enter the note of pharmacy'
        ]);
                        $id=Auth::user()->id;
                        $perscription_number = rand(100000,999999);
                        $emrDetails = new EmrDetails();
                        $emrDetails->physican_diagonis_id=$request->diagnosis;
                        $emrDetails->emr_no=$request->emr_number;
                        $emrDetails->patient_id = $request->doctor_id;
                        $emrDetails->doctor_id = $id;                        
                        $emrDetails->save();
                        $insertedId = $emrDetails->id;

        if(request('medicines'))
        {
            $medicines=request('medicines');

            $dose=request('dose');

            $units=request('units');

            $route = request('route');

            $frequency = request('frequency1');

            $frequency_2 = request('frequency2');

            $frequency_3 = request('frequency3');

            $duration = request('duration');

                foreach ($medicines as $key => $e) {

                        if($e != null)
                        {
                            
                            $id=Auth::user()->id;
                            $visit_Prescription = new Visit_Prescription;
                            $visit_Prescription->patient_id = $e ? $request->doctor_id :"";
                            $visit_Prescription->doctor_id = $e ? $id :"";
                            $visit_Prescription->medicine_id = $medicines[$key] ? $medicines[$key]: "";
                            $visit_Prescription->dose = $dose[$key] ? $dose[$key]: "";
                            $visit_Prescription->unit = $units[$key] ? $units[$key]: "";
                            $visit_Prescription->route = $route[$key] ? $route[$key]: "";
                            $visit_Prescription->frequency = $frequency[$key] ? $frequency[$key]: "";
                            $visit_Prescription->frequency2 = $frequency_2[$key] ? $frequency_2[$key]: "";
                            $visit_Prescription->frequency3 = $frequency_3[$key] ? $frequency_3[$key]: "";
                            $visit_Prescription->duration = $duration[$key] ? $duration[$key]:"";
                            $visit_Prescription->emr_id=$insertedId;
                            $visit_Prescription->save(); 
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
        
        $id = Crypt::decryptString($id);
        
        $emrdetails = $this->emrdetails->getById($id);

        $patient = $this->user->getById($id);

        $prescription_medicines=$this->visit_Prescription->where('patient_id',$id)->pluck('medicine_id','id')->toArray();

        $medicines = Medicine::where('status',1)->get();

        $ped=$this->visit_Prescription->where('patient_id',$id)->count();

        $page = '/admin/patient';

        if($emrdetails)
        {
            return view('admin.patient.edit', compact('emrdetails','prescription_medicines','medicines','ped','patient'));    
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
            'units'=>'required',
            'route' => 'required',
            'diagnosis'=>'required',
            'duration' => 'required',
            'frequency1'=>'required',
            'pharmacy'=>'required',
        ],
       [
            'dose.required'=>'Enter the dose',
            'units.required'=>'Enter the unit',
            'route.required'=>'Enter the route',
            'duration.required'=>'Enter the duration',
            'route.required'=>'Enter the route',
            'frequency1.required'=>'Enter the frequency',
            'diagnosis.required'=>'Please enter the diagnosis',
            'pharmacy.required'=>'Enter the note of pharmacy'
        ]
        );

        EmrDetails::where('id',$request->prescription_id)->delete();
        $id=Auth::user()->id;
        $emrDetails = new EmrDetails();
        $emrDetails->physican_diagonis_id=$request->diagnosis;
        $emrDetails->emr_no=$request->emr_number;
        $emrDetails->patient_id = $request->patient_id;
        $emrDetails->doctor_id = $id;                        
        $emrDetails->save();
        $insertedId = $emrDetails->id;
      
         if(request('medicines'))
        {
            $medicines=request('medicines');

            $dose=request('dose');

            $units=request('units');

            $route = request('route');

            $frequency = request('frequency1');

            $frequency_2 = request('frequency2');

            $frequency_3 = request('frequency3');

            $duration = request('duration');

                foreach ($medicines as $key => $e) {

                        if($e != null)
                        {
                            
                            Visit_Prescription::where('emr_id',$request->prescription_id)->delete();  

                            $id=Auth::user()->id;
                            $visit_Prescription = new Visit_Prescription;
                            $visit_Prescription->patient_id = $e ? $request->patient_id :"";
                            $visit_Prescription->doctor_id = $e ? $id :"";
                            $visit_Prescription->medicine_id = $medicines[$key] ? $medicines[$key]: "";
                            $visit_Prescription->dose = $dose[$key] ? $dose[$key]: "";
                            $visit_Prescription->unit = $units[$key] ? $units[$key]: "";
                            $visit_Prescription->route = $route[$key] ? $route[$key]: "";
                            $visit_Prescription->frequency = $frequency[$key] ? $frequency[$key]: "";
                            $visit_Prescription->frequency2 = $frequency_2[$key] ? $frequency_2[$key]: "";
                            $visit_Prescription->frequency3 = $frequency_3[$key] ? $frequency_3[$key]: "";
                            $visit_Prescription->duration = $duration[$key] ? $duration[$key]:"";
                            $visit_Prescription->emr_id=$insertedId;
                            $visit_Prescription->save(); 
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

    public function patientarray(Request $request)
    {
        $response = [];
        $patients = User::with('roles')->whereHas('roles', function ($q) {
            $q->where('id', 3);
        })->get();


        $patients = $patients->toArray();
        
        foreach ($patients as $patient) {
            $sub = [];
            $id = $patient['id'];

            $sub[] = $id;
            
            $sub[] = ($patient['first_name']) ? ucfirst($patient['first_name']) : "-";
            $sub[] = ($patient['email']) ? $patient['email'] : "-";
            $sub[] = ($patient['mobile']) ? ucfirst($patient['mobile']) : "-";
            $sub[] = ($patient['gender']) ? ucfirst($patient['gender']) : "-";
            
            $patient_id = Crypt::encryptString($id);

            if ($patient['status'] == 1) {
                $verified_url = route('admin.patient.changestatus', array($patient_id , 0));
                $sub[] = '<a onclick="return confirm_alert(`' . $verified_url . '`,`Are you sure you want to inactive this prescription ?`)"  href="#"><span class="btn btn-success btn-sm" data-toggle="tooltip" title="click here to inactive">Active</span></a>' . ' ';
            } elseif ($patient['status'] == 0) {
                $verified_url = route('admin.patient.changestatus', array($patient_id, 1));
                $sub[] = '<a onclick="return confirm_alert(`' . $verified_url . '`,`Are you sure you want to active this prescription ?`)"  href="#"><span class="btn btn-danger btn-sm" data-toggle="tooltip" title="click here to active">Inactive</span></a>' . ' ';
            }
            
            $patients = EmrDetails::whereIn('patient_id',[$id])->pluck('patient_id')->toArray();
            
            if($patients != null)
            {
                
                $action = '<a class="edit" href="' . route('admin.patient.edit', $patient_id) . '"><button class="btn btn-info btn-sm"><i class="fa fa-edit"></i> </button></a>' . ' ';
                

                $action .= '<a class="edit" target="_blank" href="' . route('admin.prescription.pdf', $patient_id) . '"><button class="btn btn-info btn-sm"><i class="fas fa-file-pdf"></i></button></a>' . ' ';
                
            }
            else
            {
               $action = '<a class="edit" href="' . route('admin.patient.create', $patient_id) . '"><button class="btn btn-info btn-sm"><i class="fa fa-plus"></i> Add Prescription</button></a>' . ' ';
            }

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
            $msg = 'Prescription is active successfully.';
        } elseif ($status == 0) {
            $msg = 'Prescription is inactive successfully.';
        }

        return redirect()->route('admin.patient.index')->with('success', ucfirst($patient->name)." ".$msg);
    }

  public function downloadPDF($id,Request $request){

        $id = Crypt::decryptString($id);
        $patient = $this->emrdetails->getById($id);
        $patient_medicines = $this->prescription_medicines->getByuserId($id);
        //$patient_medicines=PrescriptionMedicines::where('user_id',$patient->user_id)->with('medicines')->get();
        
        $pdf = PDF::loadView('admin.patient.pdf', compact('patient','patient_medicines'));
        return $pdf->stream('perscription.pdf', array('Attachment'=>0));
    }

    public function getprescriptions(Request $request)
    {
        $doctor_id = request('prescription_id');
        
        $prescription_medicines=Visit_Prescription::where('id',$doctor_id)->get();
        
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
        

        $prescription_medicines=Visit_Prescription::where('emr_id',$doctor_id)->get();
        
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
                "unit"=>isset($medicines[0])?$medicines[0]->unit:'',
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
        
        $prescription_medicines = $this->visit_Prescription->deleteById($prescription_id);
        
        if($prescription_medicines)
        {
            return 0; 
        }

        else
        {
            return 1; 
        }
    }

    public function delete($id)
    {
       
        $patient_id = Crypt::decryptString($id);

        $patient_delete = $this->user->deleteById($patient_id);

        return redirect()->route('admin.patient.index')->with('success', 'Patient deleted successfully.');
    }

}
