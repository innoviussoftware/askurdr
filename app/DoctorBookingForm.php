<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DoctorBookingForm extends Model
{
    protected $table = 'doctor_booking_form';
    protected $fillable = [
        'patient_id','doctor_id','reason','description','report_file','report','created_at','updated_at','from_where','booking_id'
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

    public function createDoctorBookingForm(array $attributes)
    {
        return static::create($attributes);
    }

    public function getById($id)
    {
        return static::where('id', $id)->first();
    }

    public function updateById($id, array $attributes)
    {
        return static::where('id', $id)->update($attributes);
    }

    public function deleteById($id)
    {
        return static::where('id', $id)->delete();
    }

    public function previsitDetails()
    {
        return $this->hasone('App\EmrDetails','doctorbookingform_id');
    }

    
}
