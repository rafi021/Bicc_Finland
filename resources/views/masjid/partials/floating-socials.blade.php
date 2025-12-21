
<div class="flex flex-col items-end gap-y-3 fixed right-5 bottom-8 z-[60]">
    @if(@$setting->whatsapp)
        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', @$setting->whatsapp) }}" target="_blank" class="hover:scale-110 transition-transform active:scale-95">
            <img src="{{ asset('masjid/images/whatsapp.png') }}" alt="whatsapp" class="w-10 sm:w-12 shadow-xl rounded-full border-2 border-white" />
        </a>
    @endif
    @if(@$setting->twitter)
        <a href="{{ @$setting->twitter }}" target="_blank" class="hover:scale-110 transition-transform active:scale-95">
            <img src="{{ asset('masjid/images/x.png') }}" alt="x" class="w-10 sm:w-12 shadow-xl rounded-full border-2 border-white" />
        </a>
    @endif
    @if(@$setting->facebook)
        <a href="{{ @$setting->facebook }}" target="_blank" class="hover:scale-110 transition-transform active:scale-95">
            <img src="{{ asset('masjid/images/facebook.png') }}" alt="facebook" class="w-10 sm:w-12 shadow-xl rounded-full border-2 border-white" />
        </a>
    @endif
    
    <div onclick="showDonateModal()" class="flex items-center gap-x-3 py-3 px-5 rounded-full bg-[var(--primary-1)] hover:bg-[var(--primary-2)] cursor-pointer shadow-2xl transition-all hover:-translate-y-1 active:scale-90 group relative overflow-hidden">
        <span class="text-white text-xs sm:text-base capitalize font-black group-hover:tracking-wider transition-all">donate us</span>
        <div class="bg-white/20 p-1 rounded-full">
            <i class="ti ti-heart-handshake text-white text-xl sm:text-2xl animate-pulse"></i>
        </div>
    </div>
</div>
