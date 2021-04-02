<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{

	
    protected $fillable = [
        'user_id1', 'user_id2', 'message','c_datetime','doctor_name','doctor_pic',
    ];
}
