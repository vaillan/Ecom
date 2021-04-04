<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Home extends Model
{
    protected $table = 'homes';
    //methods

    //one to many relation with coment model
    public function comments(){
        return $this->hasMany('App\Models\Comment');
    }

    //one to many relation with like model
    public function likes(){
        return $this->hasMany('App\Models\Like');
    }
 
    //many to one relation with address model
    public function address(){
        return $this->belongsTo('App\Address', 'addres_id');
    }

    //many to one relation with users model
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }

}
