<x-app-layout>
    <x-slot name="header">
        {{-- FIX: Removed dark:text-gray-200 to ensure dark text on light header --}}
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard - View Categories') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- FIX: Removed dark:bg-gray-800 and dark:text-gray-100 --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                {{-- Ensure main text color is dark for content --}}
                <div class="p-6 text-gray-900">
                    
                    {{-- Table uses Bootstrap classes (table) and Tailwind for styling --}}
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Category ID</th>
                                <th scope="col">Category Name</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <th scope="row">{{ $category->id }}</th>
                                    <td>{{ $category->category_name }}</td>

                                    {{-- FIX: Combined both buttons into a single <td> --}}
                                    {{-- Added 'flex' and 'space-x-2' for tight, responsive layout --}}
                                    <td class="d-flex gap-3 align-items-center">.
                                        
                                        {{-- 
                                            Action 1: Delete Button 
                                            NOTE: window.confirm() replaced due to environment restrictions.
                                            You should implement a custom modal/alert box here instead.
                                        --}}
                                        <a href="{{ route('admin.deletecategory',$category->id) }}"
                                           class="btn btn-danger btn-sm"
                                           {{-- Placeholder for custom modal trigger: --}}
                                           onclick="console.log('Delete confirmation dialog triggered for ID: {{ $category->id }}')"
                                        >
                                            Delete
                                        </a>

                                        {{-- Action 2: Update Button --}}
                                        <a href="{{ route('admin.updatecategory',$category->id) }}"
                                           class="btn btn-warning btn-sm"
                                        >
                                            Update
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>