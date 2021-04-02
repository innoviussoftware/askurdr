<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VideoCallDocumentDetail extends Model
{
    protected $table = 'videocall_document';
    protected $fillable = [
        'from_id','to_id','call_id','document','created_at','updated_at'
    ];

    public function from_user()
    {
        return $this->belongsTo('App\User','from_id','id');
    }

    public function to_user()
    {
        return $this->belongsTo('App\User','to_id','id');
    }

    public function getAll()
    {
        return static::get();
    }

    public function getById($id)
    {
        return static::where('id', $id)->first();
    }

    public function updateById($id, array $attributes)
    {
        return static::where('id', $id)->update($attributes);
    }

    public function deleteById($id)
    {
        return static::where('id', $id)->delete();
    }
}
