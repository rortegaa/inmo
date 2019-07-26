<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RealEstate extends Model
{
    //Datos requeridos por la tabla.
    protected $fillable = [
        'name','phone','email','password','address'
    ];

    //Relacion con las otras tablas.
    public function propertys()
    {
        return $this->hasMany(Property::class);
    }
}
