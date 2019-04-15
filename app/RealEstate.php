<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RealEstate extends Model
{
    protected $fillable = [
        'name','phone','email','password','address'
    ];

    public function propertys()
    {
        return $this->hasMany(Property::class);
    }
}
