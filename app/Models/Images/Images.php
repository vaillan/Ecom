<?php

namespace App\Models\Images;

use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    protected $table = 'images';
    
    protected $fillable = [
        'post_client_id',
        'image',
    ];
}
