<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category; // <--- WAJIB ADA BARIS INI

class AddItem extends Model
{
    use HasFactory;

    // Nama tabel di database (sesuai yang Anda bilang 'additems')
    protected $table = 'additems'; 
    
    protected $guarded = [];

    /**
     * RELASI (JEMBATAN)
     * Kode inilah yang mengubah Angka "2" menjadi "Perangkat Elektronik"
     */
    public function category()
    {
        // Parameter 2: Nama kolom di tabel additems (yang isinya angka 2, 4)
        // Parameter 3: Nama kolom di tabel categories (id)
        return $this->belongsTo(Category::class, 'category_name', 'id');
    }
}