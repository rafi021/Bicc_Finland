@extends('admin.layout')

@section('title', 'Add Service')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6 max-w-4xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Add New Service</h2>
        <a href="{{ route('admin.services.index') }}" class="text-gray-500 hover:text-gray-700">Back</a>
    </div>

    <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Title -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Service Title</label>
                <input type="text" name="title" value="{{ old('title') }}" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm border p-2"
                    placeholder="e.g. Islamic Classes">
            </div>

            <!-- Icon -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Tabler Icon Class</label>
                <input type="text" name="icon" value="{{ old('icon') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm border p-2"
                    placeholder="e.g. ti-book-upload">
                <p class="text-xs text-gray-400 mt-1">Visit <a href="https://tabler-icons.io/" target="_blank" class="text-blue-500 underline">tabler-icons.io</a> for classes.</p>
            </div>
        </div>

        <!-- Short Description -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Short Description (for list page)</label>
            <textarea name="description" rows="3" required
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm border p-2"
                placeholder="Briefly describe the service..."></textarea>
        </div>

        <!-- Detailed Content -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Full Content (for detail page)</label>
            <textarea name="content" rows="10" required
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm border p-2"
                placeholder="Provide detailed information about the service..."></textarea>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Main Image</label>
            <input type="file" name="image" accept="image/*" class="dropify" data-height="150">
        </div>

        <div class="flex justify-end mt-6">
            <button type="submit" class="bg-primary-600 text-white px-4 py-2 rounded-md hover:bg-primary-700 transition">
                Save
            </button>
        </div>
    </form>
</div>
@endsection
