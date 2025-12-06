<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\AddItem; // Pastikan nama file modelnya AddItem.php

class AdminController extends Controller
{
    // ... (Kode bagian Kategori biarkan saja seperti sebelumnya) ...
    // Saya hanya menulis ulang bagian Category untuk kelengkapan konteks jika Anda copy-paste semua
    
    public function viewCategory()
    {
        $categories = Category::all();
        return view('admin.viewcategory', compact('categories'));
    }

    public function addCategory()
    {
        return view('admin.addCategory');
    }

    public function postAddCategory(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:255|unique:categories,category_name',
        ]);
        $category = new Category();
        $category->category_name = $request->category_name;
        $category->save();
        return redirect()->back()->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function updateCategory($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.updatecategory', compact('category'));
    }

    public function postUpdateCategory(Request $request, $id)
    {
        $request->validate([
            'category_name' => 'required|string|max:255|unique:categories,category_name,'.$id,
        ]);
        $category = Category::findOrFail($id);
        $category->category_name = $request->category_name;
        $category->save();
        return redirect()->route('admin.viewcategory')->with('success', 'Kategori berhasil diperbarui!');
    }

    public function deleteCategory($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->back()->with('success', 'Kategori berhasil dihapus!');
    }


    // ==========================================
    // BAGIAN BARANG (ITEM) - SUDAH DIPERBAIKI
    // ==========================================

    public function addItem()
    {
        $categories = Category::all();
        return view('admin.additem', compact('categories'));
    }

    public function postAddItem(Request $request)
    {
        // Validasi data (Opsional tapi disarankan)
        $request->validate([
            'item_name' => 'required',
            'item_quantity' => 'required|integer',
            'item_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar
        ]);

        $item = new AddItem(); // Menggunakan variabel $item agar lebih logis
        $item->item_name = $request->item_name;
        $item->item_quantity = $request->item_quantity;
        $item->category_name = $request->category_name;

        // --- PERBAIKAN LOGIKA UPLOAD GAMBAR ---
        // Kode lama Anda menyimpan path C:\Temp, itu salah.
        // Kode ini akan memindahkan gambar ke folder public/item_images
        
        if ($request->hasFile('item_image')) {
            $image = $request->file('item_image');
            
            // Buat nama file unik berdasarkan waktu
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            
            // Pindahkan file ke folder public/item_images
            $image->move('item_images', $imagename);
            
            // Simpan nama file ke database
            $item->item_image = $imagename;
        }

        $item->save();
        
        return redirect()->back()->with('success', 'Item berhasil ditambahkan dengan gambar yang benar!');
    }

    public function viewItem()
    {   
        $items = AddItem::all(); // Ganti variabel jadi $items (jamak)
        return view('admin.viewitem', compact('items')); // Kirim variable items
    }

    public function deleteItem($id)
    {
        // Cari data berdasarkan ID
        $item = AddItem::findOrFail($id);

        // (Opsional) Hapus file gambar fisik dari folder agar tidak menumpuk
        // Cek apakah file ada di folder public/item_images
        $image_path = public_path('item_images/' . $item->item_image);
        if (file_exists($image_path)) {
            @unlink($image_path); // Hapus file
        }

        // Hapus data dari database
        $item->delete();

        return redirect()->back()->with('success', 'Item berhasil dihapus');
    }
}