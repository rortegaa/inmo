<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeOfInterestPoint extends Model
{
    protected $fillable = [
        'type_name'
    ];

    public function interestPoint()
    {
        return $this->hasOne(InterestPoint::class);
    }
}
