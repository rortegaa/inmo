<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyLegalStatus extends Model
{
    //Atributos solicitados por la tabla
    protected $fillable = ['property_legal_status','inserted_by','updated_by'];

    //Relaciones con las otras tablas...
    public function property()
    {
        return $this->hasOne(Property::class);
    }
}
