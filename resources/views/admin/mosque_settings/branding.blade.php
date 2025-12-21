@extends('admin.layout')

@section('title', 'Header & Branding Settings')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6 max-w-5xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Manage Header & Branding Info</h2>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    @include('admin.partials.errors')
    <form action="{{ route('admin.mosque.branding.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf
        
        <!-- Site Name -->
        <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
            <h3 class="text-lg font-semibold mb-4 flex items-center gap-2">
                <i class="ti ti-typewriter text-primary-600"></i> Website Name
            </h3>
            <div>
                <label class="block text-sm font-medium text-gray-700">Website Title / Mosque Name</label>
                <input type="text" name="site_name" value="{{ old('site_name', @$setting->site_name) }}" 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm border p-2" 
                    placeholder="e.g. BICC FINLAND / CBG Mosque">
                <p class="text-[10px] text-gray-400 mt-2 italic">This name will appear in the browser tab and various places on the site.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-6">
            <!-- Site Logo Section -->
            <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                <h3 class="text-lg font-semibold mb-4 flex items-center gap-2">
                    <i class="ti ti-photo text-primary-600"></i> Main Site Logo
                </h3>
                <div class="flex flex-col items-center w-full">
                    <input type="file" name="site_logo" 
                        class="dropify" 
                        data-default-file="{{ image(@$setting->site_logo) }}"
                        accept="image/*">
                    <p class="text-[10px] text-gray-400 mt-2 italic text-center">Recommended: Transparent PNG, 300x100px.</p>
                </div>
            </div>

            <!-- Favicon Section -->
            <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                <h3 class="text-lg font-semibold mb-4 flex items-center gap-2">
                    <i class="ti ti-bookmark text-primary-600"></i> Website Favicon
                </h3>
                <div class="flex flex-col items-center w-full">
                    <input type="file" name="favicon" 
                        class="dropify" 
                        data-default-file="{{ image(@$setting->favicon) }}"
                        accept="image/*">
                    <p class="text-[10px] text-gray-400 mt-2 italic text-center">Recommended: 32x32px or 64x64px (ICO/PNG).</p>
                </div>
            </div>
        </div>

        <div class="flex justify-end mt-6">
            <button type="submit" class="bg-primary-600 text-white px-4 py-2 rounded-md hover:bg-primary-700 transition font-bold shadow-lg flex items-center">
                Save
            </button>
        </div>
    </form>
</div>
@endsection
