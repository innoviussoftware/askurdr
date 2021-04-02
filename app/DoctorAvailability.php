<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DoctorAvailability extends Model
{
    //
    protected $table = 'doctor_availability';
    protected $fillable = [
        'doctor_id','status','patient_id'
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

    public function createDoctorBooking(array $attributes)
    {
        return static::create($attributes);
    }

    public function getById($id)
    {
        return static::where('id', $id)->first();
    }

    public function updateById($id, array $attributes)
    {
        $attributes['updated_at'] = date('Y-m-d h:i:s');
        return static::where('id', $id)->update($attributes);
    }

    public function deleteById($id)
    {
        return static::where('id', $id)->delete();
    }
}
