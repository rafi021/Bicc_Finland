@extends('admin.layout')

@section('title', 'Mosque Home Page Settings')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Edit Home Page Settings</h2>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    @include('admin.partials.errors')

    <form action="{{ route('admin.mosque.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Hero Title -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Hero Title</label>
                <input type="text" name="hero_title" value="{{ old('hero_title', @$setting->hero_title) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm border p-2">
            </div>

            <!-- Hero Subtitle -->
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700">Hero Subtitle</label>
                <textarea name="hero_subtitle" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm border p-2">{{ old('hero_subtitle', @$setting->hero_subtitle) }}</textarea>
            </div>


             <!-- Hero Logo -->
             <div>
                <label class="block text-sm font-medium text-gray-700">Hero Logo/Image</label>
                <input type="file" name="hero_logo" class="dropify" data-height="100" data-default-file="{{ image(@$setting->hero_logo) }}" accept="image/*">
            </div>

            <!-- Video Thumbnail -->
             <div>
                <label class="block text-sm font-medium text-gray-700">Video Thumbnail</label>
                <input type="file" name="video_thumbnail" class="dropify" data-height="100" data-default-file="{{ image(@$setting->video_thumbnail) }}" accept="image/*">
            </div>
            
            <!-- Video ID -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Youtube Video ID</label>
                <input type="text" name="video_id" value="{{ old('video_id', @$setting->video_id) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm border p-2">
                <p class="text-xs text-gray-500 mt-1">e.g. tQHAwV9B8hQ</p>
            </div>

             <!-- Donation Raised -->
             <div>
                <label class="block text-sm font-medium text-gray-700">Base/Offline Donation Raised Amount ($)</label>
                <input type="number" step="0.01" name="donation_raised" value="{{ old('donation_raised', @$setting->donation_raised) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm border p-2">
                <div class="mt-2 text-sm text-gray-600 bg-gray-50 p-2 rounded">
                    <p>+ From Donors: <strong>${{ number_format($donorTotal ?? 0, 2) }}</strong></p>
                    <p class="mt-1 border-t pt-1 font-semibold text-primary-700">Total Displayed: ${{ number_format(@$setting->donation_raised + ($donorTotal ?? 0), 2) }}</p>
                </div>
            </div>

             <!-- Donation Goal -->
             <div>
                <label class="block text-sm font-medium text-gray-700">Donation Goal ($)</label>
                <input type="number" step="0.01" name="donation_goal" value="{{ old('donation_goal', @$setting->donation_goal) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm border p-2">
            </div>
        </div>

        <div class="flex justify-end mt-6">
            <button type="submit" class="bg-primary-600 text-white px-4 py-2 rounded-md hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                Save
            </button>
        </div>
    </form>
</div>
@endsection
