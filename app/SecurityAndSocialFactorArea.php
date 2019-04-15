<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SecurityAndSocialFactorArea extends Model
{
    protected $fillable = [
        'area_name','security','social_factor'
    ];

    public function localization()
    {
        return $this->morphMany(LocalizationArea::class, 'localizable');
    }

    public function securityAndSocialFactorPropertys()
    {
        return $this->morphToMany(Property::class,'areables');
    }
}
