<div id="admin-sidebar"
    class="shrink-0 bg-gradient-to-b from-primary-900 to-primary-800 border-e border-primary-700 transition-all duration-300 hidden lg:block w-64 shadow-xl h-full">

    <div class="relative flex flex-col h-full max-h-full">
        <!-- Header -->
        @php 
            $logoPath = @$setting ? (@$setting->site_logo ?: @$setting->hero_logo) : null;
        @endphp
        <header class="p-5 border-b border-primary-700">
            <a class="flex items-center gap-3 group" href="{{ route('admin.dashboard') }}" aria-label="Brand">
                <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center shadow-lg overflow-hidden border border-white/20 transition-all group-hover:bg-white/20">
                    <img src="{{ image($logoPath, null, '40x40', 'Logo') }}" alt="Logo" class="w-full h-full object-contain p-1">
                </div>
                <div>
                    <h1 class="text-lg font-bold text-white group-hover:text-accent-300 transition-colors tracking-tight leading-none">{{ @$setting->site_name ?? 'CBG Mosque' }}</h1>
                    <span class="text-[10px] text-primary-300 uppercase font-bold tracking-widest mt-1 block">Management</span>
                </div>
            </a>
        </header>

        <!-- Navigation -->
        <nav class="flex-1 min-h-0 overflow-y-auto touch-pan-y scrollbar-thin scrollbar-thumb-primary-700 scrollbar-track-primary-900">
            <div class="pb-4 px-3 pt-4 w-full flex flex-col flex-wrap">
                <ul class="space-y-2">
                    <x-sidebar-link href="/admin" icon="home" route="admin"> Dashboard</x-sidebar-link>
                    <x-sidebar-link href="{{ route('admin.mosque.settings') }}" icon="settings" route="admin.mosque.settings"> Mosque Settings</x-sidebar-link>
                    <x-sidebar-link href="{{ route('admin.mosque.branding.edit') }}" icon="image" route="admin.mosque.branding.edit"> Header & Branding</x-sidebar-link>
                    <x-sidebar-link href="{{ route('admin.azan.time') }}" icon="clock" route="admin.azan.time"> Azan/Prayer Time</x-sidebar-link>
                    <x-sidebar-link href="{{ route('admin.mosque.quote.edit') }}" icon="message-square" route="admin.mosque.quote.edit"> Daily Hadith/Quote</x-sidebar-link>
                    <x-sidebar-link href="{{ route('admin.mosque.contact.edit') }}" icon="mail" route="admin.mosque.contact.edit"> Contact Info</x-sidebar-link>
                    <x-sidebar-link href="{{ route('admin.mosque.social_payment.edit') }}" icon="share" route="admin.mosque.social_payment.edit"> Social & Payment</x-sidebar-link>
                    <x-sidebar-link href="{{ route('admin.about.index') }}" icon="info" route="admin.about.*"> About Us Content</x-sidebar-link>
                    <x-sidebar-link href="{{ route('admin.classes.index') }}" icon="book" route="admin.classes.index"> Islamic Classes</x-sidebar-link>
                    <x-sidebar-link href="{{ route('admin.gallery-categories.index') }}" icon="layers" route="admin.gallery-categories.*"> Gallery Categories</x-sidebar-link>
                    <x-sidebar-link href="{{ route('admin.galleries.index') }}" icon="image" route="admin.galleries.*"> Gallery</x-sidebar-link>
                    <x-sidebar-link href="{{ route('admin.services.index') }}" icon="settings" route="admin.services.*"> Services</x-sidebar-link>
                    <x-sidebar-link href="{{ route('admin.service-requests.index') }}" icon="mail" route="admin.service-requests.*"> Service Requests</x-sidebar-link>
                    <x-sidebar-link href="{{ route('admin.contact-messages.index') }}" icon="message-circle" route="admin.contact-messages.*"> Contact Messages</x-sidebar-link>
                    <x-sidebar-link href="{{ route('admin.event-popups.index') }}" icon="bell" route="admin.event-popups.*"> Event Popups</x-sidebar-link>
                    <x-sidebar-link href="{{ route('admin.community.index') }}" icon="users" route="admin.community.index"> Community Joined</x-sidebar-link>
                    <x-sidebar-link href="{{ route('admin.donors.index') }}" icon="users" route="admin.donors.index"> Donors List</x-sidebar-link>
                </ul>

            </div>
        </nav>

        <!-- User Profile Footer -->
        <div class="mt-auto p-4 border-t border-primary-700">
            <div class="relative w-full">
                <button type="button" data-dropdown-toggle
                    class="w-full inline-flex items-center gap-x-3 p-3 text-start text-sm rounded-lg hover:bg-primary-700/50 focus:outline-none focus:bg-primary-700/50 transition-all group">
                    <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-accent-400 to-accent-600 flex items-center justify-center shadow-md">
                        <span class="text-white font-bold text-sm">A</span>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-semibold text-white">Admin</p>
                        <p class="text-xs text-primary-300">Administrator</p>
                    </div>
                    <svg class="w-4 h-4 text-primary-300 group-hover:text-white transition-colors" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="m7 15 5 5 5-5" />
                        <path d="m7 9 5-5 5 5" />
                    </svg>
                </button>
                <div
                    class="dropdown hidden absolute left-4 right-4 bottom-full mb-2 z-50 bg-white border border-gray-200 rounded-lg shadow-xl overflow-hidden">
                    <div class="p-1">
                        <form method="POST" action="{{ route('logout') }}" class="m-0">
                            @csrf
                            <button type="submit"
                                class="w-full text-left flex items-center gap-x-3 py-2.5 px-3 rounded-lg text-sm text-gray-700 hover:bg-gray-100 font-medium transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                                Sign Out
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
