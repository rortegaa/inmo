<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = ['country'];

    public function property()
    {
        return $this->hasOne(Property::class);
    }
}
