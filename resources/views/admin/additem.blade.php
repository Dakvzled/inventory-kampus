<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <!-- FIX 1: Alert Success yang lebih rapi (Hijau) -->
                    @if(session('success'))
                    ...
                    {{ session('success') }}
                    ...
                    @endif

                    <h3 class="text-lg font-bold mb-4">Add New Item</h3>

                    <form action="{{ route('admin.postadditem') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- 1. Item Name -->
                        <div class="mb-4">
                            <label for="item_name" class="block text-sm font-medium text-gray-700 mb-1">Item Name</label>
                            <input type="text" 
                                   name="item_name" 
                                   id="item_name"
                                   class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" 
                                   placeholder="Enter Item Name" 
                                   required>
                        </div>

                        <!-- 2. Item Image -->
                        <!-- FIX 2: Input file tidak butuh placeholder. Struktur dirapikan. -->
                        <div class="mb-4">
                            <label for="item_image" class="block text-sm font-medium text-gray-700 mb-1">Item Image</label>
                            <input type="file" 
                                   name="item_image" 
                                   id="item_image"
                                   class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" 
                                   accept="image/*"
                                   required>
                        </div>

                        <!-- 3. Item Quantity -->
                        <div class="mb-4">
                            <label for="item_quantity" class="block text-sm font-medium text-gray-700 mb-1">Item Quantity</label>
                            <input type="number" 
                                   name="item_quantity" 
                                   id="item_quantity"
                                   min="1"
                                   class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" 
                                   placeholder="Enter Item Quantity" 
                                   required>
                        </div>

                        <!-- 4. Category (Dropdown) -->
                        <div class="mb-4 w-1/2">
                            <label for="category_name" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                            
                            <!-- FIX 3: Tag Select membungkus semua Option -->
                            <select name="category_name" id="category_name" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                <option value="" disabled selected>Select Category</option>
                                
                                @if(isset($categories) && count($categories) > 0)
                                    @foreach($categories as $category)
                                        <!-- Value mengirim ID, Teks menampilkan Nama -->
                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                @else
                                    <!-- Fallback statis jika database kosong -->
                                    <option value="1">Perangkat Elektronik</option>
                                    <option value="2">Furnitur dan Mebel</option>
                                    <option value="3">Ruangan Gedung</option>
                                    <option value="4">Alat Praktikum</option>
                                @endif
                            </select>
                        </div>

                        <!-- Button -->
                        <div class="mt-4">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow-lg transition duration-150 ease-in-out">
                                Add Product
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>