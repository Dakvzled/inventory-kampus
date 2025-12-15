<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

// ==========================================
// ADMIN ROUTES
// Middleware 'role:admin' akan mengecek database kolom 'role'
// ==========================================
Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    
    // 1. Dashboard Admin (PENTING: Name 'dashboard' ini dipakai untuk redirect)
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // 2. Manajemen Kategori
    Route::get('/addcategory', [AdminController::class, 'addCategory'])->name('admin.addcategory');
    Route::post('/addcategory', [AdminController::class, 'postAddCategory'])->name('admin.postaddcategory');
    Route::get('/viewcategory', [AdminController::class, 'viewCategory'])->name('admin.viewcategory');
    
    Route::get('/updatecategory/{id}', [AdminController::class, 'updateCategory'])->name('admin.updatecategory');
    Route::post('/updatecategory/{id}', [AdminController::class, 'postUpdateCategory'])->name('admin.postupdatecategory');
    Route::get('/deletecategory/{id}', [AdminController::class, 'deleteCategory'])->name('admin.deletecategory');

    // 3. Manajemen Barang
    Route::get('/additem', [AdminController::class, 'addItem'])->name('admin.additem');
    Route::post('/additem', [AdminController::class, 'postAddItem'])->name('admin.postadditem');
    Route::get('/viewitem', [AdminController::class, 'viewItem'])->name('admin.viewitem');
    
    Route::get('/edititem/{id}', [AdminController::class, 'editItem'])->name('admin.edititem');
    Route::put('/updateitem/{id}', [AdminController::class, 'updateItem'])->name('admin.updateitem');
    Route::get('/deleteitem/{id}', [AdminController::class, 'deleteItem'])->name('admin.deleteitem'); 

});

// ==========================================
// USER ROUTES
// Middleware 'role:user' mengamankan area ini
// ==========================================
Route::middleware(['auth', 'verified', 'role:user'])->group(function () {
    
    // Dashboard User (PENTING: Name 'user.dashboard' dipakai untuk redirect)
    Route::get('/user/dashboard', [UserController::class, 'index'])->name('user.dashboard');
    
    // Menu Khusus User
    Route::get('/user/catalog', [UserController::class, 'catalog'])->name('user.catalog');

});

// ==========================================
// PROFILE ROUTES
// Bisa diakses oleh Admin maupun User (hanya butuh login)
// ==========================================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware(['auth'])->group(function () {

    // Route untuk Admin Dashboard
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
        ->name('admin.dashboard');

    // Route untuk User Dashboard (Jaga-jaga jika belum ada)
    Route::get('/user/dashboard', [UserController::class, 'index'])
        ->name('user.dashboard');
        
});
Route::middleware(['auth', 'verified'])->group(function () {
    
    Route::get('/user/dashboard', [UserController::class, 'index'])->name('user.dashboard');
    Route::get('/user/catalog', [UserController::class, 'catalog'])->name('user.catalog');
    
    // >>> TAMBAHKAN BARIS INI <<<
    Route::post('/user/pinjam/{id}', [UserController::class, 'storePinjam'])->name('user.pinjam');

});

Route::middleware(['auth', 'verified'])->group(function () {
    
    // ... route admin lainnya ...
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    // ...

    // >>> TAMBAHKAN 3 BARIS INI <<<
    Route::get('/admin/borrowings', [AdminController::class, 'borrowings'])->name('admin.borrowings');
    Route::patch('/admin/borrowings/{id}/approve', [AdminController::class, 'approveBorrowing'])->name('admin.approve');
    Route::patch('/admin/borrowings/{id}/return', [AdminController::class, 'returnBorrowing'])->name('admin.return');
    Route::patch('/admin/borrowings/{id}/reject', [AdminController::class, 'rejectBorrowing'])->name('admin.reject');

});
require __DIR__.'/auth.php';