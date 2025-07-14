<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    //

    // Price.php
    public function commodity()
    {
        return $this->belongsTo(Commoditie::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }
}
