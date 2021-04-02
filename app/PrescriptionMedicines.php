<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrescriptionMedicines extends Model
{
    //
    protected $table = 'prescription_medicines';

    protected $fillable = [
        'user_id','medicines_id','created_at','updated_at','p_id'
    ];

    public $timestamps = false;

    protected $casts = [
      'status'=>'integer'
    ];
    
    public function getAll()
    {
        return static::get();
    }



    public function getActive()
    {
        return static::where('status', 1)->get();
    }

    public function getAllWithpluck()
    {
        return static::where('status', 1)->orderBy('name', 'asc')->pluck('name', 'id')->toArray();
    }

    public function createPrescMedicines(array $attributes)
    {
        return static::create($attributes);
    }

    public function getById($id)
    {
        return static::where('id', $id)->first();
    }

    public function getByuserId($id)
    {
        return static::where('user_id', $id)->with('medicines')->get();
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

     public function medicines()
    {
        return $this->belongsTo('App\Medicine');
    }

     public function prescription()
    {
        return $this->belongsTo('App\Prescription','p_id');
    }
    
}
