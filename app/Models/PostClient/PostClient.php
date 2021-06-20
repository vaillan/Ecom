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
    'type_post',
    'type_cost',
    'post_client_status',
    'price',
    'divisa',
    ];
    /**
     * Get the user that owns the comment.
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
    
    public function address() {
        return $this->hasOne('App\Models\Address\Address', 'post_client_id');
    }
}
