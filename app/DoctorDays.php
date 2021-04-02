<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DoctorDays extends Model
{
    //
    protected $table = 'doctor_days';

    protected $fillable = [
        'user_id','days','available','created_at','updated_at','start_time','end_time'
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

    public function createDoctordays(array $attributes)
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
