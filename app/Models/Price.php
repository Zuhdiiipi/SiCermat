<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    //
    protected $table = 'prices';
    protected $fillable = [
        'commodity_id',
        'region_id',
        'user_id',
        'price',
        'date',
        'type_price',
    ];

    protected $casts = [
        'date' => 'date',
    ];


    // Price.php
    public function commodity()
    {
        // return $this->belongsTo(Commoditie::class);
        return $this->belongsTo(Commoditie::class, 'commodity_id');
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
