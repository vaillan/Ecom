<?php

namespace App\Models\Mexico_address;

use Illuminate\Database\Eloquent\Model;

class Mexico_address extends Model
{
    protected $table = 'mexico_address';

    protected $fillable = [
        'country',
        'capital',
        'city',
    ];

}
