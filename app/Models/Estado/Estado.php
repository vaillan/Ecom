<?php

namespace App\Models\Estado;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $table = 'estados';
    
    protected $fillable = [
        'clave',
        'nombre',
        'abrev',
    ];

    public function municipio() {
        return $this->hasMany('App\Models\Municipios\Municipios', 'estado_id');
    }



}
