<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyLegalStatus extends Model
{
    protected $fillable = ['property_legal_status','inserted_by','updated_by'];

    public function property()
    {
        return $this->hasOne(Property::class);
    }
}
