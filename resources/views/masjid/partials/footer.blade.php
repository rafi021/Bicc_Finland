<footer class="w-full bg-[var(--primary-2)] text-white">
    <div
    class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-y-4 items-center  sm:items-start text-center sm:text-start max-w-[1320px] px-5 xl:px-0 mx-auto py-10"
    >
    <div class="flex flex-col items-center sm:items-start text-center sm:text-start max-w-[356px]">
        
        <span class="uppercase text-lg sm:text-2xl font-bold"
        >{{ @$setting->site_name ?? 'BICC FINLAND' }}</span
        >
        <span class="text-xs sm:text-base"
        >Building a stronger Muslim community through faith, education, and unity.</span
        >
        <div class="flex gap-x-1 items-center mt-4">
        <i class="ti ti-phone text-white text-md md:text-lg"></i>
        <span class="text-xs sm:text-base"> {{ @$setting->phone ?? '(555) 123-4567' }}</span>
        </div>
        <div class="flex gap-x-1 items-center mt-1">
        <i class="ti ti-home text-white text-md md:text-lg"></i>
        <span class="text-xs sm:text-base"
            >{{ @$setting->address ?? 'Malminkaari 9 A (3rd floor)' }}</span
        >
        </div>
        <div class="flex gap-x-1 items-center mt-1">
        <i class="ti ti-mail text-white text-md md:text-lg"></i>
        <span class="text-xs sm:text-base"> {{ @$setting->email ?? 'info@biccfinland.org' }}</span>
        </div>

        <!-- Social Media Icons -->
        <div class="flex gap-x-3 items-center mt-6">
            @if(@$setting->facebook)
                <a href="{{ @$setting->facebook }}" target="_blank" class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center hover:bg-[var(--primary-1)] transition-colors">
                    <i class="ti ti-brand-facebook text-white text-lg"></i>
                </a>
            @endif
            @if(@$setting->twitter)
                <a href="{{ @$setting->twitter }}" target="_blank" class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center hover:bg-[var(--primary-1)] transition-colors">
                    <i class="ti ti-brand-x text-white text-lg"></i>
                </a>
            @endif
            @if(@$setting->instagram)
                <a href="{{ @$setting->instagram }}" target="_blank" class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center hover:bg-[var(--primary-1)] transition-colors">
                    <i class="ti ti-brand-instagram text-white text-lg"></i>
                </a>
            @endif
            @if(@$setting->whatsapp)
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', @$setting->whatsapp) }}" target="_blank" class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center hover:bg-[var(--primary-1)] transition-colors">
                    <i class="ti ti-brand-whatsapp text-white text-lg"></i>
                </a>
            @endif
            @if(@$setting->youtube)
                <a href="{{ @$setting->youtube }}" target="_blank" class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center hover:bg-[var(--primary-1)] transition-colors">
                    <i class="ti ti-brand-youtube text-white text-lg"></i>
                </a>
            @endif
        </div>
    </div>
    <div class="flex flex-col capitalize gap-y-1 md:pl-30 lg:pl-30">
        <span class="text-lg sm:text-2xl font-bold">Quick Links</span>
        <div class="flex flex-col gap-y-1 text-xs sm:text-base">
        <span><a href="{{ route('masjid.about') }}">About Us</a></span>
        <span><a href="{{ route('masjid.contact') }}">Contact Us</a></span>
        <span class="cursor-pointer" onclick="scrolltoPrayer()"
            >Prayer Time</span
        >
        <span><a href="{{ route('masjid.services') }}">Services</a></span>
        <span class="cursor-pointer" onclick="scrollToClass()"
            >Classes</span
        >
        <span><a href="{{ route('masjid.gallery') }}">Gallery</a></span>
        <span class="cursor-pointer" onclick="scrollToCommunity()"
            >Community</span
        >
        </div>
    </div>
    <div class="flex flex-col items-center sm:items-start text-center sm:text-start">
        <span class="text-lg sm:text-2xl font-bold">Support Our Mission</span>
        <span class="text-xs sm:text-base  max-w-[294px]"
        >Help us build our permanent mosque and serve the community
        better.</span
        >
        <div class="flex justify-start mt-6">
        <div
            onclick="showDonateModal()"
            class="flex items-center gap-x-[12px] py-4 px-8 rounded-xl bg-[var(--primary-1)] hover:bg-[var(--primary-2)] cursor-pointer shadow-lg transition-all hover:scale-105 active:scale-95 group"
        >
            <span class="text-white capitalize font-black text-lg group-hover:tracking-wide transition-all">donate us</span>
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-heart-handshake group-hover:rotate-12 transition-transform">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" />
                <path d="M12 6l-3.293 3.293a1 1 0 0 0 0 1.414l.543 .543c.69 .69 1.81 .69 2.5 0l1 -1a3.182 3.182 0 0 1 4.5 0l2.25 2.25" />
                <path d="M12.5 15.5l2 2" />
                <path d="M15 13l2 2" />
            </svg>
        </div>
        </div>
    </div>
    </div>
</footer>