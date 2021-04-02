<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use Notifiable;
    use HasApiTokens;
    use EntrustUserTrait; // add this trait to your user model

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['first_name','ask_id','last_name','email','post_mail','password','mobile','gender','date_of_birth','profile_pic','device_id','status','remember_token','language','insuarance_company_name','insurance_policy_no','description','emr_number','created_at','updated_at','start_time','end_time','is_insurance','payment_type','paymentdetails_id','insurance_id', 'sinch_ticket','countrycode'
                    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'date_of_birth'=>'string',
        'status'=>'integer',
    ];

    public $timestamps = false;

    public function createUser(array $attributes)
    {
        return static::create($attributes);
    }

    public function getAll()
    {
        return static::all();
    }

    public function getById($id)
    {
        return static::where('id', $id)->with('roles')->first();
    }

    public function getBykeyid($id)
    {
        return static::where('ask_id', $id)->get();
    }

    public function updateById($id, array $attributes)
    {
        if (count($attributes) == 1) {
            if (isset($attributes['is_delete'])) {
                return static::whereId($id)->delete();
            }
        }
        $attributes['updated_at'] = date('Y-m-d h:i:s');
        return static::where('id', $id)->update($attributes);
    }

    public function deleteById($id)
    {
        return static::where('id', $id)->delete();
    }

    public function clinic()
    {
        return $this->HasMany('App\DoctorClinic','user_id','id');
    }
    public function booking_slot()
    {
        return $this->HasMany('App\DoctorBooking','doctor_id')->whereDate('date', '=', date('Y-m-d'));
    }
    public function education()
    {
        return $this->HasMany('App\DoctorEducation','user_id','id');
    }

    public function experience()
    {
        return $this->HasMany('App\DoctorExperience','user_id','id');
    }

    public function speciality()
    {
        return $this->HasMany('App\DoctorSpeciality','user_id','id');
    }

    public function prescription()
    {
        return $this->HasMany('App\Prescription');
    }

    public function referal()
    {
        return $this->HasMany('App\Visit_Referral');
    }

    public function doctoravailability()
    {
        return $this->HasMany('App\DoctorAvailability','doctor_id');
    }

    public function patientavailability()
    {
        return $this->HasMany('App\DoctorAvailability','patient_id');
    }

    public function paymentdetails()
    {
        return $this->belongsTo('App\Payment_details','paymentdetails_id')->with('paymentplan');
    }

    public function paymentuser()
    {
        return $this->HasOne('App\Payment_details');
    }

    public function packages()
    {
        return $this->belongsTo('App\Paymentplan');
    }

    public function chats()
    {
        return $this->belongsToMany('App\Chat');
    }


     public function days()
    {
        return $this->HasMany('App\DoctorDays','user_id','id');
    }


}
