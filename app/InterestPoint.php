<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InterestPoint extends Model
{
    //Atributos requeridos para la tabla 
    protected $filleable = [
        "type_of_interest_point_id", "latitude", "length"
    ];

    //Relacion con las demas tablas...
    public function typeOfInterestPoint()
    {
        return $this->belongsTo(TypeOfInterestPoint::class);
    }
}
