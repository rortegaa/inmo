<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    protected $fillable = ['user_type'];

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
