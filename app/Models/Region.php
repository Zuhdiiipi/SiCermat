<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    //
    protected $table = 'regions'; // opsional kalau nama tabel sesuai konvensi

    protected $fillable = ['name'];

    // Relasi ke data harga (Price), diasumsikan satu region punya banyak harga
    public function prices()
    {
        return $this->hasMany(Price::class);
    }
}
