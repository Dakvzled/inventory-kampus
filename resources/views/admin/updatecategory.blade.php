<x-app-layout>
    <x-slot name="header">
        {{-- Cleaned up dark classes for bright mode --}}
        <h2 class="font-semibold text-xl text-gray-900 leading-tight">
            {{ __('Update Category: ') . $category->category_name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- FIX: Cleaned up dark classes --}}
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                
                {{-- FORM CONTAINER: Added padding (p-8) for better look --}}
                <div class="p-8 text-gray-900">
                    
                    <form action="{{ route('admin.postupdatecategory', $category->id) }}" method="POST" class="space-y-6">
                        @csrf
                        {{-- Laravel requires @method('PUT') or @method('PATCH') for updates, assuming the route uses PUT/PATCH --}}
                        {{-- If your route is simply POST, you can omit the @method directive --}}
                        {{-- @method('PUT') --}} 

                        {{-- Category Name Input Field --}}
                        <div class="form-group">
                            <label for="categoryName" class="block text-sm font-medium text-gray-700 mb-2">Category Name</label>
                            
                            {{-- FIX 1: Used 'value' attribute to correctly display the current name --}}
                            {{-- FIX 2: Added 'rounded-lg shadow-sm' for better styling --}}
                            <input 
                                type="text" 
                                id="categoryName" 
                                class="form-control rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 block w-full sm:text-sm border-gray-300" 
                                name="category_name" 
                                value="{{ $category->category_name }}" 
                                placeholder="Enter new category name"
                                required
                            >
                        </div>

                        {{-- Submit Button --}}
                        <div class="flex justify-end">
                            {{-- Used Bootstrap primary button with a small margin top --}}
                            <button type="submit" class="btn btn-primary mt-4">
                                Save Changes
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>