<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
class Visit_Investigation extends Model
{
    //

    protected $table = 'visit_investigation';

    protected $fillable = [
        'investigation_id','note','investigation_name','doctor_id','patient_id','status','result','pdf','uploaded_by'
    ];

    public function emrDetails()
    {
        return $this->belongsTo('App\EmrDetails','id');
    }

    public function patient()
    {
        return $this->belongsTo('App\User','patient_id','id');
    }

     public function doctor()
    {
        return $this->belongsTo('App\User','doctor_id','id');
    }

     public function uploadBy()
    {
        return $this->belongsTo('App\User','uploaded_by','id');
    }

     public function investigation()
    {
        return $this->belongsTo('App\Investigation','investigation_id');
    }

     public function updateById($id, array $attributes)
    {
        $attributes['updated_at'] = date('Y-m-d h:i:s');
        return static::where('id', $id)->update($attributes);
    }
    
    
    


}
