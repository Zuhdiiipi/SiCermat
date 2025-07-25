<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commoditie extends Model
{
    //
    protected $table = 'commodities';
    protected $fillable = ['name', 'category', 'unit','image'];
    public function prices()
    {
        return $this->hasMany(Price::class, 'commodity_id');
    }
}
