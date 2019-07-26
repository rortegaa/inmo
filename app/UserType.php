<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    //Datos requeridos por la tabla
    protected $fillable = ['user_type'];

    //Relacion con las demas tablas.
    public function user()
    {
        return $this->hasOne(User::class);
    }
}
