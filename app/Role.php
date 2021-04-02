<?php
namespace App;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    protected $table = 'roles';
    protected $fillable = [
        'name','display_name','description','status'
    ];

    public $timestamps = false;
    protected $casts = [
      'status'=>'integer'
    ];
    public function getAll()
    {
        return static::whereNotIn('id', [4,5,6])->get();
    }

    public function getById($id)
    {
        return static::where('id', $id)->first();
    }

    public function createRole(array $attributes)
    {
        return static::create($attributes);
    }

    public function updateById($id, array $attributes)
    {
        $attributes['updated_at'] = date('Y-m-d h:i:s');
        return static::where('id', $id)->update($attributes);
    }

    public function getAllWithpluck()
    {
        return static::pluck('display_name', 'id')->toArray();
    }

    public function deleteById($id)
    {
        return static::where('id', $id)->delete();
    }
}
