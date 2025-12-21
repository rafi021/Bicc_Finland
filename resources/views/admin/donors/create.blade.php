@extends('admin.layout')

@section('title', 'Add Donor')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6 max-w-2xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Add Donor</h2>
        <a href="{{ route('admin.donors.index') }}" class="text-gray-600 hover:text-gray-900">Back</a>
    </div>

    <form action="{{ route('admin.donors.store') }}" method="POST" class="space-y-6">
        @csrf
        <div>
            <label class="block text-sm font-medium text-gray-700">Donor Name</label>
            <input type="text" name="name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm border p-2">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Amount ($)</label>
            <input type="number" step="0.01" name="amount" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm border p-2">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm border p-2">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Phone</label>
            <input type="text" name="phone" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm border p-2">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Message</label>
            <textarea name="message" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm border p-2"></textarea>
        </div>
        <div class="flex items-center">
            <input type="checkbox" name="is_visible" value="1" id="is_visible" class="mr-2">
            <label for="is_visible" class="text-sm text-gray-700">Show donor publicly</label>
        </div>
        <div class="flex justify-end mt-6">
            <button type="submit" class="bg-primary-600 text-white px-4 py-2 rounded-md hover:bg-primary-700">Save</button>
        </div>
    </form>
</div>
@endsection
