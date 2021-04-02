<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DoctorWallet extends Model
{
    protected $table = 'doctor_wallet_history';

    protected $fillable = [
        'doctor_id','commission'
    ];
}
