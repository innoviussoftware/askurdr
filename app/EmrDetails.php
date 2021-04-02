<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmrDetails extends Model
{
    //

    protected $table = 'emrdetails';

    protected $fillable = [
        'type_visit','patient_id','emr_no','physican_diagonis_id','created_at','updated_at','physican_note','visit_status','doctorbookingform_id','doctor_id'
    ];

    public function patient()
    {
        return $this->belongsTo('App\User','patient_id','id');
    }

    public function doctor()
    {
        return $this->belongsTo('App\User','doctor_id','id');
    }

    public function getAll()
    {
        return static::get();
    }

    public function createEmrDetails(array $attributes)
    {
        return static::create($attributes);
    }

    public function getById($id)
    {
        return static::where('patient_id', $id)->first();
    }

    public function updateById($id, array $attributes)
    {
        return static::where('id', $id)->update($attributes);
    }

    public function deleteById($id)
    {
        return static::where('id', $id)->delete();
    }


    public function investigation()
    {
        return $this->HasMany('App\Visit_Investigation','emr_id');
    }

    public function prescription()
    {
        return $this->HasMany('App\Visit_Data_Prescription','emr_id');
    }

    public function refrerral()
    {
        return $this->HasMany('App\Visit_Referral','emr_id');
    }

    public function doctorbooking()
    {
        return $this->belongsTo('App\DoctorBookingForm','doctorbookingform_id','id');
    }

}
