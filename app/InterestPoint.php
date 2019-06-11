<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InterestPoint extends Model
{
    protected $filleable = [
        "type_of_interest_point_id", "latitude", "length"
    ];


    public function typeOfInterestPoint()
    {
        return $this->belongsTo(TypeOfInterestPoint::class);
    }
}
