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
        Schema::create('additems', function (Blueprint $table) {
            $table->id();
            
            // FIX 1: Ubah $table->item_name() menjadi $table->string('item_name')
            // Laravel tidak punya fungsi item_name(), harus pakai tipe data (string).
            $table->string('item_name');
            $table->string('item_image');
            $table->integer('item_quantity');
            $table->string('category_name');
            $table->timestamps();
        }); // FIX 2: Penutup yang benar adalah }); bukan }};
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('additems');
    }
};
