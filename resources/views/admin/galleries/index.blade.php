@extends('admin.layout')

@section('title', 'Gallery Items')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Gallery Items</h2>
        <a href="{{ route('admin.galleries.create') }}" class="bg-primary-600 text-white px-4 py-2 rounded-md hover:bg-primary-700">
            Add Gallery Item
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b-2 border-gray-200">
                    <th class="px-4 py-2 font-medium">Image</th>
                    <th class="px-4 py-2 font-medium">Category</th>
                    <th class="px-4 py-2 font-medium">Event/Title</th>
                    <th class="px-4 py-2 font-medium">Time</th>
                    <th class="px-4 py-2 font-medium">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($galleries as $item)
                    <tr class="border-b border-gray-200 hover:bg-gray-50">
                        <td class="px-4 py-3">
                            <img src="{{ image($item->image) }}" alt="Gallery Item" class="h-12 w-12 object-cover rounded shadow-sm">
                        </td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 bg-gray-100 text-gray-700 rounded text-xs font-semibold">
                                {{ $item->category->name }}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            <div class="font-medium text-gray-900">{{ $item->title }}</div>
                            <div class="text-xs text-gray-500">{{ $item->event_name }}</div>
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-600">{{ $item->event_time ?? 'N/A' }}</td>
                        <td class="px-4 py-3">
                            <div class="flex gap-2">
                                <a href="{{ route('admin.galleries.edit', $item) }}" 
                                    class="w-8 h-8 flex items-center justify-center bg-blue-50 text-blue-600 rounded-lg border border-blue-200 hover:bg-blue-100 transition-colors shadow-sm"
                                    title="Edit">
                                    <i data-lucide="pencil" class="w-4 h-4"></i>
                                </a>
                                <form action="{{ route('admin.galleries.destroy', $item) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                        class="w-8 h-8 flex items-center justify-center bg-red-50 text-red-600 rounded-lg border border-red-200 hover:bg-red-100 transition-colors shadow-sm">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-8 text-center text-gray-500">
                            No gallery items found. <a href="{{ route('admin.galleries.create') }}" class="text-primary-600 hover:text-primary-800">Add some</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($galleries->hasPages())
        <div class="mt-4">
            {{ $galleries->links() }}
        </div>
    @endif
</div>
@endsection
