<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FloodArea extends Model
{
    //Informacion requerida por la tabla
    protected $fillable = ['flood_area'];

    //Relacion con las demas tablas.
    public function localizationArea()
    {
        return $this->morphMany(LocalizationArea::class, 'localizable');
    }

    public function floodAreaPropertys()
    {
        return $this->morphToMany(Property::class,'areables');
    }
}
