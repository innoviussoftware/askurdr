<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Labreport extends Model
{
    //
    protected $table = 'visit_investigation';

    protected $fillable = [
       'emr_id','investigation_id','investigation_name','note','patient_id','doctor_id','pdf','result','uploaded_by'
    ];

    public $timestamps = false;

     public function getAll()
    {
        return static::with('visit_investigation','patient','doctor')->get();
    }

     public function getActive()
    {
        return static::where('status', 1)->get();
    }

    public function createInvestigation(array $attributes)
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

    public function patient()
    {
        return $this->belongsTo('App\User','patient_id','id');
    }

    public function doctor()
    {
        return $this->belongsTo('App\User','doctor_id','id');
    }

     public function visit_investigation()
    {
        return $this->belongsTo('App\Investigation','investigation_id','id');
    }
}
