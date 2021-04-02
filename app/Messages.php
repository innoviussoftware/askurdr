<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    //

    public $primarykey = 'id';

    protected $table='messages';

     protected $fillable = [
        'id','receiver_id', 'sender_id'
    ];

    protected $casts = ['id' => 'string'];
}
