@extends('admin.layout')

@section('title', 'Service Requests')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Service Requests</h2>
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
                    <th class="px-4 py-2 font-medium">Service</th>
                    <th class="px-4 py-2 font-medium">Name</th>
                    <th class="px-4 py-2 font-medium">Email</th>
                    <th class="px-4 py-2 font-medium">Phone</th>
                    <th class="px-4 py-2 font-medium">Message</th>
                    <th class="px-4 py-2 font-medium">Date</th>
                    <th class="px-4 py-2 font-medium">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($requests as $request)
                    <tr class="border-b border-gray-200 hover:bg-gray-50">
                        <td class="px-4 py-3 font-medium text-primary-600">{{ $request->service->title }}</td>
                        <td class="px-4 py-3">{{ $request->name }}</td>
                        <td class="px-4 py-3">{{ $request->email }}</td>
                        <td class="px-4 py-3">{{ $request->phone }}</td>
                        <td class="px-4 py-3">
                            <button type="button" class="text-blue-500 hover:underline" onclick="alert('{{ addslashes($request->message) }}')">View Message</button>
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-500">{{ $request->created_at->format('M d, Y') }}</td>
                        <td class="px-4 py-3">
                            <div class="flex gap-2">
                                <form action="{{ route('admin.service-requests.destroy', $request) }}" method="POST" class="inline" onsubmit="return confirm('Delete this request?');">
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
                        <td colspan="7" class="px-4 py-8 text-center text-gray-500">No service requests yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $requests->links() }}
    </div>
</div>
@endsection
