<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FloodArea extends Model
{
    protected $fillable = ['flood_area'];

    public function localizationArea()
    {
        return $this->morphMany(LocalizationArea::class, 'localizable');
    }

    public function floodAreaPropertys()
    {
        return $this->morphToMany(Property::class,'areables');
    }
}
