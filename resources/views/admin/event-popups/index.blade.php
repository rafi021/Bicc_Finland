@extends('admin.layout')
@section('title', 'Event Popups')
@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Event Popups</h2>
        <a href="{{ route('admin.event-popups.create') }}" class="bg-primary-600 text-white px-4 py-2 rounded-md hover:bg-primary-700">Add New Event Popup</a>
    </div>
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">{{ session('success') }}</div>
    @endif
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Event Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Message</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date & Time</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($eventPopups as $popup)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap font-medium">{{ $popup->event_name }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500">{{ Str::limit($popup->message, 50) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $popup->event_datetime->format('M d, Y g:i A') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($popup->is_active)
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                        @else
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">Inactive</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('admin.event-popups.edit', $popup->id) }}" 
                               class="w-8 h-8 flex items-center justify-center bg-blue-50 text-blue-600 rounded-lg border border-blue-200 hover:bg-blue-100 transition-colors shadow-sm">
                                <i data-lucide="pencil" class="w-4 h-4"></i>
                            </a>
                            <form action="{{ route('admin.event-popups.destroy', $popup->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this event popup?');">
                                @csrf @method('DELETE')
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
                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">No event popups found. Create one to get started!</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $eventPopups->links() }}</div>
</div>
@endsection
