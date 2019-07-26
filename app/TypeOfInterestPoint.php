<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeOfInterestPoint extends Model
{
    //Datos requeridos por la tabla.
    protected $fillable = [
        'type_name'
    ];

    //Relacion con las demas tablas.
    public function interestPoint()
    {
        return $this->hasOne(InterestPoint::class);
    }
}
