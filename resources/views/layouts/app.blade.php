<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Drop-of-Hope</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-white font-sans text-text-dark selection:bg-primary-red selection:text-white">
    <nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-gray-100 px-[10%] py-4 flex justify-between items-center">
        <a href="{{ route('welcome') }}" class="flex items-center gap-3">
            <div class="logo-heart"></div>
            <span class="text-xl font-serif font-bold text-primary-red tracking-tight">Drop of Hope</span>
        </a>
        <div class="hidden md:flex items-center gap-8 font-medium">
            <a href="{{ route('welcome') }}" class="hover:text-primary-red transition-colors">Home</a>
            
            @auth
                @if(auth()->user()->role === 'hospital')
                    <a href="{{ route('dashboard') }}" class="hover:text-primary-red transition-colors">Request Blood</a>
                    <a href="{{ route('dashboard') }}" class="hover:text-primary-red transition-colors font-medium">Dashboard</a>
                @else
                    <a href="{{ route('eligibility') }}" class="hover:text-primary-red transition-colors">Donate</a>
                    <a href="{{ route('dashboard') }}" class="hover:text-primary-red transition-colors font-medium">Dashboard</a>
                @endif

                <a href="{{ route('profile.edit') }}" class="flex items-center justify-center w-10 h-10 bg-red-50 text-primary-red rounded-full hover:bg-primary-red hover:text-white transition-all shadow-sm border border-red-100" title="My Profile">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                </a>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="btn-primary-custom cursor-pointer py-2 px-5 text-sm">Logout</button>
                </form>
            @else
                <a href="{{ route('eligibility') }}" class="hover:text-primary-red transition-colors">Donate</a>
                <a href="{{ route('login') }}" class="text-primary-red hover:underline decoration-2 underline-offset-4">Login</a>
                <a href="{{ route('register') }}" class="btn-primary-custom">Register</a>
            @endauth
        </div>
        <!-- Mobile Menu Toggle (Simplified) -->
        <div class="md:hidden text-primary-red">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="mt-20 py-12 px-[10%] text-center border-t border-gray-100 bg-off-white">
        <p class="text-text-muted text-sm">&copy; 2026 Drop-of-Hope. All rights Reserved.</p>
    </footer>

    @stack('scripts')
</body>
</html>
