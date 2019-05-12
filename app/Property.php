<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $fillable = [
        'property_type_id','property_status_id',
        'property_legal_status_id','state_id','userable_type','userable_id'
    ];

    public function propertyInformation()
    {
        return $this->hasOne(PropertyInformation::class);
    }

    public function propertyLocalization()
    {
        return $this->hasOne(PropertyLocalization::class);
    }

    public function propertyPhotos()
    {
        return $this->hasMany(PropertyPhoto::class);
    }

    public function propertyState()
    {
        return $this->belongsTo(State::class);
    }

    public function propertyStatus()
    {
        return $this->belongsTo(PropertyStatus::class);
    }

    public function propertyLegalStatus()
    {
        return $this->belongsTo(PropertyLegalStatus::class);
    }

    public function propertyType()
    {
        return $this->belongsTo(PropertyType::class);
    }

    public function floodAreas()
    {
        return $this->morphedByMany(FloodArea::class,'areables');
    }

    public function securityAndSocialFactor()
    {
        return $this->morphedByMany(SecurityAndSocialFactorArea::class,'areables');
    }

    public function populationFactor()
    {
        return $this->morphedByMany(PopulationFactor::class,'areables');
    }

    public function propertyServices()
    {
        return $this->belongsToMany(GeneralService::class);
    }
}
