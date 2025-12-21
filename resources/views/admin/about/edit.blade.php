@extends('admin.layout')

@section('title', 'Edit About Section')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="mb-6">
        <h2 class="text-2xl font-bold">Edit About Section</h2>
    </div>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.about.update', $about) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Title -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Title <span class="text-red-500">*</span></label>
            <input type="text" name="title" value="{{ old('title', $about->title) }}" required 
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm border p-2">
            @error('title')
                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
            @enderror
        </div>

        <!-- Content -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Content <span class="text-red-500">*</span></label>
            <textarea name="content" rows="8" required 
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm border p-2">{{ old('content', $about->content) }}</textarea>
            @error('content')
                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
            @enderror
        </div>

        <!-- Video ID -->
        <div>
            <label class="block text-sm font-medium text-gray-700">YouTube Video ID</label>
            <input type="text" name="video_id" value="{{ old('video_id', $about->video_id) }}" 
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm border p-2">
            <p class="text-xs text-gray-500 mt-1">e.g., tQHAwV9B8hQ</p>
            @error('video_id')
                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Video Thumbnail</label>
            <input type="file" name="video_thumbnail" accept="image/*" class="dropify" data-height="150" 
                data-default-file="{{ image($about->video_thumbnail) }}">
            @error('video_thumbnail')
                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="flex justify-end space-x-3 mt-6">
            <a href="{{ route('admin.about.index') }}" class="px-4 mr-2 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                Cancel
            </a>
            <button type="submit" class="bg-primary-600 text-white px-4 py-2 rounded-md hover:bg-primary-700">
                Save
            </button>
        </div>
    </form>
</div>
@endsection
