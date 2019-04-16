<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $fillable = ['state'];

    public function property()
    {
        return $this->hasOne(Property::class);
    }
}
