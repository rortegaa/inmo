<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PopulationFactor extends Model
{
    protected $fillable = ['population'];

    public function localization()
    {
        return $this->morphMany(LocalizationArea::class, 'localizable');
    }

    public function populationFactorPropertys()
    {
        return $this->morphToMany(Property::class,'areables');
    }

   
}
