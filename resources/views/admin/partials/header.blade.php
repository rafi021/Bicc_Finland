<header class="bg-white border-b p-4 flex items-center justify-between">
    <div class="flex items-center gap-4">
        <button id="sidebar-toggle" class="p-2 rounded bg-slate-100 lg:hidden" title="Toggle sidebar">☰</button>
        <h1 class="text-xl font-semibold">@yield('title', 'Dashboard')</h1>
    </div>
    <div class="flex items-center gap-2 hidden">
        <button id="sidebar-hide" class="p-2 rounded bg-slate-100" title="Hide sidebar">
            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="1" />
                <circle cx="19" cy="12" r="1" />
                <circle cx="5" cy="12" r="1" />
            </svg>
        </button>
    </div>
</header>
