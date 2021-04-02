<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chathistory extends Model
{

	protected $table = 'call_history';
    protected $fillable = [
        'userid', 'doctor_id','calltype','total_call_time',
    ];
}
