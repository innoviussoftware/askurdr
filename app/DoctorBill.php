<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DoctorBill extends Model
{
    protected $table = 'doctor_bill';

    protected $fillable = [
        'patient_id','doctor_id','clinic_id','doctor_fees','discount_fees','vat_fees'
    ];
}
