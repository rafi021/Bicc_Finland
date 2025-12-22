@extends('admin.layout')

@section('title', 'Contact Messages')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Contact Messages</h2>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b-2 border-gray-200 bg-gray-50">
                    <th class="px-4 py-3 font-semibold text-gray-700">Name</th>
                    <th class="px-4 py-3 font-semibold text-gray-700">Email</th>
                    <th class="px-4 py-3 font-semibold text-gray-700">Phone</th>
                    <th class="px-4 py-3 font-semibold text-gray-700">Message</th>
                    <th class="px-4 py-3 font-semibold text-gray-700">Date</th>
                    <th class="px-4 py-3 font-semibold text-gray-700 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($messages as $message)
                    <tr class="border-b border-gray-200 hover:bg-gray-50 transition-colors">
                        <td class="px-4 py-3 font-medium text-gray-900">{{ $message->name }}</td>
                        <td class="px-4 py-3 text-gray-600">
                            <a href="mailto:{{ $message->email }}" class="text-blue-600 hover:underline">{{ $message->email }}</a>
                        </td>
                        <td class="px-4 py-3 text-gray-600">
                            <a href="tel:{{ $message->phone }}" class="text-blue-600 hover:underline">{{ $message->phone }}</a>
                        </td>
                        <td class="px-4 py-3 max-w-md">
                            <div class="message-container">
                                <p class="text-gray-700 message-preview" id="preview-{{ $message->id }}">
                                    {{ Str::limit($message->message, 80) }}
                                </p>
                                <p class="text-gray-700 message-full hidden" id="full-{{ $message->id }}">
                                    {{ $message->message }}
                                </p>
                                @if(strlen($message->message) > 80)
                                <button type="button" 
                                    class="text-blue-500 hover:text-blue-700 text-sm font-medium mt-1 toggle-message" 
                                    data-id="{{ $message->id }}"
                                    onclick="toggleMessage({{ $message->id }})">
                                    <span class="show-more">Show More</span>
                                    <span class="show-less hidden">Show Less</span>
                                </button>
                                @endif
                            </div>
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-500 whitespace-nowrap">
                            {{ $message->created_at->format('M d, Y') }}
                            <br>
                            <span class="text-xs text-gray-400">{{ $message->created_at->format('h:i A') }}</span>
                        </td>
                        <td class="px-4 py-3 text-center">
                            <form action="{{ route('admin.contact-messages.destroy', $message->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this message?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                    class="inline-flex items-center justify-center w-8 h-8 bg-red-50 text-red-600 rounded-lg border border-red-200 hover:bg-red-100 transition-colors shadow-sm"
                                    title="Delete Message">
                                    <i class="ti ti-trash text-base"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-12 text-center text-gray-500">
                            <i class="ti ti-inbox text-4xl mb-2 block text-gray-300"></i>
                            <p class="font-medium">No contact messages yet.</p>
                            <p class="text-sm text-gray-400 mt-1">Messages from the contact form will appear here.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $messages->links() }}
    </div>
</div>

<script>
function toggleMessage(id) {
    const preview = document.getElementById('preview-' + id);
    const full = document.getElementById('full-' + id);
    const button = event.target.closest('button');
    const showMore = button.querySelector('.show-more');
    const showLess = button.querySelector('.show-less');
    
    if (preview.classList.contains('hidden')) {
        preview.classList.remove('hidden');
        full.classList.add('hidden');
        showMore.classList.remove('hidden');
        showLess.classList.add('hidden');
    } else {
        preview.classList.add('hidden');
        full.classList.remove('hidden');
        showMore.classList.add('hidden');
        showLess.classList.remove('hidden');
    }
}
</script>
@endsection
