<?php

namespace App\Models\PostUsers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostUsers extends Model
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'post_user';
    
    protected $fillable = [
        'user_id',
        'budget_minimum',
        'budget_maximum',
        'init_date',
        'end_date',
        'divisa_budget_minimum',
        'divisa_budget_maximum',
        'description',
        'localidad_id',
    ];
    /**
     * Get the user that owns the comment.
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
    
    public function address() {
        return $this->hasOne('App\Models\Address\Address', 'post_user_id');
    }
}
