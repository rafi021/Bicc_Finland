<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin @yield('title', 'Dashboard') | {{ @$setting->site_name ?? 'BICC FINLAND' }}</title>
    <link rel="icon" type="image/png" href="{{ image(@$setting->favicon, 'favicon.png', '32x32', 'F') }}" />
    @include('admin.partials.styles')
</head>

<body class="bg-slate-100 text-slate-900">
    @include('sweetalert::alert')
    <div class="h-screen flex overflow-hidden bg-slate-100">
        @include('admin.partials.sidebar')
        <div class="flex-1 flex flex-col h-full overflow-hidden">
            @include('admin.partials.header')
            <main class="flex-1 overflow-y-auto p-6 pt-2">
                <div class="container mx-auto">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>
    @include('admin.partials.script')
</body>

</html>
