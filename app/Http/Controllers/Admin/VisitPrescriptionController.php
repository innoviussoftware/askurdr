<?php

namespace App\Http\Controllers\Admin;

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
use App\DoctorBooking;
use Auth;
use Config;
use Illuminate\Support\Facades\Crypt;
class VisitPrescriptionController extends Controller
{
    //
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

    public function index()
    {
        return view('admin.newprescription.index');
    }

    public function create()
    {
        //
        $page = '/admin/prescriptionreport';
        $medicines = Medicine::where('status',1)->get();
        $patients = User::with('roles')->whereHas('roles', function ($q) {
            $q->where('id', 3);
        })->get();
        return view('admin.newprescription.create', compact('page','medicines','patients'));
    }

    public function store(Request $request)
    {
          $this->validate($request, [
            'medicines' => 'required',
            'dose' => 'required',
            'route' => 'required',
            'units'=>'required',
            'duration' => 'required',
            'frequency1'=>'required',

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

          
          // foreach ($request->medicines as $key => $value) {
          // 		$report_file_input[] = $value;
          // }
          // $words = '"'.implode(',', $report_file_input).'"';
          $doctor_id = auth()->user()->id;
          if(request('medicines'))
          {
                $id=request('medicines');
                $medicine_name=Medicine::select('name')->where('id',$id)->first();
          }

          $visit_prescription = new Visit_Prescription;
          $visit_prescription->patient_id=$request->patients;
          $visit_prescription->medicine_id=$request->medicines;
          $visit_prescription->medicine_name=$medicine_name->name;
          $visit_prescription->dose=$request->dose;
          $visit_prescription->unit=$request->units;
          $visit_prescription->duration=$request->duration;
          $visit_prescription->route=$request->route;
          $visit_prescription->frequency=$request->frequency1;
          $visit_prescription->frequency2=$request->frequency2;
          $visit_prescription->frequency3=$request->frequency3;
          $visit_prescription->doctor_id=$doctor_id;
          $visit_prescription->save();
          $visit_id = $visit_prescription->id;
          $path = 'storage/pdf/lab_reports/' .$visit_id. '_labereport.pdf';
          $clinic=DoctorClinic::where('user_id',$doctor_id)->with('clinic')->first();
          $pdf = PDF::loadView('admin.newprescription.visit_pdf',compact('visit_prescription','clinic'))->save($path);
          Visit_Prescription::where('id',$visit_id)->update(array('pdf'=>$path)); 

           return redirect()->route('admin.prescriptionreport.index')
                      ->with('success', "Prescription Added Successfully.");
      }

    public function edit($id)
    {
        //
        $id = Crypt::decryptString($id);
        $prescription = $this->visit_Prescription->getById($id);
        $medicines = Medicine::where('status',1)->get();
      //  $dd= trim($prescription->medicine_id,'"');
       // $myArray = explode(',', $dd);
        //$medicines_prescription = Visit_Prescription::where('id',$id)->pluck('medicine_id')->toArray();
        $patients = User::with('roles')->whereHas('roles', function ($q) {
            $q->where('id', 3);
        })->get();
        $page = '/admin/medicines';
        return view('admin.newprescription.edit', compact('prescription','medicines','page','patients','myArray'));
    }

    public function prescriptionarray(Request $request)
    {
        $response = [];
        $prescriptions = $this->visit_Prescription->getAll();

        $prescriptions = $prescriptions->toArray();
        foreach ($prescriptions as $prescription) {
        	
            $sub = [];
            $id = $prescription['id'];

            $sub[] = $id;
            
            $sub[] = ($prescription['patient']['first_name']) ? ucfirst($prescription['patient']['first_name']) : "-";

            $sub[] = ($prescription['patient']['emr_number']) ? ucfirst($prescription['patient']['emr_number']) : "-";

          //  $sub[] = ($prescription['medicine_name']) ? substr(ucfirst($prescription['medicine_name']),0,15)   : "-";
            
            $prescription = Crypt::encryptString($id);

            $delete_url = route('admin.prescriptionreport.delete', [$prescription]);

            $action = '<div class="btn-part"><a class="edit" href="' . route('admin.prescriptionreport.edit', $prescription) . '"><i class="fa fa-pencil-alt"></i></a>' . ' ';
            $action .= '<a class="delete" onclick="return confirm_alert(`' . $delete_url . '`,`Are you sure you want to delete this prescription ?`)"  href="#"><i class="fa fa-trash"></i>&nbsp;</a></div>';

            $sub[] = $action;
            $sub[] = $response[] = $sub;
        }
        $userjson = json_encode(["data" => $response]);
        echo $userjson;
    }

     public function update(Request $request)
    {
        //
        $this->validate($request, [
            'medicines' => 'required',
            'dose' => 'required',
            'route' => 'required',
            'units'=>'required',
            'duration' => 'required',
            'frequency1'=>'required',

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

   

        
	// foreach ($request->medicines as $key => $value) {
 //          		$report_file_input[] = $value;
 //    }
 //    	$words = '"'.implode(',', $report_file_input).'"';
        if(request('medicines'))
          {
                $id=request('medicines');
                $medicine_name=Medicine::select('name')->where('id',$id)->first();
                
          }
    	$doctor_id = auth()->user()->id;
        $update_Prescription = array(
            'patient_id' => $request->patients,
            'medicine_id'=>$request->medicines,
            'medicine_name'=>$medicine_name->name,
            'dose'=>$request->dose,
            'unit'=>$request->units,
            'frequency'=>$request->frequency1,
            'frequency2'=>$request->frequency2,
            'frequency3'=>$request->frequency3,
            'duration'=>$request->duration,
            'route'=>$request->route,
            'doctor_id'=>$doctor_id,
        );        
         
        $medicine = $this->visit_Prescription->updateById($request->id, $update_Prescription);
        $visit_prescription=Visit_Prescription::where('id',$request->id)->first();
        $path = 'storage/pdf/lab_reports/' .$request->id. '_labereport.pdf';
        $clinic=DoctorClinic::where('user_id',$doctor_id)->with('clinic')->first();
        $pdf = PDF::loadView('admin.newprescription.visit_pdf',compact('visit_prescription','clinic'))->save($path);
        Visit_Prescription::where('id',$request->id)->update(array('pdf'=>$path));
        return redirect()->route('admin.prescriptionreport.index')
                    ->with(self::SUCCESS, 'Prescription updated successfully.');
    }


    public function delete($id)
    {
        $medicines_id = Crypt::decryptString($id);

        $speciality_delete = $this->visit_Prescription->deleteById($medicines_id);

        return redirect()->route('admin.prescriptionreport.index')->with('success', 'Prescription deleted successfully.');
    }
    
    public function appointment_index()
    {
        return view('admin.appointment.index');
    }
    
    
    public function appointmentarray(Request $request)
    {
        $response = [];
        $prescriptions = DoctorBooking::with('patient','doctor')->get();
        
        $prescriptions = $prescriptions->toArray();
        foreach ($prescriptions as $prescription) {
          
            $sub = [];
            $id = $prescription['id'];

            $sub[] = $id;

            $sub[] = ($prescription['doctor']['first_name']) ? ucfirst($prescription['doctor']['first_name']) : "-";
            
            $sub[] = ($prescription['patient']['first_name']) ? ucfirst($prescription['patient']['first_name']) : "-";

            $sub[] = ($prescription['patient']['emr_number']) ? ucfirst($prescription['patient']['emr_number']) : "-";

            $sub[] = ($prescription['date']) ? ucfirst($prescription['date']) : "-";

            $sub[] = ($prescription['time_slot']) ? substr(ucfirst($prescription['time_slot']),0,15)   : "-";
            
            $prescription = Crypt::encryptString($id);

            $delete_url = route('admin.prescriptionreport.delete', [$prescription]);

            $action = '<div class="btn-part"><a class="edit" href="' . route('admin.prescriptionreport.edit', $prescription) . '"><i class="fa fa-pencil-alt"></i></a>' . ' ';
            $action .= '<a class="delete" onclick="return confirm_alert(`' . $delete_url . '`,`Are you sure you want to delete this prescription ?`)"  href="#"><i class="fa fa-trash"></i>&nbsp;</a></div>';

            $sub[] = $action;
            $sub[] = $response[] = $sub;
        }
        $userjson = json_encode(["data" => $response]);
        echo $userjson;
    }
}
