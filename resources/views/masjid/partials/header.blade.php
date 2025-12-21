

<header class="max-w-[1320px] sticky top-2 px-5 xl:px-0 mx-auto z-50 bg-white overflow-hidden">
    <div class="flex justify-between items-center py-4 px-5 rounded-[12px] bg-white border border-[var(--grey-300)]">
        <a href="{{ route('mosque.home') }}">
           <img src="{{ image(@$setting->site_logo, 'masjid/images/logo.png', '159x18', 'Logo') }}" alt="logo" class="h-[18px]  w-[159px] object-contain" />
        </a>
        
        <div class="lg:flex gap-x-1 hidden">
            <!-- HOME -->
            <a id="nav-home" href="{{ route('mosque.home') }}" 
               class="px-3 py-3 rounded-[10px] cursor-pointer text-base font-medium uppercase {{ request()->routeIs('mosque.home') ? 'bg-green-600 text-white' : 'hover:bg-green-600 hover:text-white text-[var(--grey-600)]' }}">
                HOME
            </a>
            
            <!-- PRAYER TIME -->
            <div id="nav-prayer" onclick="scrolltoPrayer()" class="px-3 py-3 rounded-[10px] cursor-pointer hover:bg-green-600 hover:text-white text-[var(--grey-600)] text-base font-medium uppercase">
                PRAYER'S TIME
            </div>
            
            <!-- CLASSES -->
            <div id="nav-class" onclick="scrollToClass()" class="px-3 py-3 cursor-pointer hover:bg-green-600 hover:text-white rounded-[10px] text-[var(--grey-600)] text-base font-medium uppercase">
                CLASSES
            </div>
            
            <!-- SERVICES -->
            <a id="nav-services" href="{{ route('masjid.services') }}" 
               class="px-3 py-3 rounded-[10px] cursor-pointer text-base font-medium uppercase {{ request()->routeIs('masjid.services') || request()->routeIs('masjid.services.detail') ? 'bg-green-600 text-white' : 'hover:bg-green-600 hover:text-white text-[var(--grey-600)]' }}">
                SERVICES
            </a>
            
            <!-- GALLERY -->
            <a id="nav-gallery" href="{{ route('masjid.gallery') }}" 
               class="px-3 py-3 rounded-[10px] cursor-pointer text-base font-medium uppercase {{ request()->routeIs('masjid.gallery') ? 'bg-green-600 text-white' : 'hover:bg-green-600 hover:text-white text-[var(--grey-600)]' }}">
                GALLERY
            </a>
            
            <!-- COMMUNITY -->
            <div id="nav-community" onclick="scrollToCommunity()" class="px-3 py-3 cursor-pointer hover:bg-green-600 hover:text-white rounded-[10px] text-[var(--grey-600)] text-base font-medium uppercase">
                COMMUNITY
            </div>
        </div>
        
        <img src="{{ image(@$setting->site_logo, 'masjid/images/arbilogo.png', '40x40', 'Logo') }}" alt="logo" class="block h-10 w-auto object-contain max-[300px]:hidden lg:hidden" />
        
        <div onclick="showDonateModal()" class="lg:flex items-center gap-x-[10px] py-3 px-5 rounded-[12px] bg-[var(--primary-1)] hover:bg-[var(--primary-2)] cursor-pointer hidden shadow-md transition-all hover:scale-105 active:scale-95 group">
            <span class="text-white capitalize font-black group-hover:tracking-wide transition-all">donate us</span>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-heart-handshake group-hover:rotate-12 transition-transform">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" />
                <path d="M12 6l-3.293 3.293a1 1 0 0 0 0 1.414l.543 .543c.69 .69 1.81 .69 2.5 0l1 -1a3.182 3.182 0 0 1 4.5 0l2.25 2.25" />
                <path d="M12.5 15.5l2 2" />
                <path d="M15 13l2 2" />
            </svg>
        </div>
        
        <div onclick="showNavDrawer()" class="block lg:hidden">
            <i class="ti ti-menu-deep text-2xl"></i>
        </div>
    </div>
</header>
