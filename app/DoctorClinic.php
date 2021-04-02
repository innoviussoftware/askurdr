<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DoctorClinic extends Model
{
    protected $table = 'doctor_clinic';
    protected $fillable = [
        'clinic_id','user_id','created_at','updated_at'
    ];

    public $timestamps = false;

    public function clinic()
    {
        return $this->belongsTo('App\Clinic');
    }

    public function visit_Prescription()
    {
        return $this->HasMany('App\Visit_Prescription');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function getAll()
    {
        return static::get();
    }

    public function createDoctorClinic(array $attributes)
    {
        // dd($attributes);
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
