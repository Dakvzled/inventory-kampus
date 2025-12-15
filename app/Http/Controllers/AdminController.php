<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\AddItem; 
use App\Models\Borrowing;

class AdminController extends Controller
{
    // ==========================================
    // 1. FUNGSI DASHBOARD (INI YANG WAJIB ADA)
    // ==========================================
    public function dashboard()
    {
        // Hitung data statistik
        $totalItems = AddItem::count();
        $totalCategories = Category::count();
        $totalStock = AddItem::sum('item_quantity');
        
        // Ambil 5 barang terbaru
        $recentItems = AddItem::latest()->take(5)->get();

        // Pastikan view mengarah ke 'admin.dashboard'
        // (Sesuai struktur folder Anda: resources/views/admin/dashboard.blade.php)
        return view('admin.dashboard', compact('totalItems', 'totalCategories', 'totalStock', 'recentItems'));
    }

    // ==========================================
    // 2. MANAJEMEN BARANG (ITEM)
    // ==========================================
    public function viewItem()
    {   
        $items = AddItem::all(); 
        return view('admin.viewitem', compact('items')); 
    }

    public function addItem()
    {
        $categories = Category::all();
        return view('admin.additem', compact('categories'));
    }

    public function postAddItem(Request $request)
    {
        $request->validate([
            'item_name' => 'required',
            'item_quantity' => 'required|integer',
            'item_image' => 'required|image|max:2048',
            'category_name' => 'required',
        ]);

        $item = new AddItem();
        $item->item_name = $request->item_name;
        $item->item_quantity = $request->item_quantity;
        $item->category_name = $request->category_name;

        if ($request->hasFile('item_image')) {
            $image = $request->file('item_image');
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $image->move('item_images', $imagename);
            $item->item_image = $imagename;
        }

        $item->save();
        return redirect()->back()->with('success', 'Item berhasil ditambahkan!');
    }

    public function editItem($id)
    {
        $item = AddItem::findOrFail($id);
        $categories = Category::all();
        return view('admin.edititem', compact('item', 'categories'));
    }

    public function updateItem(Request $request, $id)
    {
        $item = AddItem::findOrFail($id);
        $item->item_name = $request->item_name;
        $item->item_quantity = $request->item_quantity;
        $item->category_name = $request->category_name;

        if ($request->hasFile('item_image')) {
            $oldPath = public_path('item_images/' . $item->item_image);
            if(file_exists($oldPath)) @unlink($oldPath);

            $image = $request->file('item_image');
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $image->move('item_images', $imagename);
            $item->item_image = $imagename;
        }

        $item->save();
        return redirect()->route('admin.viewitem')->with('success', 'Item berhasil diupdate!');
    }

    public function deleteItem($id)
    {
        $item = AddItem::findOrFail($id);
        $imagePath = public_path('item_images/' . $item->item_image);
        if(file_exists($imagePath)) @unlink($imagePath);
        
        $item->delete();
        return redirect()->back()->with('success', 'Item berhasil dihapus');
    }

    // ==========================================
    // 3. MANAJEMEN KATEGORI
    // ==========================================
    public function viewCategory()
    {
        $categories = Category::all();
        return view('admin.viewcategory', compact('categories'));
    }

    public function addCategory()
    {
        return view('admin.addcategory');
    }

    public function postAddCategory(Request $request)
    {
        $category = new Category();
        $category->category_name = $request->category_name;
        $category->save();
        return redirect()->back()->with('success', 'Kategori ditambahkan');
    }

    public function updateCategory($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.updatecategory', compact('category'));
    }

    public function postUpdateCategory(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->category_name = $request->category_name;
        $category->save();
        return redirect()->route('admin.viewcategory')->with('success', 'Kategori diupdate');
    }

    public function deleteCategory($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->back()->with('success', 'Kategori dihapus');
    }

    public function borrowings()
    {
        // Ambil data peminjaman, urutkan dari yang terbaru
        // Kita pakai 'with' agar data user dan item ikut terbawa
        $borrowings = Borrowing::with(['user', 'item'])->latest()->get();
        
        return view('admin.borrowings', compact('borrowings'));
    }

    // Aksi 1: Menyetujui Peminjaman
    public function approveBorrowing($id)
    {
        $borrowing = Borrowing::findOrFail($id);
        
        // Ubah status jadi 'approved' (Disetujui)
        $borrowing->status = 'approved';
        $borrowing->save();

        return redirect()->back()->with('success', 'Peminjaman disetujui! Barang boleh diambil.');
    }

    // Aksi 2: Menyelesaikan Peminjaman (Barang Dikembalikan)
    public function returnBorrowing($id)
    {
        $borrowing = Borrowing::findOrFail($id);
        
        // Ubah status jadi 'returned' (Dikembalikan)
        $borrowing->status = 'returned';
        $borrowing->save();

        // Kembalikan stok barang (+1)
        $item = $borrowing->item;
        $item->increment('item_quantity');

        return redirect()->back()->with('success', 'Barang telah dikembalikan. Stok bertambah.');
    }
    // ... fungsi approveBorrowing dan returnBorrowing yang sudah ada ...

    // Aksi 3: Menolak Peminjaman
    public function rejectBorrowing($id)
    {
        $borrowing = Borrowing::findOrFail($id);
        
        // 1. Ubah status jadi 'rejected'
        $borrowing->status = 'rejected';
        $borrowing->save();

        // 2. KEMBALIKAN STOK BARANG (Penting!)
        // Kita pakai kolom 'amount' yang sudah dibuat sebelumnya
        $item = $borrowing->item;
        $item->increment('item_quantity', $borrowing->amount);

        return redirect()->back()->with('success', 'Pengajuan ditolak. Stok barang telah dikembalikan.');
    }
}