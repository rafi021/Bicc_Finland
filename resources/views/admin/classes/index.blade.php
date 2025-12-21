@extends('admin.layout')
@section('title', 'Islamic Classes')
@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Islamic Classes</h2>
        <div>
             <a href="{{ route('admin.classes.registrations') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 mr-2">View Registrations</a>
             <a href="{{ route('admin.classes.create') }}" class="bg-primary-600 text-white px-4 py-2 rounded-md hover:bg-primary-700">Add New Class</a>
        </div>
    </div>
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">{{ session('success') }}</div>
    @endif
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Day/Time</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($classes as $class)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $class->title }}</td>
                    <td class="px-6 py-4 whitespace-nowrap"><span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">{{ $class->category }}</span></td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $class->days }} <br> {{ $class->time }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <div class="flex justify-end gap-2">
                             <a href="{{ route('admin.classes.edit', $class->id) }}" 
                                class="w-8 h-8 flex items-center justify-center bg-blue-50 text-blue-600 rounded-lg border border-blue-200 hover:bg-blue-100 transition-colors shadow-sm">
                                <i data-lucide="pencil" class="w-4 h-4"></i>
                             </a>
                             <form action="{{ route('admin.classes.destroy', $class->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?');">
                                 @csrf @method('DELETE')
                                 <button type="submit" 
                                     class="w-8 h-8 flex items-center justify-center bg-red-50 text-red-600 rounded-lg border border-red-200 hover:bg-red-100 transition-colors shadow-sm">
                                     <i data-lucide="trash-2" class="w-4 h-4"></i>
                                 </button>
                             </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $classes->links() }}</div>
</div>
@endsection
