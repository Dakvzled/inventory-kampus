<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AddItem;
use App\Models\Borrowing;      // <--- PENTING: Panggil Model Borrowing
use Illuminate\Support\Facades\Auth; // <--- PENTING: Panggil Auth

class UserController extends Controller
{
    public function index()
    {
        $availableItems = AddItem::where('item_quantity', '>', 0)->count();
        return view('user.dashboard', compact('availableItems'));
    }

    public function catalog()
    {
        $items = AddItem::all();
        return view('user.catalog', compact('items'));
    }

    // ==========================================
    // LOGIKA PINJAM BARANG
    // ==========================================
    public function storePinjam(Request $request, $id)
    {
        // 1. Validasi Input User
        $request->validate([
            'amount' => 'required|integer|min:1',
            'start_date' => 'required|date|after_or_equal:today',
            'return_date' => 'required|date|after_or_equal:start_date',
        ]);

        // 2. Cari barang
        $item = AddItem::findOrFail($id);

        // 3. Cek apakah stok mencukupi permintaan user?
        if ($item->item_quantity >= $request->amount) {
            
            // 4. Simpan data peminjaman
            Borrowing::create([
                'user_id' => Auth::id(),
                'item_id' => $id,
                'status'  => 'pending',
                'amount'  => $request->amount,       // Simpan Jumlah
                'start_date' => $request->start_date, // Simpan Tgl Mulai
                'return_date' => $request->return_date // Simpan Tgl Kembali
            ]);

            // 5. Kurangi stok barang sesuai jumlah yang dipinjam
            $item->decrement('item_quantity', $request->amount);

            return redirect()->back()->with('success', 'Pengajuan berhasil dikirim! Menunggu persetujuan Admin.');
        }

        // Jika user minta lebih banyak dari stok yang ada
        return redirect()->back()->with('error', 'Stok tidak mencukupi permintaan Anda!');
    }
}