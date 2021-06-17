<?php

namespace App\Models\PostClient;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostClient extends Model
{
    use Notifiable;
    use SoftDeletes;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'post_client';
    
    protected $fillable = [
    'user_id',
    'description',
    'services',
    'sale_status',
    'rent_status',
    'rent_status_by',
    'post_client_status',
    'price',
    ];
}
