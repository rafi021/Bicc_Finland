<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Home') - {{ @$setting->site_name ?? 'CBG Mosque' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Archivo+Black&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="{{ asset('masjid/style.css') }}" />
    <link
      href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css"
      rel="stylesheet"
    />
    @stack('styles')
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script>
        const HOME_URL = "{{ route('mosque.home') }}";
    </script>
    <link rel="icon" type="image/png" href="{{ image(@$setting->favicon, 'favicon.png', '32x32', 'F') }}" />
</head>
<body>
    @include('masjid.partials.header')
    
    <main>
        @yield('content')
    </main>
    
    @include('masjid.partials.floating-socials')
    @include('masjid.partials.donate-modal')
    @include('masjid.partials.class-modal')
    @include('masjid.partials.mobile-drawer')
    @include('masjid.partials.footer')

    <!-- Video Modal -->
    <div id="video-modal" onclick="closeVideoModal()" class="fixed inset-0 z-[100] hidden bg-black/80 flex justify-center items-center p-4 backdrop-blur-sm transition-all duration-300">
        <div onclick="event.stopPropagation()" class="relative w-full max-w-4xl bg-black rounded-2xl overflow-hidden shadow-2xl transform transition-all scale-100">
            <div class="aspect-video w-full relative">
                <iframe id="video-frame" class="w-full h-full" src="" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                <button onclick="closeVideoModal()" class="absolute top-4 right-4 z-50 text-white hover:text-red-500 bg-black/50 hover:bg-black/70 rounded-full p-2 transition-colors">
                    <i class="ti ti-x text-2xl"></i>
                </button>
            </div>
        </div>
    </div>

    <script src="{{ asset('masjid/script.js') }}"></script>
    @stack('scripts')
</body>
</html>
