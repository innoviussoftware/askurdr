<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterAdminSetting extends Model
{
    protected $table = 'master_admin_setting';
    protected $fillable = [
        'email','mobile','description'
    ];

    
    public function getAll()
    {
        return static::get();
    }

    public function updateById($id, array $attributes)
    {
        $attributes['updated_at'] = date('Y-m-d h:i:s');
        return static::where('id', $id)->update($attributes);
    }

}
