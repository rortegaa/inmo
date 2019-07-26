<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyInformation extends Model
{
    //Datos requeridos por la tabla.
    protected $fillable = [
        'property_id','bedrooms','bathrooms','parking_lots',
        'antiquity','price','price_per_area','maintenance',
        'area','total_area_lot','sale_message'
    ];

    //Relaciones con las otras tablas...
    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
