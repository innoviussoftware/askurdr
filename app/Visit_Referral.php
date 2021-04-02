<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visit_Referral extends Model
{
    //
    protected $table = 'visit_referral';

    protected $fillable = [
        'speciality_id','doctor_id','diagnosis','reason','doctor_name','speciality_name','patient_id','pdf'
    ];

    public function getAll()
    {
        return static::with('patient','doctor','speciality')->get();
    }

     public function getActive()
    {
        return static::where('status', 1)->get();
    }

    public function createRefreal(array $attributes)
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


    public function speciality()
    {
        return $this->belongsTo('App\Speciality','speciality_id','id');
    }

    public function patient()
    {
        return $this->belongsTo('App\User','patient_id','id');
    }

    public function doctor()
    {
        return $this->belongsTo('App\User','doctor_id','id');
    }


}
