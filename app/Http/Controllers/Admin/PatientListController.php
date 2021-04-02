<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Hash;
use Illuminate\Support\Facades\Crypt;
use App\Notifications\WelcomeUser;
use App\Helpers\Notification\SmsAla;
use App\MasterAdminSetting;
use App\Payment_history;
use Auth;
use App\CountryCodeIso;
class PatientListController extends Controller
{
    private $user;
    public function __construct(User $user)
    {


        $this->user = $user;

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
        return view('admin.patientlist.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $page = '/admin/patientlist';
         $code=CountryCodeIso::get();
        return view('admin.patientlist.create',compact('page','code'));
    }

     public function patientlistarray(Request $request)
    {
        $response = [];
        $patients = User::with('roles')->whereHas('roles', function ($q) {
            $q->where('id', 3);
        })->get();

        // $doctors = $this->user->getAll();

        $patients = $patients->toArray();

        foreach ($patients as $patient) {
            $sub = [];
            $id = $patient['id'];

            $sub[] = $id;

            $sub[] = ($patient['first_name']) ? ucfirst($patient['first_name']) : "-";
            $sub[] = ($patient['emr_number']) ? ucfirst($patient['emr_number']) : "-";
            $sub[] = ($patient['email']) ? $patient['email'] : "-";
            $sub[] = ($patient['mobile']) ? ucfirst($patient['mobile']) : "-";
            $sub[] = ($patient['gender']) ? ucfirst($patient['gender']) : "-";


            $patient_id = Crypt::encryptString($id);

            if ($patient['status'] == 1) {
                $verified_url = route('admin.patientlist.changestatus', array($patient_id , 0));
                $sub[] = '<a onclick="return confirm_alert(`' . $verified_url . '`,`Are you sure you want to inactive this patient ?`)"  href="#"><span class="btn btn-success btn-sm" data-toggle="tooltip" title="click here to inactive">Active</span></a>' . ' ';
            } elseif ($patient['status'] == 0) {
                $verified_url = route('admin.patientlist.changestatus', array($patient_id, 1));
                $sub[] = '<a onclick="return confirm_alert(`' . $verified_url . '`,`Are you sure you want to active this patient ?`)"  href="#"><span class="btn btn-danger btn-sm" data-toggle="tooltip" title="click here to active">Inactive</span></a>' . ' ';
            }

            $delete_url = route('admin.patientlist.delete', [$patient_id]);

            $action = '<div class="btn-part"><a class="edit" href="' . route('admin.patientlist.edit', $patient_id) . '"><i class="fa fa-pencil-alt"></i></a>' . ' ';
            $action .= '<a class="delete" onclick="return confirm_alert(`' . $delete_url . '`,`Are you sure you want to delete this patient ?`)"  href="#"><i class="fa fa-trash"></i>&nbsp;</a></div>';

            $sub[] = $action;
            $sub[] = $response[] = $sub;
        }

        $userjson = json_encode(["data" => $response]);
        echo $userjson;
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
        // dd($request->all());
        $this->validate($request, [
            'firstname' => 'required',
            'lastname'=>'required',
            'email' => 'required|unique:users',
          //  'email_address' => 'required',
            'mobile' => 'bail|required|numeric',
            'gender' => 'required',
            'patient_profile'=>'image'

        ],[

                    'firstname.required' => 'Please enter first name.',
                    'lastname.required' => 'Please enter last name.',
                    'email.required' => 'Please enter national id',
                    'email_address.required' => 'Please enter emailaddress',
                    'mobile.required' => 'Please enter mobile number',
                    'gender.required' => 'Please select gender',
                    'mobile.unique'=>'Mobile number has been already taken',
                    'mobile.digits'=>'Mobile number must be 10 digits long',
                    'patient_profile.image'=>'Please provide valid file type',
                    'email.unique'=>'Nationalid has been already taken'

        ]);

        if ($request->file('patient_profile')) {
            $image = $request->patient_profile;
            $path = $image->store('patient_profile');
        }
        if(!empty(request('date_of_birth'))){
            $dateOfBirth = request('date_of_birth');
            $today = date("Y-m-d");
            $diff = date_diff(date_create($dateOfBirth), date_create($today));
            $agecal = $diff->format('%y');
        }else{
            $agecal = 0;
        }
        $job_max_id = User::max('id');
        $emr_number = str_pad($job_max_id + 1, 7, '0', STR_PAD_LEFT);
        $masteradminsetting = MasterAdminSetting::where('id',1)->first();

        $patients = new User();
        $patients->first_name = $request->firstname;
        $patients->last_name = $request->lastname;
        $patients->email = $request->email;
        $patients->national_id = $request->email;
        $patients->age = $agecal;
        $patients->date_of_birth = $request->date_of_birth;
        $patients->mobile = $request->mobile;
        $patients->password = Hash::make(request('mobile'));
        $patients->gender = $request->gender;
        $patients->profile_pic = isset($path) ? $path : null;
        $patients->emr_number = $emr_number;
        $patients->wallet_money = $masteradminsetting->price;
        $patients->countrycode = request('countrycode');
        $patients->email_address = request('email_address');
        $patients->save();
        $patients->attachRole(3);
        try {
            // $patients->notify(new WelcomeUser($patients));
        } catch (Exception $e) {
        }
        return redirect()->route('admin.patientlist.index')
                      ->with(['success' => "Patient Added Successfully.", 'create_sinch_user' => $patients->mobile]);
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

        $id = Crypt::decryptString($id);

        $patients = $this->user->getById($id);

        $page = '/admin/patientlist';
        
         $code=CountryCodeIso::get();

        return view('admin.patientlist.create', compact('patients','page','code'));

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
        // dd($request->all());
        $this->validate($request, [
            'firstname' => 'required',
            'lastname'=>'required',
            // 'email' => 'required',
            // 'mobile' => 'bail|required|numeric|digits_between:8,12,mobile,'.$request->patient_id,
            'gender' => 'required',
            'patient_profile'=>'image',
            //'email_address' => 'required',

        ],[

                    'firstname.required' => 'Please enter first name.',
                    'lastname.required' => 'Please enter last name.',
                    // 'email.required' => 'Please enter national id',
                    'mobile.required' => 'Please enter mobile number',
                    'gender.required' => 'Please select gender',
                    'mobile.unique'=>'Mobile number has been already taken',
                    'mobile.digits'=>'Mobile number must be 9 digits long',
                    'patient_profile.image'=>'Please provide valid file type',
                    'email_address.required' => 'Please enter email_address',
        ]);




         if (isset($request->patient_profile)) {
            $image = $request->patient_profile;
            $path = $image->store('patient_profile');
        } else {
            $image = $request->hidden_image;
            $path = $image;
        }
        if($request->walletprice){
            $userdata = User::find($request->patient_id);
            $walletprice = $userdata->wallet_money + $request->walletprice;
            
            $payment_history = new Payment_history;
            $payment_history->user_id = $request->patient_id;
            $payment_history->user_id2 = auth()->user()->id;
            $payment_history->price = $request->walletprice;  // admin id
            $payment_history->message = 'Admin add wallet price '.$request->walletprice.'SAR';
            $payment_history->save();
            // dd($userdata->wallet_money);

        }else{
            $userdata = User::find($request->patient_id);
            $walletprice = $userdata->wallet_money;
        }

        if(!empty(request('date_of_birth'))){
            $dateOfBirth = request('date_of_birth');
            $today = date("Y-m-d");
            $diff = date_diff(date_create($dateOfBirth), date_create($today));
            $agecal = $diff->format('%y');
        }else{
            $agecal = 0;
        }
        // dd($walletprice);
        $update_attributes = array(
            'first_name' => $request->firstname,
            'last_name' => $request->lastname,
            'date_of_birth' => $request->date_of_birth,
            'mobile' => ltrim($request->mobile, '0'),
            'gender' => $request->gender,
            'age' => $agecal,
            'wallet_money' => $walletprice,
            'profile_pic'=>$path,
            'email_address'=> request('email_address'),
            'countrycode'=>request('countrycode'),
        );

        $user = $this->user->updateById($request->patient_id, $update_attributes);

        return redirect()->route('admin.patientlist.index')
                    ->with(self::SUCCESS, 'Patient updated successfully.');

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

        $patient_id = Crypt::decryptString($id);

        $patient_delete = $this->user->deleteById($patient_id);

        return redirect()->route('admin.patientlist.index')->with('success', 'Patient deleted successfully.');
    }

      public function changestatus($id, $status)
    {


        $id = Crypt::decryptString($id);

        $patient = $this->user->getById($id);

        $update_attributes = array('status' => $status);

        $doctor_update = $this->user->updateById($id, $update_attributes);

        if ($status == 1) {
            $msg = 'Patient is active successfully.';
            $message = 'Hello,Your E Clinic patient account has been activated. Now you can login into app.';
            $code='966';
            SmsAla::SendSms(isset($patient)?$patient->mobile:'',$message,$code);
        } elseif ($status == 0) {
            $msg = 'Patient is inactive successfully.';
        }

        return redirect()->route('admin.patientlist.index')->with('success', ucfirst($patient->name)." ".$msg);
    }
}
