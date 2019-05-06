<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyInformation extends Model
{
    protected $fillable = [
        'property_id','bedrooms','bathrooms','parking_lots',
        'antiquity','price','price_per_area','maintenance',
        'area','total_area_lot','sale_message'
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
