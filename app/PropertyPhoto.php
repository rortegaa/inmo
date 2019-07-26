<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyPhoto extends Model
{
    //Datos solicitados por la tabla
    protected $fillable = ['property_id','url'];

    //Relaciones con las otras tablas...
    public function property()
    {
        return $this->belongsTo(Property::class);
    }


}
