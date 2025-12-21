@extends('admin.layout')

@section('title', 'Contact Information Settings')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6 max-w-4xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Manage Contact Information</h2>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    @include('admin.partials.errors')

    <form action="{{ route('admin.mosque.contact.update') }}" method="POST" class="space-y-6">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Phone -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Phone Number</label>
                <input type="text" name="phone" value="{{ old('phone', @$setting->phone) }}" 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm border p-2 text-gray-700" 
                    placeholder="e.g. (555) 123-4567">
                <p class="text-xs text-gray-400 mt-1">Displayed in footer and service detail pages.</p>
            </div>

            <!-- Email -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Email Address</label>
                <input type="email" name="email" value="{{ old('email', @$setting->email) }}" 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm border p-2 text-gray-700" 
                    placeholder="e.g. info@biccfinland.org">
            </div>

            <!-- Address -->
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700">Physical Address</label>
                <input type="text" name="address" value="{{ old('address', @$setting->address) }}" 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm border p-2 text-gray-700" 
                    placeholder="e.g. Malminkaari 9 A (3rd floor)">
            </div>

            <!-- Office Hours -->
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700">Service / Office Hours</label>
                <input type="text" name="office_hours" value="{{ old('office_hours', @$setting->office_hours) }}" 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm border p-2 text-gray-700" 
                    placeholder="e.g. Monday - Friday: 9:00 AM - 5:00 PM">
            </div>
        </div>

        <div class="flex justify-end mt-6">
            <button type="submit" class="bg-primary-600 text-white px-4 py-2 rounded-md hover:bg-primary-700 transition font-medium">
                Save
            </button>
        </div>
    </form>
</div>
@endsection
