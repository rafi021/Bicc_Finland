@extends('admin.layout')

@section('title', 'Add Gallery Item')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6 max-w-4xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Add Gallery Item</h2>
        <a href="{{ route('admin.galleries.index') }}" class="text-gray-500 hover:text-gray-700">Back</a>
    </div>

    <form action="{{ route('admin.galleries.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @csrf
        
        <!-- Category Selection -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Category</label>
            <select name="category_id" required
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm border p-2">
                <option value="" disabled selected>Select a Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')
                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
            @enderror
        </div>

        <!-- Title -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Image Title</label>
            <input type="text" name="title" value="{{ old('title') }}"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm border p-2"
                placeholder="e.g. Eid Prayer">
        </div>

        <!-- Event Name -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Event Name</label>
            <input type="text" name="event_name" value="{{ old('event_name') }}"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm border p-2"
                placeholder="e.g. Annual Ramadan Iftar">
        </div>

        <!-- Event Time -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Event Time/Date</label>
            <input type="text" name="event_time" value="{{ old('event_time') }}"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm border p-2"
                placeholder="e.g. 15th April 2024">
        </div>

        <!-- Multi-Image Upload (Dropify-Style) -->
        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700 mb-2">Gallery Images (Select Multiple)</label>
            <div class="dropify-wrapper h-[180px] w-full relative flex items-center justify-center border-2 border-dashed border-gray-300 rounded-lg bg-gray-50 hover:border-primary-500 transition-all cursor-pointer group" id="multi-drop-zone">
                <input type="file" name="images[]" multiple accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" onchange="handleMultiUpload(this)">
                <div class="dropify-message text-center p-4">
                    <span class="file-icon block text-gray-400 text-3xl mb-1">
                        <i class="ti ti-cloud-upload"></i>
                    </span>
                    <p class="text-sm font-medium text-gray-600">Drag and drop images here or click</p>
                    <p class="text-xs text-gray-400 mt-1 italic">Multiple files supported</p>
                </div>
            </div>
            
            <!-- Preview Grid -->
            <div id="multi-preview-container" class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-6 gap-3 mt-4">
                <!-- Previews will appear here -->
            </div>
            
            @error('images')
                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
            @enderror
        </div>

        <script>
        function handleMultiUpload(input) {
            const container = document.getElementById('multi-preview-container');
            const dropZone = document.getElementById('multi-drop-zone');
            
            if (input.files && input.files.length > 0) {
                // Update drop zone text
                const text = dropZone.querySelector('p');
                text.textContent = `${input.files.length} images selected`;
                text.classList.add('text-primary-600', 'font-bold');

                container.innerHTML = '';
                Array.from(input.files).forEach((file, index) => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const div = document.createElement('div');
                        div.className = 'relative group aspect-square rounded-lg overflow-hidden border border-gray-200 shadow-sm transition-all hover:scale-105';
                        div.innerHTML = `
                            <img src="${e.target.result}" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 flex items-center justify-center transition-opacity">
                                <span class="text-white text-[10px] font-bold px-2 py-1 bg-black/50 rounded">Image ${index + 1}</span>
                            </div>
                        `;
                        container.appendChild(div);
                    }
                    reader.readAsDataURL(file);
                });
            }
        }
        </script>

        <div class="md:col-span-2 flex justify-end mt-6">
            <button type="submit" class="bg-primary-600 text-white px-4 py-2 rounded-md hover:bg-primary-700 transition">
                Save
            </button>
        </div>
    </form>
</div>
@endsection
