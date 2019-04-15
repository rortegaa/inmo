<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LocalizationArea extends Model
{
    protected $fillable = [
        'latitude','length'
    ];
    
    public function areable()
    {
        return $this->morphTo();
    }
}
