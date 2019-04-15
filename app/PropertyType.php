<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyType extends Model
{
    protected $fillable = ['property_type'];

    public function property()
    {
        return $this->hasOne(Property::class);
    }
}
