<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
    use HasFactory;

    protected $table = 'borrowings';

    protected $fillable = [
        'user_id',
        'item_id',
        'status',
        'amount',      // Tambahan
        'start_date',  // Tambahan
        'return_date', // Tambahan
    ];

    // Relasi: Peminjaman milik satu User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi: Peminjaman terkait satu Barang (AddItem)
    public function item()
    {
        return $this->belongsTo(AddItem::class, 'item_id');
    }
}