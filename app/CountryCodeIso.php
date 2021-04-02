<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CountryCodeIso extends Model
{
    //
    protected $table = 'country';
    protected $fillable = [
        'iso','name','nicename','iso3','numcode','phonecode'
    ];
}
