<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClinicWalletHistory extends Model
{
    protected $table = 'clinic_wallet_history';

    protected $fillable = [
        'clinic_id','commission','doctor_id'
    ];
}
