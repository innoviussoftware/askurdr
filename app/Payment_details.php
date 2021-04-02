<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment_details extends Model
{
    //
    protected $table = 'payment_detail';
    
    protected $fillable = [
        'user_id','package_id','type','insurance_photo','payment_status','plan_startdate','plan_enddate','insurance_number','insurance_name','transaction_id','order_id'
    ];

    

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

    public function users()
    {
        return $this->hasOne('App\User');
    }

    public function paymentplan()
    {
        return $this->belongsTo('App\Paymentplan','package_id');
    }

    
}
