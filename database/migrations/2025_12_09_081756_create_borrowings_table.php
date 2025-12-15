<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('borrowings', function (Blueprint $table) {
            $table->id();
            // Menyimpan ID User (peminjam)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Menyimpan ID Barang (add_items adalah nama tabel dari model AddItem)
            $table->foreignId('item_id')->constrained('additems')->onDelete('cascade');
            
            // Status peminjaman
            $table->string('status')->default('pending'); 
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('borrowings');
    }
};