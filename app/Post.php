<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'posts';

    public function images()
    {
        return $this->hasMany('App\Image', 'post_id');
    }

    public function likes(){
        return $this->hasMany('App\Like', 'post_id');
    }

    public function address(){
        return $this->hasOne('App\Address', 'post_id');
    }
    public function comments()
    {
        return $this->hasMany('App\Comment', 'post_id');
    }
}
