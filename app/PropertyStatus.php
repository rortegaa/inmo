<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyStatus extends Model
{
    protected $fillable = ['property_status'];

    public function property()
    {
        return $this->hasOne(Property::class);
    }
}
