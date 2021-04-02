<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Investigation extends Model
{
    //
    protected $table = 'investigations';

    protected $fillable = [
        'testname_english','testname_arabic','type_id','type_name'
    ];

    public $timestamps = false;

     public function getAll()
    {
        return static::with('document_type')->get();
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

     public function visit_investigation()
    {
        return $this->HasMany('App\Labreport');
    }

    public function document_type()
    {
        return $this->belongsTo('App\DocumentType','type_id');
    }
}
