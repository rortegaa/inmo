<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SecurityAndSocialFactorArea extends Model
{
    //Datos solicitados para la tabla.
    protected $fillable = [
        'area_name','security','social_factor'
    ];


    //Relaciones con las otras tablas.
    public function localization()
    {
        return $this->morphMany(LocalizationArea::class, 'localizable');
    }

    public function securityAndSocialFactorPropertys()
    {
        return $this->morphToMany(Property::class,'areables');
    }
}
