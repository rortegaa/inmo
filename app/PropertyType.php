<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyType extends Model
{
    //Datos requeridos por la tabla
    protected $fillable = ['property_type','inserted_by','updated_by'];

    //Relaciones con las demas tablas
    public function property()
    {
        return $this->hasOne(Property::class);
    }
}
