
<!---draweroverlay-->
<div id="drawer-overlay" onclick="closeNavDrawer()" class="w-full bg-black/50 z-[70] h-full fixed top-0 left-0 hidden transition-all duration-300 backdrop-blur-sm"></div>
<div id="drawer-menu" class="w-3/4 sm:w-1/2 bg-white z-[80] h-full fixed top-0 right-0 overflow-hidden translate-x-[100%] transition-all duration-500 px-6 pt-12 shadow-2xl">
    <div class="flex flex-col gap-y-4">
        <a href="{{ route('mosque.home') }}" class="group">
            <div class="px-5 py-4 rounded-xl cursor-pointer {{ request()->routeIs('mosque.home') ? 'bg-green-600 text-white shadow-md' : 'hover:bg-green-50 text-[var(--grey-600)] transition-colors' }} text-sm font-bold uppercase flex justify-between items-center">
                <span>HOME</span>
                <i class="ti ti-chevron-right opacity-0 group-hover:opacity-100 transition-all"></i>
            </div>
        </a>
        <div onclick="scrolltoPrayer(); closeNavDrawer()" class="px-5 py-4 rounded-xl cursor-pointer hover:bg-green-50 text-[var(--grey-600)] text-sm font-bold uppercase flex justify-between items-center transition-colors group">
            <span>PRAYER'S TIME</span>
            <i class="ti ti-clock opacity-0 group-hover:opacity-100 transition-all"></i>
        </div>
        <div onclick="scrollToClass(); closeNavDrawer()" class="px-5 py-4 rounded-xl cursor-pointer hover:bg-green-50 text-[var(--grey-600)] text-sm font-bold uppercase flex justify-between items-center transition-colors group">
            <span>CLASSES</span>
            <i class="ti ti-book-upload opacity-0 group-hover:opacity-100 transition-all"></i>
        </div>
        <a href="{{ route('masjid.services') }}" class="group">
            <div class="px-5 py-4 rounded-xl cursor-pointer {{ request()->routeIs('masjid.services') ? 'bg-green-600 text-white shadow-md' : 'hover:bg-green-50 text-[var(--grey-600)] transition-colors' }} text-sm font-bold uppercase flex justify-between items-center">
                <span>SERVICES</span>
                <i class="ti ti-chevron-right opacity-0 group-hover:opacity-100 transition-all"></i>
            </div>
        </a>
        <a href="{{ route('masjid.gallery') }}" class="group">
            <div class="px-5 py-4 rounded-xl cursor-pointer {{ request()->routeIs('masjid.gallery') ? 'bg-green-600 text-white shadow-md' : 'hover:bg-green-50 text-[var(--grey-600)] transition-colors' }} text-sm font-bold uppercase flex justify-between items-center">
                <span>GALLERY</span>
                <i class="ti ti-chevron-right opacity-0 group-hover:opacity-100 transition-all"></i>
            </div>
        </a>
        <div onclick="scrollToCommunity(); closeNavDrawer()" class="px-5 py-4 rounded-xl cursor-pointer hover:bg-green-50 text-[var(--grey-600)] text-sm font-bold uppercase flex justify-between items-center transition-colors group">
            <span>COMMUNITY</span>
            <i class="ti ti-users opacity-0 group-hover:opacity-100 transition-all"></i>
        </div>
    </div>
    
    <div class="mt-8 pt-8 border-t border-gray-100">
        <div onclick="showDonateModal(); closeNavDrawer()" class="flex justify-center items-center gap-x-3 py-4 rounded-xl bg-[var(--primary-1)] hover:bg-[var(--primary-2)] cursor-pointer shadow-lg active:scale-95 transition-all">
            <span class="text-white text-base capitalize font-black">donate us</span>
            <i class="ti ti-heart-handshake text-white text-2xl"></i>
        </div>
    </div>
</div>
