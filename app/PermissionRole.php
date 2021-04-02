<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PermissionRole extends Model
{
    protected $table = 'permission_role';
    protected $fillable = [
        'permission_id','role_id'
    ];

    public $timestamps = false;
    protected $casts = [
      'permission_id' => 'integer','role_id'=>'integer'
    ];
    public function permission()
    {
        return $this->belongsTo('App\Permission');
    }

    public function createpermission(array $attributes)
    {
        return static::create($attributes);
    }

    public function getAllWithpluck($id)
    {
        return static::where('role_id', $id)->pluck('permission_id')->toArray();
    }

    public function getAllWithPermission($id)
    {
        return static::with('permission')->where('role_id', $id)->get();
    }

    public function getAll()
    {
        return static::get();
    }

    public function getById($id)
    {
        return static::where('id', $id)->first();
    }

    public function countById($role_id, $permission_id)
    {
        return static::where('role_id', $role_id)->where('permission_id', $permission_id)->count();
    }

    public function getByRoleId($id)
    {
        return static::where('role_id', $id)->first();
    }

    public function deleteById($id)
    {
        return static::where('role_id', $id)->delete();
    }
}
