<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LocalizationArea extends Model
{
    //Datos reqeridos por la tabla
    protected $fillable = [
        'latitude','length'
    ];
    
    //Relacion con las demas tablas
    public function areable()
    {
        return $this->morphTo();
    }
}
