<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GeneralService extends Model
{
    protected $fillable = ['service'];

    public function belongsToManyProperty()
    {
        return $this->belongsToMany(Property::class);
    }
}
