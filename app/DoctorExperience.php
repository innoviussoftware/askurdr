<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DoctorExperience extends Model
{
    protected $table = 'doctor_experience';
    protected $fillable = [
        'hospital_name','position','year','user_id','created_at','updated_at'
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function getAll()
    {
        return static::get();
    }

    public function createDoctorExperience(array $attributes)
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
