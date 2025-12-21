@extends('admin.layout')
@section('title', 'Create Islamic Class')
@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <h2 class="text-2xl font-bold mb-6">Add New Islamic Class</h2>
    <form action="{{ route('admin.classes.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700">Class Title</label>
                <input type="text" name="title" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm border p-2">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Category</label>
                <select name="category" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm border p-2">
                    <option value="Adults">Adults</option>
                    <option value="Kids">Kids</option>
                    <option value="Women">Women</option>
                    <option value="General">General</option>
                </select>
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm border p-2"></textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Days (e.g. Mon, Wed)</label>
                <input type="text" name="days" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm border p-2">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Time (e.g. 5:00 PM - 6:00 PM)</label>
                <input type="text" name="time" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm border p-2">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Class Image</label>
                <input type="file" name="image" class="dropify" data-height="100">
            </div>
        </div>
        <div class="flex justify-end mt-6">
            <button type="submit" class="bg-primary-600 text-white px-4 py-2 rounded-md hover:bg-primary-700">Save</button>
        </div>
    </form>
</div>
@endsection
