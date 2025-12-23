@extends('masjid.layout')

@section('title', 'Home')

@section('content')
<section>
    <!-----herosection-->
    <section class="max-w-[1320px] px-5 xl:px-0 mx-auto mt-7 lg:mt-[77px] overflow-hidden relative">
        <div class="max-w-[743px] mx-auto flex flex-col items-center text-center">
            <img src="{{ image(@$setting->hero_logo, 'masjid/images/arbilogo2.png', '200x200', 'Hero Logo') }}" alt="image" class="w-auto hidden lg:block" />
            <span class="lg:mt-7 text-xl md:text-[32px] capitalize font-medium text-[var(--primary-2)]">{{ @$setting->hero_title }}</span>
            <span class="text-sm md:text-xl text-[var(--grey-500)] mt-2 md:mt-4">{{ @$setting->hero_subtitle }}</span>
            <!-- ----videosection -->
            @php $homeVideoId = @$setting->video_id ?? 'tQHAwV9B8hQ'; @endphp
            <div class="max-w-[743px] w-full mt-6 rounded-[30px] overflow-hidden relative cursor-pointer group" onclick="playVideo('{{ $homeVideoId }}')">
                <img src="{{ image(@$setting->video_thumbnail, 'masjid/images/heroimg.png', '743x418', 'Video Thumbnail') }}" class="w-full h-full object-cover rounded-[30px]" alt="Video Thumbnail">
                <div class="absolute inset-0 flex justify-center items-center bg-black/20 group-hover:bg-black/40 transition-all">
                    <div class="w-16 h-16 bg-white/90 rounded-full flex justify-center items-center pl-1 group-hover:scale-110 transition-transform shadow-lg">
                        <i class="ti ti-player-play-filled text-[var(--primary-1)] text-3xl"></i>
                    </div>
                </div>
            </div>

            <div class="lg:flex flex-col hidden gap-y-0.5 items-center absolute left-0 sm:left-5 bottom-50">
                <div onclick="scrolltoPrayer()" class="w-12 h-12 flex justify-center cursor-pointer items-center bg-[var(--primary-1)] rounded-full animate-bounce">
                    <i class="ti ti-arrow-down text-white text-2xl"></i>
                </div>
                <span class="text-xs md:text-base text-[var(--primary-2)]">Prayer Time</span>
            </div>
            <!------progressbar-->
            <div class="max-w-[743px] mx-auto py-6 px-4 md:px-16 mt-6 md:mt-[30px] border border-[var(--grey-300)] flex flex-col rounded-[20px] bg-white shadow-sm w-full">
                <div class="w-full relative px-2">
                    <div class="w-full h-[8px] bg-[var(--grey-300)] rounded-full"></div>
                    @php
                        $percentage = @$setting->donation_goal > 0 ? (@$setting->donation_raised / @$setting->donation_goal) * 100 : 0;
                        $percentage = min($percentage, 100);
                    @endphp
                    <div class="absolute inset-x-2 bottom-0 h-[8px] bg-[var(--primary-2)] rounded-full transition-all duration-1000 shadow-md" style="width: calc({{ $percentage }}% - 16px)"></div>
                </div>
                <div class="flex justify-between items-center w-full mt-3 px-2">
                    <div class="text-left">
                        <span class="text-xs sm:text-base text-black-400">Donation Raised : </span>
                        <span class="text-sm sm:text-md font-medium text-black-900">$ {{ number_format(@$setting->donation_raised, 2) }}</span>
                    </div>
                    <div class="text-right">
                        <span class="text-xs sm:text-base text-black-400">Donation Goal : </span>
                        <span class="text-sm sm:text-md font-medium text-black-900">$ {{ number_format(@$setting->donation_goal, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-----textScrollling section-->
    <section class="max-w-[1320px] px-5 xl:px-0 mx-auto mt-3 md:mt-12 overflow-hidden">
        <div class="py-2 sm:py-6 relative w-full">
            <marquee direction="left" class="">
                <div class="text-lg md:text-[32px] font-medium min-w-[343px]">
                    <span class="bg-linear-to-r from-[#049304] to-[#03590D] bg-clip-text text-transparent">
                        Our Donors :
                    </span>
                    @if(isset($donors))
                        @foreach($donors as $donor)
                        <span class="bg-linear-to-r from-[#049304] to-[#03590D] bg-clip-text text-transparent pl-5">{{ $donor->name }} (${{ number_format($donor->amount, 2) }}) <span class="pl-5">✦</span></span>
                        @endforeach
                    @endif
                </div>
            </marquee>
            <div class="w-[70px] sm:w-[128px] h-full absolute left-0 bg-gradient-to-r from-white to-transparent top-0"></div>
            <div class="w-[70px] sm:w-[128px] h-full rotate-180 absolute right-0 bg-gradient-to-r from-white to-transparent top-0"></div>
        </div>
    </section>
    <!--------hadithSection-->
    <section class="max-w-[1320px] mt-3 md:mt-12 px-5 xl:px-0 mx-auto overflow-hidden">
        <div class="w-full py-6 md:py-12 flex bg-[var(--primary-2)] relative justify-center items-center text-center text-white text-sx md:text-2xl rounded-[20px]">
            <span class="md:px-[100px]">
                "{{ @$setting->quote ?: 'Wealth does not come from having great riches; wealth comes from contentment' }}"
                - {{ @$setting->quote_author ?: 'Prophet Muhammad (PBUH)' }}
            </span>
            <img src="{{ image('masjid/images/cornerhadith1.png', null, '100x100', 'H') }}" alt="image" class="hidden md:block absolute left-[-10px] top-[-40px]" />
            <img src="{{ image('masjid/images/cornerhadith2.png', null, '100x100', 'H') }}" alt="image" class="hidden md:block absolute right-[-50px] bottom-[-30px]" />
        </div>
    </section>
    <!--------prayertime section-->
    <section id="prayer-section" class="max-w-[1320px] px-5 xl:px-0 mx-auto mt-6 lg:mt-[130px] overflow-hidden">
        <h3 class="text-xl md:text-[32px] text-[var(--primary-2)] font-medium text-center capitalize">
            prayer time
        </h3>
        <div class="grid grid-cols-12 gap-y-6 gap-x-6 mt-10">
            <div class="col-span-12 lg:col-span-6">
                <div class="flex flex-col gap-y-[18px] px-[30px] py-[30px] rounded-[20px] bg-[var(--grey-50)] border border-[var(--grey-200)] h-full">
                    <h3 class="capitalize text-lg md:text-[28px] font-medium text-[var(--primary-2)]">
                        Prayer Time
                    </h3>
                    <div class="flex flex-col gap-y-[10px] flex-1 justify-center">
                        
                        @foreach(['fajr', 'dhuhr', 'asr', 'maghrib', 'isha'] as $prayer)
                        <div class="grid grid-cols-2 py-3 border-b border-[#A6E9C2] text-xs sm:text-lg text-[var(--grey-600)]">
                            <span class="capitalize">{{ $prayer }}</span>
                            <span class="text-right font-medium text-[var(--primary-1)]">{{ $prayerTimes[$prayer] ?? '-' }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-span-12 lg:col-span-6">
                <div class="w-full flex flex-col gap-y-4 h-full">
                    <div class="w-full px-6 py-6 flex flex-col gap-y-[15px] rounded-[20px] bg-[var(--primary-2)] text-white flex-1 justify-center">
                        <h3 class="text-lg md:text-[32px] text-white font-medium capitalize">
                            Jummah Prayer
                        </h3>
                        <p class="text-sm md:text-xl text-white font-medium capitalize">
                            every friday
                        </p>
                        <p class="text-md md:text-2xl text-white font-medium capitalize">
                            {{ @$setting->jummah_time ?? '1:00 PM' }}
                        </p>
                        <!-- @php
                            $isFriday = now()->isFriday();
                            $showLive = $isFriday && now()->hour >= 11 && now()->hour <= 15;
                        @endphp -->
                        
                        @if(@$setting->jummah_live_link)
                        <div class="relative">
                            <span class="absolute -top-2 -right-2 flex h-3 w-3">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500"></span>
                            </span>
                            <a href="{{ @$setting->jummah_live_link }}" target="_blank" class="flex items-center justify-center gap-x-[10px] py-3 px-3 rounded-[10px] bg-white cursor-pointer hover:bg-gray-100 transition-all shadow-md group">
                                <span class="text-[var(--primary-1)] capitalize font-bold group-hover:scale-105 transition-transform">Join Live Khutbah</span>
                                <i class="ti ti-brand-youtube-filled text-red-600 text-2xl group-hover:animate-pulse"></i>
                            </a>
                        </div>
                        @elseif(@$setting->jummah_live_link)
                        <div class="flex items-center justify-center gap-x-[10px] py-3 px-3 rounded-[10px] bg-white/10 border border-white/20">
                            <span class="text-white/60 text-xs text-center font-medium italic">Live Khutbah available every Friday ({{ @$setting->jummah_time ?? '1:30 PM' }})</span>
                        </div>
                        @endif
                    </div>
                    <div class="w-full px-6 py-8 flex flex-col gap-y-[18px] rounded-[20px] bg-[var(--grey-50)] border border-[var(--grey-200)] flex-1 justify-center">
                        <h3 class="text-lg md:text-[32px] text-[var(--primary-2)] font-medium capitalize">
                            Monthly Prayer Times
                        </h3>
                        <p class="text-sm md:text-xl text-[var(--grey-700)] font-medium capitalize leading-tight">
                            Download complete prayer schedule for the month
                        </p>
                        @if(@$setting->monthly_schedule_file)
                        <a href="{{ asset(@$setting->monthly_schedule_file) }}" target="_blank" class="flex items-center justify-center gap-x-[10px] py-3 px-3 rounded-[10px] bg-[var(--primary-1)] cursor-pointer hover:bg-[var(--primary-2)] transition-colors">
                            <span class="text-white capitalize font-medium">Download PDF</span>
                            <i class="ti ti-book-upload text-white text-2xl"></i>
                        </a>
                        @else
                        <div class="flex items-center justify-center gap-x-[10px] py-3 px-3 rounded-[10px] bg-gray-300 cursor-not-allowed">
                            <span class="text-white capitalize font-medium">Schedule Not Available</span>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-------islamicclasses------->
    <section id="class" class="bg-class-container mt-6 md:mt-[130px] w-full py-7 lg:py-[130px]">
        <div class="max-w-[1320px] px-5 xl:px-0 mx-auto overflow-hidden">
            <h3 class="capitalize text-xl md:text-[32px] text-center font-medium text-[var(--primary-2)]">
                islamic classes
            </h3>
            @if(session('success'))
            <div class="max-w-[800px] mx-auto mt-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-md text-center" role="alert">
                 <p class="font-bold text-lg">Success</p>
                 <p>{{ session('success') }}</p>
            </div>
            @endif
            <div class="grid grid-cols-12 gap-6 mt-12">
                <!-- Adult Column -->
                <div class="col-span-12 lg:col-span-6 px-[30px] py-[30px] bg-white border border-[var(--grey-200)] rounded-[20px]">
                    <h3 class="capitalize text-lg md:text-[28px] font-medium text-[var(--primary-2)]">Adult classes</h3>
                    <div class="flex flex-col gap-y-6 mt-8">
                        @foreach($classes->where('category', 'Adults') as $class)
                        <div class="flex flex-col gap-y-3 sm:flex-row justify-between items-center gap-x-2">
                             <div class="flex gap-x-2 items-stretch max-w-[456px]">
                                <img src="{{ image($class->image, 'masjid/images/classframe.png', '80x80', 'Class') }}" alt="image" class="w-20 h-20 object-cover rounded-lg flex-shrink-0" />
                                <div class="flex flex-col justify-center">
                                    <span class="text-md md:text-lg font-medium text-[var(--grey-500)]">{{ $class->title }}</span>
                                    <span class="text-xs text-[var(--grey-500)] line-clamp-2">{{ $class->description }}</span>
                                    <span class="text-[var(--primary-1)] text-xs md:text-sm font-semibold mt-1">
                                        {{ $class->days }} {{ $class->time }}
                                    </span>
                                </div>
                            </div>
                            <div onclick="showClassModal({{ $class->id }})" class="flex items-center justify-center w-full sm:w-[104px] gap-x-[10px] py-2  px-3 rounded-[10px] bg-[var(--primary-1)] hover:bg-[var(--primary-2)] cursor-pointer transition-colors flex-shrink-0">
                                <span class="text-white capitalize text-xs sm:text-base font-medium">Register</span>
                            </div>
                        </div>
                        @endforeach
                         @if($classes->whereIn('category', ['Adults', 'Women', 'General'])->isEmpty())
                            <p class="text-gray-500 text-sm text-center italic">No adult classes available currently.</p>
                        @endif
                    </div>
                </div>

                <!-- Kids Column -->
                <div class="col-span-12 lg:col-span-6 px-[30px] py-[30px] bg-white border border-[var(--grey-200)] rounded-[20px]">
                     <h3 class="capitalize text-lg md:text-[28px] font-medium text-[var(--primary-2)]">Child classes</h3>
                     <div class="flex flex-col gap-y-6 mt-8">
                        @foreach($classes->where('category', 'Kids') as $class)
                         <div class="flex flex-col gap-y-3 sm:flex-row justify-between items-center gap-x-2">
                             <div class="flex gap-x-2 items-stretch max-w-[456px]">
                                <img src="{{ image($class->image, 'masjid/images/classframe.png', '80x80', 'Class') }}" alt="image" class="w-20 h-20 object-cover rounded-lg flex-shrink-0" />
                                <div class="flex flex-col justify-center">
                                    <span class="text-md md:text-lg font-medium text-[var(--grey-500)]">{{ $class->title }}</span>
                                    <span class="text-xs text-[var(--grey-500)] line-clamp-2">{{ $class->description }}</span>
                                    <span class="text-[var(--primary-1)] text-xs md:text-sm font-semibold mt-1">
                                        {{ $class->days }} {{ $class->time }}
                                    </span>
                                </div>
                            </div>
                            <div onclick="showClassModal({{ $class->id }})" class="flex items-center justify-center w-full sm:w-[104px] gap-x-[10px] py-2  px-3 rounded-[10px] bg-[var(--primary-1)] hover:bg-[var(--primary-2)] cursor-pointer transition-colors flex-shrink-0">
                                <span class="text-white capitalize text-xs sm:text-base font-medium">Register</span>
                            </div>
                        </div>
                        @endforeach
                        @if($classes->where('category', 'Kids')->isEmpty())
                            <p class="text-gray-500 text-sm text-center italic">No child classes available currently.</p>
                        @endif
                     </div>
                </div>
            </div>
        </div>
    </section>
    <!--------our services-->
    <section id="service-section" class="max-w-[1320px] mt-6 md:mt-[130px] px-5 xl:px-0 mx-auto overflow-hidden">
        <h3 class="text-xl md:text-[32px] text-[var(--primary-2)] font-medium text-center capitalize">
            our services
        </h3>
        <div class="grid grid-cols-1 mt-10 sm:grid-cols-2 xl:grid-cols-3 gap-6">
            @forelse($services as $service)
            <div class="flex flex-col justify-center items-center text-center">
                <div class="flex justify-center items-center w-[112px] h-[112px] rounded-full bg-[var(--grey-200)]">
                    <i class="ti {{ $service->icon ?? 'ti-help' }} text-[var(--primary-1)] text-[54px]"></i>
                </div>
                <span class="text-lg sm:text-[28px] font-medium text-[var(--primary-1)] mt-4">{{ $service->title }}</span>
                <span class="text-xs sm:text-base text-[var(--grey-600)] sm:px-16 mt-4">
                    {{ Str::limit($service->description, 120) }}
                </span>
                <a href="{{ route('masjid.services.detail', $service->slug) }}">
                    <div class="flex items-center mt-6 justify-center gap-x-[10px] py-3 px-4 rounded-[10px] bg-[var(--primary-1)] cursor-pointer hover:bg-[var(--primary-2)] transition-colors">
                        <span class="text-white capitalize font-medium">Read More</span>
                        <i class="ti ti-arrow-right text-white text-2xl"></i>
                    </div>
                </a>
            </div>
            @empty
            <div class="col-span-full py-10 text-center text-gray-500 italic">
                No services available at the moment.
            </div>
            @endforelse
        </div>
    </section>

    <!-----gallery-->
    <section id="gallery" class="max-w-[1320px] my-6 md:my-[130px] px-5 xl:px-0 mx-auto overflow-hidden">
        <h3 class="text-xl mb-10 md:text-[32px] text-[var(--primary-2)] font-medium text-center capitalize">
            community gallery
        </h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($galleryImages as $image)
            <div class="relative group max-w-[412px] h-[290px] rounded-[20px] overflow-hidden cursor-pointer shadow-lg">
                <a href="{{ route('masjid.gallery') }}">
                    <div class="w-full h-full">
                        <img src="{{ image($image->image, null, '412x290', 'Gallery') }}" alt="{{ $image->title }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" />
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent translate-y-[100%] group-hover:translate-y-0 transition-transform duration-500 ease-out flex flex-col justify-end p-6">
                        <div class="flex flex-col items-center text-center">
                            <i class="ti ti-eye text-white text-3xl mb-2"></i>
                            <h4 class="text-white text-lg sm:text-xl font-bold leading-tight">{{ $image->title }}</h4>
                            @if($image->event_name)
                                <p class="text-white/80 text-xs sm:text-sm mt-1 uppercase tracking-wider">{{ $image->event_name }}</p>
                            @endif
                            @if($image->event_time)
                                <p class="text-[var(--primary-1)] text-[10px] mt-2 font-bold">{{ $image->event_time }}</p>
                            @endif
                        </div>
                    </div>
                </a>
            </div>
            @empty
                <div class="col-span-full py-10 text-center text-gray-400 italic">
                    Images are coming soon to our gallery.
                </div>
            @endforelse
        </div>
        <div class="flex justify-center mt-6 items-center">
            <a href="{{ route('masjid.gallery') }}">
                <div class="flex items-center gap-x-[10px] py-3 px-3 rounded-[10px] bg-[var(--primary-1)] hover:bg-[var(--primary-2)] cursor-pointer">
                    <span class="text-white capitalize font-medium">view all</span>
                    <i class="ti ti-arrow-right text-white text-xl"></i>
                </div>
            </a>
        </div>
    </section>
    <!---join our community-->
    <section id="community" class="bg-green-100 w-full py-7 lg:py-[60px]">
        <h3 class="capitalize text-xl md:text-[32px] text-center font-medium text-[var(--primary-2)]">
            join our community
        </h3>
        <div class="max-w-[1320px] px-5 xl:px-0 mx-auto w-full mt-10">
            @if(session('success_community'))
                <div class="max-w-[760px] mx-auto mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative text-center" role="alert">
                    <span class="font-bold">Success!</span>
                    <span class="block sm:inline">{{ session('success_community') }}</span>
                </div>
            @endif
            <form action="{{ route('masjid.join_community') }}" method="POST" class="max-w-[760px] mx-auto px-6 py-6 bg-white rounded-[10px] space-y-4">
                @csrf
                <div class="flex flex-col gap-y-1">
                    <label for="name" class="text-[var(--grey-500)] text-xs sm:text-base font-medium capitalize">Name <span class="text-red-500">*</span></label>
                    <input type="text" id="name" name="name" value="" placeholder="Enter Your Name" required class="py-2 sm:py-3 px-4 border border-[var(--grey-300)] outline-none focus:outline-none focus:border-amber-600 text-xs sm:text-base text-[var(--grey-600)] sm:rounded-[16px] rounded-lg placeholder:text-[var(--grey-400)]" />
                </div>
                <div class="flex flex-col gap-y-1">
                    <label for="email" class="text-[var(--grey-500)] text-xs sm:text-base font-medium capitalize">Email <span class="text-red-500">*</span></label>
                    <input type="email" id="email" name="email" value="" placeholder="Enter Your Email" required class="py-2 sm:py-3 px-4 text-xs sm:text-base border border-[var(--grey-300)] outline-none focus:outline-none focus:border-amber-600 text-[var(--grey-600)] rounded-lg sm:rounded-[16px] placeholder:text-[var(--grey-400)]" />
                </div>
                <div class="flex flex-col gap-y-1">
                    <label for="phone-number" class="text-[var(--grey-500)] text-xs sm:text-base font-medium capitalize">phone number <span class="text-red-500">*</span></label>
                    <input type="text" id="phone-number" name="phoneNumber" value="" placeholder="Enter Your PhoneNumber" required class="py-2 sm:py-3 px-4 text-xs sm:text-base border border-[var(--grey-300)] outline-none focus:outline-none focus:border-amber-600 text-[var(--grey-600)] rounded-lg sm:rounded-[16px] placeholder:text-[var(--grey-400)]" />
                </div>
                <button class="text-center bg-[var(--primary-1)] w-full py-2 sm:py-3 text-white text-xs sm:text-base font-medium flex justify-center items-center cursor-pointer gap-x-1 hover:bg-[var(--primary-2)] text-center rounded-lg sm:rounded-[16px]" type="submit">
                    <span>Submit</span>
                    <i class="ti ti-arrow-right text-white text-xl"></i>
                </button>
            </form>
        </div>
    </section>
</section>

<!------event-popup-->
@if($eventPopup)
<div id="event-container" class="fixed bottom-0 left-0 w-full z-[9999] transition-all duration-1000 ease-out translate-y-[200%] opacity-0">
    <div class="max-w-[1320px] mx-auto px-5 xl:px-0">
        <div class="bg-white border border-gray-200 shadow-2xl rounded-[20px] p-6 flex flex-col sm:flex-row justify-between items-center gap-4">
            
            <div class="flex flex-col text-center sm:text-start">
                <span class="text-xl md:text-[28px] font-bold text-green-600 leading-tight">
                    {{ $eventPopup->event_name }}
                </span>
                <span class="text-sm sm:text-base text-gray-500 mt-1">
                    {{ $eventPopup->event_datetime->format('n/j/Y, g:i A') }}
                </span>
                <span class="text-xs sm:text-sm text-gray-600 mt-2">
                    {{ $eventPopup->message }}
                </span>
            </div>

            <div onclick="document.getElementById('event-container').classList.add('translate-y-[200%]', 'opacity-0')" 
                 class="px-4 py-2 bg-red-400 hover:bg-red-500 text-white text-sm sm:text-base flex gap-x-2 items-center font-bold rounded-xl cursor-pointer transition-all active:scale-95">
                <i class="ti ti-x"></i>
                <span>Skip</span>
            </div>
            
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const eventContainer = document.getElementById('event-container');
    if (eventContainer) {
        // Logic: Show only once per tab session, UNLESS it's a page refresh
        const hasSeenInSession = sessionStorage.getItem('event_popup_seen');
        
        // Detect refresh/reload across different browsers
        let isReload = false;
        if (window.performance && window.performance.navigation) {
            isReload = window.performance.navigation.type === 1;
        }
        const navEntries = window.performance.getEntriesByType('navigation');
        if (navEntries.length > 0 && navEntries[0].type === 'reload') {
            isReload = true;
        }

        if (!hasSeenInSession || isReload) {
            setTimeout(() => {
                eventContainer.classList.remove('translate-y-[200%]', 'opacity-0');
                sessionStorage.setItem('event_popup_seen', 'true');
            }, 500);
        }
    }

    // Prayer Highlighting Logic
    function highlightCurrentPrayer() {
        const rows = document.querySelectorAll('#prayer-section .grid-cols-2.py-3.border-b');
        const now = new Date();
        const currentTime = now.getHours() * 60 + now.getMinutes();

        let nextPrayerIndex = -1;
        
        // Map prayer times from the UI
        const prayers = Array.from(rows).slice(1).map((row, index) => {
            const timeStr = row.querySelector('span:last-child').innerText.trim();
            if (timeStr === '-') return null;
            
            // Parse "05:45 AM"
            const [time, modifier] = timeStr.split(' ');
            let [hours, minutes] = time.split(':').map(Number);
            if (modifier === 'PM' && hours < 12) hours += 12;
            if (modifier === 'AM' && hours === 12) hours = 0;
            
            return { index, totalMinutes: hours * 60 + minutes };
        }).filter(p => p !== null);

        // Find the next prayer
        for (let i = 0; i < prayers.length; i++) {
            if (prayers[i].totalMinutes > currentTime) {
                nextPrayerIndex = prayers[i].index;
                break;
            }
        }

        // Default to Isha if all passed
        if (nextPrayerIndex === -1 && prayers.length > 0) nextPrayerIndex = prayers.length - 1;

        // Apply highlighting to the matching row (offset by 1 because of the header row)
        if (nextPrayerIndex !== -1) {
            const targetRow = rows[nextPrayerIndex + 1];
            targetRow.classList.add('bg-green-50', 'border-green-400', 'px-2', '-mx-2', 'rounded', 'shadow-sm', 'scale-[1.02]', 'transition-all', 'duration-500');
            targetRow.querySelector('span:first-child').classList.add('font-bold');
            targetRow.querySelector('span:last-child').innerHTML += ' <span class="text-[10px] bg-green-100 px-1 rounded animate-pulse">NEXT</span>';
        }
    }

    highlightCurrentPrayer();
});
</script>
@endif

@endsection
