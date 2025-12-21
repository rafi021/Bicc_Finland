@extends('admin.layout')

@section('title', 'Azan Time Settings')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Azan / Prayer Time Settings</h2>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    @include('admin.partials.errors')

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-stretch">
        <!-- CSV Import Section (Top Left) -->
        <div class="p-6 border border-blue-200 rounded-lg bg-blue-50 flex flex-col">
            <h3 class="font-bold text-lg mb-2 text-blue-800">Import CSV Schedule (Auto Update)</h3>
            <p class="text-sm text-blue-600 mb-4">
                Upload a CSV file to automatically update prayer times based on the date. <br>
                <strong>Format:</strong> Date (M/D/Y or Y-M-D), Fajr, Dhuhr, Asr, Maghrib, Isha
                <a href="{{ route('admin.prayer.download_demo') }}" class="block mt-2 font-bold underline hover:text-blue-800">
                    <i class="ti ti-download"></i> Download CSV Template
                </a>
            </p>
            <form action="{{ route('admin.prayer.import') }}" method="POST" enctype="multipart/form-data" class="mt-auto flex flex-col gap-4">
                @csrf
                <div class="w-full">
                    <input type="file" name="csv_file" required accept=".csv,.txt" class="dropify" data-height="80" data-allowed-file-extensions="csv txt">
                </div>
                <div class="flex flex-wrap gap-2">
                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors shadow-sm font-bold flex items-center gap-2">
                        <i class="ti ti-upload"></i> Import CSV
                    </button>
                    <button type="button" onclick="openFullScheduleModal()" class="bg-white text-blue-600 border border-blue-600 px-6 py-2 rounded-lg hover:bg-blue-50 transition-colors shadow-sm font-bold flex items-center gap-2">
                        <i class="ti ti-calendar-event"></i> View/Manage Full Schedule
                    </button>
                </div>
            </form>
        </div>

        <!-- Manual Update Form (Right & Bottom) -->
        <form action="{{ route('admin.azan.time.update') }}" method="POST" enctype="multipart/form-data" class="contents">
            @csrf
            
            <!-- Monthly Schedule Section (Top Right) -->
            <div class="p-6 border border-gray-200 rounded-lg bg-gray-50 flex flex-col">
                <h3 class="font-bold text-lg mb-2">Monthly Prayer Schedule (PDF/Image)</h3>
                <p class="text-xs text-gray-500 mb-4">Upload a visual schedule file for users to download.</p>
                <div class="w-full mt-auto">
                    <input type="file" name="monthly_schedule_file" class="dropify" data-height="120" 
                        data-default-file="{{ @$setting->monthly_schedule_file ? asset(@$setting->monthly_schedule_file) : '' }}">
                </div>
            </div>

            <!-- Manual Settings Section (Bottom Full Width) -->
            <div class="md:col-span-2 mt-4">
                <div class="mb-4 border-b pb-2">
                    <h3 class="font-bold text-lg">Manual Default Settings (Fallback)</h3>
                    <p class="text-xs text-gray-500">These times will be used if no schedule data is found for the current date.</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-4">
                    @foreach(['fajr', 'dhuhr', 'asr', 'maghrib', 'isha'] as $prayer)
                    <div class="border p-3 rounded bg-gray-50">
                        <h4 class="font-bold capitalize text-center mb-2">{{ $prayer }}</h4>
                        <div class="mb-2">
                            <label class="block text-xs font-bold text-gray-500">Prayer Time</label>
                            @php
                                $csvValue = $todaySchedule ? $todaySchedule->{$prayer} : null;
                                $displayValue = old($prayer.'_azan', $csvValue ?? @$setting->{$prayer.'_azan'});
                            @endphp
                            <input type="text" name="{{ $prayer }}_azan" value="{{ $displayValue }}" placeholder="00:00 AM" class="w-full text-sm border-gray-300 rounded p-1 border {{ $csvValue ? 'bg-blue-50 border-blue-200' : '' }}">
                            @if($csvValue)
                                <p class="text-[10px] text-blue-500 mt-1 font-medium">Currently using today's CSV time</p>
                            @endif
                        </div>
                    </div>
                    @endforeach

                    <!-- Jummah Column -->
                    <div class="border p-3 rounded bg-primary-50 border-primary-200">
                        <h4 class="font-bold capitalize text-center mb-2 text-primary-800">Jummah</h4>
                        <div class="mb-2">
                            <label class="block text-xs font-bold text-gray-500">Time</label>
                            <input type="text" name="jummah_time" value="{{ old('jummah_time', @$setting->jummah_time) }}" placeholder="1:30 PM" class="w-full text-sm border-gray-300 rounded p-1 border">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500">Live Link</label>
                            <input type="text" name="jummah_live_link" value="{{ old('jummah_live_link', @$setting->jummah_live_link) }}" placeholder="URL" class="w-full text-sm border-gray-300 rounded p-1 border">
                        </div>
                    </div>
                </div>

                <div class="flex justify-end mt-6">
                    <button type="submit" class="bg-primary-600 text-white px-4 py-2 rounded-md hover:bg-primary-700 transition font-bold shadow-lg flex items-center">
                        Save
                    </button>
            </div>
        </form>
    </div>

</div>

<!-- Full Schedule Modal (Moved to bottom for better stacking) -->
<div id="fullScheduleModal" class="fixed inset-0 bg-black/98 z-[2147483647] hidden overflow-y-auto backdrop-blur-2xl transition-all duration-300">
    <div class="min-h-full flex items-center justify-center p-2 md:p-6">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-6xl flex flex-col overflow-hidden relative border border-white/20">
            
            <!-- Modal Header -->
            <div class="p-4 md:p-6 bg-slate-100 border-b flex items-center justify-between sticky top-0 z-[1001]">
                <div>
                    <h3 class="text-lg md:text-xl font-bold text-gray-800 flex items-center gap-2">
                        <i class="ti ti-calendar-event text-blue-600"></i>
                        Upcoming Schedule
                    </h3>
                    <p class="text-[10px] md:text-xs text-gray-500 mt-1">Next 30 days of schedule data</p>
                </div>
                <div class="flex items-center gap-2 md:gap-4">
                    @if(!$schedules->isEmpty())
                    <form action="{{ route('admin.prayer.clear') }}" method="POST" onsubmit="return confirm('Clear ALL imported schedules?')">
                        @csrf
                        <button type="submit" class="hidden sm:flex text-red-600 hover:text-white hover:bg-red-600 text-xs font-bold border border-red-200 px-3 py-2 rounded-lg bg-red-50 transition-all items-center gap-1">
                            <i class="ti ti-trash"></i> Clear Data
                        </button>
                    </form>
                    @endif
                    <button onclick="closeFullScheduleModal()" class="flex items-center gap-2 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 shadow-lg font-bold transition-all transform active:scale-95">
                        <i class="ti ti-x text-xl"></i>
                        <span>CLOSE</span>
                    </button>
                </div>
            </div>

            <!-- Modal Tabs -->
            <div class="px-6 bg-white border-b flex gap-4 sticky top-[72px] md:top-[88px] z-[1000] shadow-sm">
                <button onclick="switchScheduleTab('table')" id="tab-table" class="py-3 px-2 border-b-2 border-blue-600 text-blue-600 font-bold text-sm transition-all focus:outline-none">
                    <i class="ti ti-table"></i> Data Table (CSV)
                </button>
                @if(@$setting->monthly_schedule_file)
                <button onclick="switchScheduleTab('visual')" id="tab-visual" class="py-3 px-2 border-b-2 border-transparent text-gray-500 hover:text-blue-600 font-bold text-sm transition-all focus:outline-none">
                    <i class="ti ti-file-text"></i> Visual Schedule (PDF/Image)
                </button>
                @endif
            </div>

            <!-- Modal Body -->
            <div class="flex-1 overflow-y-auto p-4 md:p-6">
                <!-- Table View -->
                <div id="view-table" class="block">
                    @if($schedules->isEmpty())
                        <div class="bg-gray-50 border border-dashed border-gray-300 rounded-xl p-12 text-center">
                            <i class="ti ti-calendar-x text-4xl text-gray-300 mb-4 block"></i>
                            <p class="text-gray-500 font-medium">No imported schedule found. Upload a CSV to get started.</p>
                        </div>
                    @else
                        <div class="overflow-scroll md:overflow-hidden border border-gray-200 rounded-xl">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-3 md:px-6 py-4 text-left text-[10px] md:text-xs font-bold text-gray-500 uppercase tracking-wider">Date</th>
                                        <th class="px-3 md:px-6 py-4 text-left text-[10px] md:text-xs font-bold text-gray-500 uppercase tracking-wider">Fajr</th>
                                        <th class="px-3 md:px-6 py-4 text-left text-[10px] md:text-xs font-bold text-gray-500 uppercase tracking-wider">Dhuhr</th>
                                        <th class="px-3 md:px-6 py-4 text-left text-[10px] md:text-xs font-bold text-gray-500 uppercase tracking-wider">Asr</th>
                                        <th class="px-3 md:px-6 py-4 text-left text-[10px] md:text-xs font-bold text-gray-500 uppercase tracking-wider">Maghrib</th>
                                        <th class="px-3 md:px-6 py-4 text-left text-[10px] md:text-xs font-bold text-gray-500 uppercase tracking-wider">Isha</th>
                                        <th class="px-3 md:px-6 py-4 text-center text-[10px] md:text-xs font-bold text-gray-500 uppercase tracking-wider">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($schedules as $item)
                                    <tr class="{{ $item->date->isToday() ? 'bg-blue-50/50' : '' }} hover:bg-gray-50 transition-colors">
                                        <td class="px-3 md:px-6 py-4 whitespace-nowrap text-xs md:text-sm font-semibold text-gray-900">
                                            {{ $item->date->format('M d') }}
                                            <span class="hidden md:inline">{{ $item->date->format(', Y') }}</span>
                                            @if($item->date->isToday())
                                                <span class="block md:inline-flex items-center px-1.5 py-0.5 rounded-full text-[8px] md:text-[10px] font-bold bg-blue-100 text-blue-700 md:ml-2">TODAY</span>
                                            @endif
                                        </td>
                                        <td class="px-3 md:px-6 py-4 whitespace-nowrap text-[10px] md:text-sm text-gray-600 font-medium">{{ $item->fajr }}</td>
                                        <td class="px-3 md:px-6 py-4 whitespace-nowrap text-[10px] md:text-sm text-gray-600 font-medium">{{ $item->dhuhr }}</td>
                                        <td class="px-3 md:px-6 py-4 whitespace-nowrap text-[10px] md:text-sm text-gray-600 font-medium">{{ $item->asr }}</td>
                                        <td class="px-3 md:px-6 py-4 whitespace-nowrap text-[10px] md:text-sm text-gray-600 font-medium">{{ $item->maghrib }}</td>
                                        <td class="px-3 md:px-6 py-4 whitespace-nowrap text-[10px] md:text-sm text-gray-600 font-medium">{{ $item->isha }}</td>
                                        <td class="px-3 md:px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                            <div class="flex items-center justify-center gap-1 md:gap-3">
                                                <button type="button" 
                                                    onclick="openEditScheduleModal({{ $item->id }}, '{{ $item->date->format('Y-m-d') }}', '{{ $item->fajr }}', '{{ $item->dhuhr }}', '{{ $item->asr }}', '{{ $item->maghrib }}', '{{ $item->isha }}')"
                                                    class="w-7 h-7 md:w-8 md:h-8 flex items-center justify-center rounded-lg text-blue-600 hover:bg-blue-50 transition-colors" title="Edit">
                                                    <i class="ti ti-edit text-sm md:text-lg"></i>
                                                </button>
                                                <form action="{{ route('admin.prayer.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete this record?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="w-7 h-7 md:w-8 md:h-8 flex items-center justify-center rounded-lg text-red-500 hover:bg-red-50 transition-colors" title="Delete">
                                                        <i class="ti ti-trash text-sm md:text-lg"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>

                <!-- Visual View (PDF/Image) -->
                @if(@$setting->monthly_schedule_file)
                <div id="view-visual" class="hidden h-full min-h-[500px]">
                    <div class="h-full w-full rounded-xl overflow-hidden border">
                        @if(Str::endsWith(@$setting->monthly_schedule_file, '.pdf'))
                            <iframe src="{{ asset(@$setting->monthly_schedule_file) }}" class="w-full h-full" frameborder="0"></iframe>
                        @else
                            <div class="w-full h-full overflow-auto bg-gray-100 flex items-start justify-center p-4">
                                <img src="{{ image(@$setting->monthly_schedule_file) }}" class="max-w-full h-auto shadow-lg" alt="Monthly Schedule">
                            </div>
                        @endif
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
    /* Decision: Forcefully hide Dropify elements globally when any modal is open to prevent overlapping */
    body.modal-open .dropify-preview,
    body.modal-open .dropify-wrapper,
    body.modal-open .dropify-loader,
    body.modal-open .dropify-errors-container {
        display: none !important;
        visibility: hidden !important;
        opacity: 0 !important;
        pointer-events: none !important;
        z-index: -1 !important;
    }
</style>

<!-- Edit Schedule Modal -->
<div id="editScheduleModal" class="fixed inset-0 bg-black/50 z-[10000] hidden overflow-y-auto backdrop-blur-sm">
    <div class="min-h-full flex items-start md:items-center justify-center p-2 md:p-4">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-lg overflow-hidden relative">
            <!-- Mobile Close Button -->
            <button onclick="closeEditScheduleModal()" class="md:hidden absolute top-3 right-3 z-[100] w-8 h-8 flex items-center justify-center bg-red-500 text-white rounded-full shadow-lg">
                <i class="ti ti-x text-xl"></i>
            </button>

            <div class="bg-primary-600 p-4 text-white flex justify-between items-center">
                <h4 class="font-bold">Edit Prayer Schedule: <span id="modalDate"></span></h4>
                <button type="button" onclick="closeEditScheduleModal()" class="hidden md:flex text-white hover:text-gray-200">
                    <i class="ti ti-x text-xl"></i>
                </button>
            </div>
        <form id="editScheduleForm" method="POST" class="p-6">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-2 gap-4">
                @foreach(['fajr', 'dhuhr', 'asr', 'maghrib', 'isha'] as $p)
                <div class="space-y-1">
                    <label class="block text-xs font-bold text-gray-500 uppercase">{{ $p }}</label>
                    <input type="text" name="{{ $p }}" id="modal_{{ $p }}" required class="w-full border rounded p-2 text-sm focus:border-primary-500 outline-none">
                </div>
                @endforeach
            </div>
            <div class="mt-6 flex justify-end gap-3">
                <button type="button" onclick="closeEditScheduleModal()" class="px-4 py-2 text-gray-500 hover:bg-gray-100 rounded-lg transition font-bold">Cancel</button>
                <button type="submit" class="px-6 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition font-bold shadow-lg">Update Schedule</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function switchScheduleTab(tab) {
        const tableBtn = document.getElementById('tab-table');
        const visualBtn = document.getElementById('tab-visual');
        const tableView = document.getElementById('view-table');
        const visualView = document.getElementById('view-visual');

        if (tab === 'table') {
            tableBtn.classList.add('border-blue-600', 'text-blue-600');
            tableBtn.classList.remove('border-transparent', 'text-gray-500');
            if (visualBtn) {
                visualBtn.classList.remove('border-blue-600', 'text-blue-600');
                visualBtn.classList.add('border-transparent', 'text-gray-500');
            }
            tableView.classList.remove('hidden');
            if (visualView) visualView.classList.add('hidden');
        } else {
            visualBtn.classList.add('border-blue-600', 'text-blue-600');
            visualBtn.classList.remove('border-transparent', 'text-gray-500');
            tableBtn.classList.remove('border-blue-600', 'text-blue-600');
            tableBtn.classList.add('border-transparent', 'text-gray-500');
            visualView.classList.remove('hidden');
            tableView.classList.add('hidden');
        }
    }

    function openFullScheduleModal() {
        document.getElementById('fullScheduleModal').classList.remove('hidden');
        document.body.classList.add('modal-open');
        document.body.style.overflow = 'hidden'; 
    }

    function closeFullScheduleModal() {
        document.getElementById('fullScheduleModal').classList.add('hidden');
        document.body.classList.remove('modal-open');
        document.body.style.overflow = '';
    }

    function openEditScheduleModal(id, date, fajr, dhuhr, asr, maghrib, isha) {
        document.getElementById('modalDate').innerText = date;
        document.getElementById('modal_fajr').value = fajr;
        document.getElementById('modal_dhuhr').value = dhuhr;
        document.getElementById('modal_asr').value = asr;
        document.getElementById('modal_maghrib').value = maghrib;
        document.getElementById('modal_isha').value = isha;
        
        const form = document.getElementById('editScheduleForm');
        form.action = `/admin/prayer-schedule/${id}`;
        
        document.getElementById('editScheduleModal').classList.remove('hidden');
    }

    function closeEditScheduleModal() {
        document.getElementById('editScheduleModal').classList.add('hidden');
    }

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            closeEditScheduleModal();
            closeFullScheduleModal();
        }
    });
</script>
@endpush
</div>
@endsection
