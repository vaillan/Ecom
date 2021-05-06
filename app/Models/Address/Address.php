<?php

namespace App\Models\Address;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    
      /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'address';

    protected $fillable = [
        'user_id',
        'post_user_id',
        'post_client_id',
        'clave',
        'estado',
        'localidad',
        'municipio',
        'address',
    ];
    /**
     * Get the address that owns the comment.
     */
}
