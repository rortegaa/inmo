<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    //Datos requeridos para la tabla.
    protected $fillable = ['state','inserted_by','updated_by'];

    //Relaciones con las demas tablas.
    public function property()
    {
        return $this->hasOne(Property::class);
    }
}
