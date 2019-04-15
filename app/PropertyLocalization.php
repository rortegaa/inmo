<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyLocalization extends Model
{
    protected $fillable = [
        'property_id','latitude','length','address'
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
