@extends('admin.layout')

@section('title', 'Edit Gallery Item')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6 max-w-4xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Edit Gallery Item</h2>
        <a href="{{ route('admin.galleries.index') }}" class="text-gray-500 hover:text-gray-700">Back</a>
    </div>

    <form action="{{ route('admin.galleries.update', $gallery) }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @csrf
        @method('PUT')
        
        <!-- Category Selection -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Category</label>
            <select name="category_id" required
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm border p-2">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $gallery->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
            @enderror
        </div>

        <!-- Title -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Image Title</label>
            <input type="text" name="title" value="{{ old('title', $gallery->title) }}"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm border p-2"
                placeholder="e.g. Eid Prayer">
        </div>

        <!-- Event Name -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Event Name</label>
            <input type="text" name="event_name" value="{{ old('event_name', $gallery->event_name) }}"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm border p-2"
                placeholder="e.g. Annual Ramadan Iftar">
        </div>

        <!-- Event Time -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Event Time/Date</label>
            <input type="text" name="event_time" value="{{ old('event_time', $gallery->event_time) }}"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm border p-2"
                placeholder="e.g. 15th April 2024">
        </div>

        <!-- Image Upload -->
        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700">Gallery Image</label>
            <input type="file" name="image" accept="image/*" class="dropify" data-height="150" 
                data-default-file="{{ image($gallery->image) }}">
            @error('image')
                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="md:col-span-2 flex justify-end mt-6">
            <button type="submit" class="bg-primary-600 text-white px-4 py-2 rounded-md hover:bg-primary-700 transition">
                Save
            </button>
        </div>
    </form>
</div>
@endsection
