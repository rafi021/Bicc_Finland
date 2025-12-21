@extends('admin.layout')

@section('title', 'Create Gallery Category')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6 max-w-2xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Create Gallery Category</h2>
        <a href="{{ route('admin.gallery-categories.index') }}" class="text-gray-500 hover:text-gray-700">Back</a>
    </div>

    <form action="{{ route('admin.gallery-categories.store') }}" method="POST" class="space-y-6">
        @csrf
        
        <!-- Name -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Category Name</label>
            <input type="text" name="name" value="{{ old('name') }}" required
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm border p-2 @error('name') border-red-500 @enderror"
                placeholder="Enter Category Name">
            @error('name')
                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex justify-end mt-6">
            <button type="submit" class="bg-primary-600 text-white px-4 py-2 rounded-md hover:bg-primary-700">
                Save
            </button>
        </div>
    </form>
</div>
@endsection
