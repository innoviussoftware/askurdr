<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visit_Data_Prescription extends Model
{
    //
    protected $table = 'visit_data_prescription';

    protected $fillable = [
        'medicine_id','dose','duration','route','strength','medicine_name','status','result','unit','frequency','frequency2','frequency3'
    ];


    //public $timestamps = false;

    protected $casts = [
      'status'=>'integer'
    ];
    
    public function getAll()
    {
        return static::with('patient','doctor','medicine')->get();
    }

    public function getActive()
    {
        return static::where('status', 1)->get();
    }

    public function getAllWithpluck()
    {
        return static::where('status', 1)->orderBy('name', 'asc')->pluck('name', 'id')->toArray();
    }

    public function createSpeciality(array $attributes)
    {
        return static::create($attributes);
    }

    public function getById($id)
    {
        return static::where('id', $id)->first();
    }

    public function getbywithuser($id)
    {
        return static::where('user_id', $id)->with('user')->get();
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

    public function medicine()
    {
        return $this->belongsTo('App\Medicine','medicine_id','id');
    }

      public function clinic()
    {
        return $this->belongsTo('App\DoctorClinic','doctor_id','user_id');
    }
}	

