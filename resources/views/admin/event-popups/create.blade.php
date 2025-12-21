@extends('admin.layout')
@section('title', 'Create Event Popup')
@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <h2 class="text-2xl font-bold mb-6">Add New Event Popup</h2>
    <form action="{{ route('admin.event-popups.store') }}" method="POST" class="space-y-6">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700">Event Name <span class="text-red-500">*</span></label>
                <input type="text" name="event_name" value="{{ old('event_name') }}" required 
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm border p-2 focus:border-primary-500 focus:ring-primary-500"
                       placeholder="e.g., Jummah Prayer Tomorrow">
                @error('event_name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700">Message <span class="text-red-500">*</span></label>
                <textarea name="message" rows="3" required 
                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm border p-2 focus:border-primary-500 focus:ring-primary-500"
                          placeholder="Additional details about the event...">{{ old('message') }}</textarea>
                @error('message')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Event Date & Time <span class="text-red-500">*</span></label>
                <input type="datetime-local" name="event_datetime" value="{{ old('event_datetime') }}" required 
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm border p-2 focus:border-primary-500 focus:ring-primary-500">
                @error('event_datetime')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center">
                <div class="flex items-center h-full pt-6">
                    <input type="checkbox" name="is_active" id="is_active" value="1" checked
                           class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded">
                    <label for="is_active" class="ml-2 block text-sm text-gray-900">
                        Active (Show on website)
                    </label>
                </div>
            </div>
        </div>

        <div class="flex justify-end gap-3 mt-6">
            <a href="{{ route('admin.event-popups.index') }}" 
               class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300">Cancel</a>
            <button type="submit" class="bg-primary-600 text-white px-4 py-2 rounded-md hover:bg-primary-700">Create Event Popup</button>
        </div>
    </form>
</div>
@endsection
