<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyStatus extends Model
{
    //Datos solicitados por la tabla
    protected $fillable = ['property_status','inserted_by','updated_by'];

    //Relaciones con las otras tablas...
    public function property()
    {
        return $this->hasOne(Property::class);
    }

    
}
