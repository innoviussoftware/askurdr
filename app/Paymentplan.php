<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paymentplan extends Model
{
    //
    protected $table = 'paymentplan';
    
    protected $fillable = [
        'type','months','years','price','status','created_at','updated_at'
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

    public function createPackage(array $attributes)
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

    public function medicines()
    {
        return $this->HasMany('App\Visit_Prescription');
    }

  
}
