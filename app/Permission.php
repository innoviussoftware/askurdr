<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'permissions';
    protected $fillable = [
        'name','display_name','description','parent_id','created_at','updated_at'
    ];

    public $timestamps = false;
    protected $casts = [
      'parent_id' => 'integer'
    ];
    public function getAll()
    {
        return static::get();
    }

    public function getAllWithpluck()
    {
        return static::orderBy('id', 'asc')->pluck('name', 'id')->toArray();
    }

    public function getById($id)
    {
        return static::where('id', $id)->first();
    }
}
