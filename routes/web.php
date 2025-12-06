<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController; 
use App\Http\Controllers\AdminController; 

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [UserController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// ==========================================
// ADMIN ROUTES (Middleware: auth + admin)
// ==========================================
Route::middleware(['auth', 'admin'])->group(function () {
    
    // --- CATEGORY ROUTES ---
    Route::get('/addcategory', [AdminController::class, 'addCategory'])->name('admin.addcategory');
    Route::post('/addcategory', [AdminController::class, 'postAddCategory'])->name('admin.postaddcategory');
    
    Route::get('/viewcategory', [AdminController::class, 'viewCategory'])->name('admin.viewcategory');
    Route::get('/deletecategory/{id}', [AdminController::class, 'deleteCategory'])->name('admin.deletecategory');
    
    Route::get('/updatecategory/{id}', [AdminController::class, 'updateCategory'])->name('admin.updatecategory');
    Route::post('/updatecategory/{id}', [AdminController::class, 'postUpdateCategory'])->name('admin.postupdatecategory');

    // --- ITEM ROUTES ---
    Route::get('/additem', [AdminController::class, 'addItem'])->name('admin.additem');
    Route::post('/additem', [AdminController::class, 'postAddItem'])->name('admin.postadditem'); // Perhatikan penulisan camelCase
    
    Route::get('/viewitem', [AdminController::class, 'viewItem'])->name('admin.viewitem'); // Perhatikan penulisan camelCase
    
    // Route untuk Delete Item
    Route::get('/deleteitem/{id}', [AdminController::class, 'deleteItem'])->name('admin.deleteitem'); 

}); 

// ==========================================
// PROFILE ROUTES (Middleware: auth)
// ==========================================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';