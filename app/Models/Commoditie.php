<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commoditie extends Model
{
    //
    protected $fillable = ['name', 'category', 'unit'];
    public function prices()
    {
        return $this->hasMany(Price::class);
    }
}
