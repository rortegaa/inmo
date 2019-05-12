<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $fillable = ['state','inserted_by','updated_by'];

    public function property()
    {
        return $this->hasOne(Property::class);
    }
}
