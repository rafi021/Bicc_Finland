@extends('admin.layout')
@section('title', 'Daily Quote Settings')
@section('content')
<div class="bg-white rounded-lg shadow-md p-6 max-w-2xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Daily Quote Settings</h2>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    @include('admin.partials.errors')

    <form action="{{ route('admin.mosque.quote.update') }}" method="POST" class="space-y-6">
        @csrf
        
        <div>
            <label class="block text-sm font-medium text-gray-700">Quote Text</label>
            <textarea name="quote" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm border p-3" placeholder="Enter the quote here...">{{ old('quote', @$setting->quote) }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Quote Author/Source</label>
            <input type="text" name="quote_author" value="{{ old('quote_author', @$setting->quote_author) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm border p-3" placeholder="e.g. Prophet Muhammad (PBUH)">
        </div>

        <div class="flex justify-end mt-6">
            <button type="submit" class="bg-primary-600 text-white px-4 py-2 rounded-md hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                Save
            </button>
        </div>
    </form>
</div>
@endsection
