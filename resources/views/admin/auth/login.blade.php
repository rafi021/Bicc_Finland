<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - BICC FINLAND</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    <style>
        body { 
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            overflow-x: hidden;
        }
        .bg-shapes {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
        }
        .shape {
            position: absolute;
            border-radius: 50%;
            filter: blur(60px);
            opacity: 0.4;
        }
        .shape-1 {
            top: -100px;
            right: -100px;
            width: 400px;
            height: 400px;
            background: #f04e4c;
        }
        .shape-2 {
            bottom: -150px;
            left: -150px;
            width: 500px;
            height: 500px;
            background: #1c2252;
        }
        .login-box {
            background: white;
            padding: 3.5rem 2.5rem;
            border-radius: 2rem;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05), 0 10px 10px -5px rgba(0, 0, 0, 0.02);
            width: 100%;
            max-width: 480px;
            border: 1px solid rgba(226, 232, 240, 0.8);
            animation: cardEntrance 0.8s ease-out;
        }
        @keyframes cardEntrance {
            from { opacity: 0; transform: scale(0.95) translateY(20px); }
            to { opacity: 1; transform: scale(1) translateY(0); }
        }
        .input-field {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .input-field:focus {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
        .btn-primary {
            background: #1c2252;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }
        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 20px 25px -5px rgba(28, 34, 82, 0.2);
            background: #252c6d;
        }
    </style>
</head>
<body class="antialiased">
    <!-- Abstract Background -->
    <div class="bg-shapes">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
    </div>

    <div class="login-box">
        <!-- Brand -->
        <div class="text-center mb-14">
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">BICC FINLAND</h1>
            <p class="text-slate-500 text-sm mt-1">Manage your CMS effortlessly</p>
        </div>
        <div class="h-4"></div>

        <!-- Errors -->
        @if ($errors->any())
            <div class="mb-6 p-4 rounded-xl bg-red-50 text-red-700 text-xs font-medium border border-red-100 flex items-center gap-3">
                <i class="ti ti-alert-triangle text-lg"></i>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST" class="space-y-6">
            @csrf
            
            <div>
                <label for="email" class="block text-xs font-semibold text-slate-500 uppercase tracking-widest mb-2 ml-1">
                    Email Address
                </label>
                <div class="relative group">
                    <input id="email" name="email" type="email" autocomplete="email" required value="{{ old('email') }}"
                        class="input-field block w-full pr-4 py-4 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-0 focus:border-primary-800 focus:bg-white text-sm font-medium text-slate-900"
                        placeholder="admin@biccfinland.com">
                </div>
            </div>

            <div>
                <div class="flex items-center justify-between mb-2 ml-1">
                    <label for="password" class="block text-xs font-semibold text-slate-500 uppercase tracking-widest">
                        Password
                    </label>
                    {{-- <a href="#" class="text-xs font-bold text-accent-500 hover:underline">Forgot?</a> --}}
                </div>
                <div class="relative group">
                    <input id="password" name="password" type="password" required
                        class="input-field block w-full pr-4 py-4 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-0 focus:border-primary-800 focus:bg-white text-sm font-medium text-slate-900"
                        placeholder="••••••••••••">
                </div>
            </div>

            <div class="flex items-center ml-1">
                <input id="remember" name="remember" type="checkbox"
                    class="h-4 w-4 text-primary-800 border-slate-300 rounded focus:ring-0 cursor-pointer">
                <label for="remember" class="ml-2 block text-sm text-slate-500 font-medium cursor-pointer">
                    Remember me
                </label>
            </div>

            <button type="submit"
                class="btn-primary w-full py-4 text-white font-bold rounded-xl flex items-center justify-center gap-2 group">
                <span>Sign In</span>
                <i class="ti ti-arrow-right text-lg group-hover:translate-x-1 transition-transform"></i>
            </button>
        </form>

        <div class="mt-8 pt-8 border-t border-slate-50 text-center">
            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">
                Developed By Creative Business Group (CBG) &copy; {{ date('Y') }}
            </p>
        </div>
    </div>
</body>
</html>
