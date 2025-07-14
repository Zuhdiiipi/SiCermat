<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('commodity_id')->constrained('commodities');
            $table->foreignId('region_id')->constrained('regions');
            $table->foreignId('user_id')->constrained('users');
            $table->date('date');
            $table->enum('type_price', ['produsen', 'konsumen', 'pedagang_besar']);
            $table->decimal('price',8,2);   
            $table->timestamps();

            $table->unique(['commodity_id', 'region_id', 'date', 'type_price'], 'unique_price_entry');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prices');
    }
};
