<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PopulationFactor extends Model
{
    //Datos requeridos por las tablas.
    protected $fillable = ['population'];

    //Relacion de la tabla con las otras tablas.
    public function localization()
    {
        return $this->morphMany(LocalizationArea::class, 'localizable');
    }

    public function populationFactorPropertys()
    {
        return $this->morphToMany(Property::class,'areables');
    }

   
}
