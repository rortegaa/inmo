<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyLegalStatus extends Model
{
    protected $fillable = ['property_legal_status'];

    public function property()
    {
        return $this->hasOne(Property::class);
    }
}
