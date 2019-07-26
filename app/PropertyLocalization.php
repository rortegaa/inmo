<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyLocalization extends Model
{
    //Atributos solicitados por la tabla.
    protected $fillable = [
        'property_id','latitude','length','address'
    ];

    //Relaciones con las otras tablas..
    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
