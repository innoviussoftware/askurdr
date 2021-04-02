<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Speciality extends Model
{
    protected $table = 'speciality';
    protected $fillable = [
        'name','status','created_at','updated_at'
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

    public function createSpeciality(array $attributes)
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

    public function referal()
    {
        return $this->HasMany('App\Referal');
    }

    public function visit_referal()
    {
        return $this->HasMany('App\Visit_Referral');
    }
}
