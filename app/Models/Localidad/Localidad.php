<?php

namespace App\Models\Localidad;

use Illuminate\Database\Eloquent\Model;

class Localidad extends Model
{
    protected $table = 'localidades';
    
    protected $fillable = [
        'municipio_id',
        'clave',
        'nombre',
        'lat',
        'lng',
    ];

    public function municipio() {
        return $this->belongsTo('App\Models\Municipio\Municipio', 'municipio_id');
    }



}
