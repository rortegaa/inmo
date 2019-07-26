<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GeneralService extends Model
{
    //Datos requeridos para la tabla
    protected $fillable = ['service'];

    //Relacion con las demas tablas
    public function belongsToManyProperty()
    {
        return $this->belongsToMany(Property::class);
    }
}
