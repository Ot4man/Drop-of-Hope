<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Drop-of-Hope</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-white font-sans text-text-dark selection:bg-primary-red selection:text-white">
    <nav class="sticky top-0 z-50 bg-white border-b border-gray-100 px-[10%] py-4 flex justify-between items-center shadow-sm">
        <a href="{{ route('welcome') }}" class="flex items-center gap-2">
            <span class="text-xl font-bold text-primary-red tracking-tight">Drop of Hope</span>
        </a>

        <div class="hidden md:flex items-center gap-8 font-bold text-sm">
            @guest
                <a href="{{ route('welcome') }}" class="{{ request()->routeIs('welcome') ? 'text-primary-red' : 'text-gray-600 hover:text-primary-red' }}">Home</a>
                <a href="{{ route('login') }}" class="text-gray-600 hover:text-primary-red">Login</a>
                <a href="{{ route('register') }}" class="bg-primary-red text-white px-5 py-2 rounded-lg">Register</a>
            @endguest

            @auth
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'text-primary-red' : 'text-gray-600 hover:text-primary-red' }}">Dashboard</a>
                    <a href="{{ route('admin.hospitals') }}" class="{{ request()->routeIs('admin.hospitals') ? 'text-primary-red' : 'text-gray-600 hover:text-primary-red' }}">Hospitals</a>
                    <a href="{{ route('admin.donors') }}" class="{{ request()->routeIs('admin.donors') ? 'text-primary-red' : 'text-gray-600 hover:text-primary-red' }}">Donors</a>
                    
                    <div class="flex items-center gap-4 ml-4 pl-4 border-l border-gray-100">
                        <a href="#" class="text-gray-400 hover:text-primary-red" title="System Notifications">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                        </a>
                        <a href="{{ route('profile.edit') }}" class="text-gray-400 hover:text-primary-red" title="Admin Profile">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </a>
                    </div>
                @elseif(auth()->user()->role === 'donor')
                    <a href="{{ route('donor.dashboard') }}" class="{{ request()->routeIs('donor.dashboard') ? 'text-primary-red' : 'text-gray-600 hover:text-primary-red' }}">Dashboard</a>
                    <a href="{{ route('donor.hospitals') }}" class="{{ request()->routeIs('donor.hospitals*') ? 'text-primary-red' : 'text-gray-600 hover:text-primary-red' }}">Donate</a>
                    <a href="{{ route('donor.responses.index') }}" class="{{ request()->routeIs('donor.responses.*') ? 'text-primary-red' : 'text-gray-600 hover:text-primary-red' }}">My Responses</a>
                    <a href="{{ route('donor.appointments.index') }}" class="{{ request()->routeIs('donor.appointments.*') ? 'text-primary-red' : 'text-gray-600 hover:text-primary-red' }}">Appointments</a>
                    <a href="{{ route('donor.notifications') }}" class="{{ request()->routeIs('donor.notifications') ? 'text-primary-red' : 'text-gray-600 hover:text-primary-red' }}">Notifications</a>
                    <a href="{{ route('profile.edit') }}" class="{{ request()->routeIs('profile.edit') ? 'text-primary-red' : 'text-gray-600 hover:text-primary-red' }}">Profile</a>
                @elseif(auth()->user()->role === 'hospital')
                    <div class="flex items-center gap-8">
                        <a href="{{ route('hospital.dashboard') }}" 
                           class="{{ request()->routeIs('hospital.dashboard') ? 'text-primary-red' : 'text-gray-500 hover:text-primary-red' }} transition-colors">
                            Dashboard
                        </a>
                        <a href="{{ route('hospital.requests.index') }}" 
                           class="{{ request()->routeIs('hospital.requests.index') ? 'text-primary-red' : 'text-gray-500 hover:text-primary-red' }} transition-colors">
                            Requests
                        </a>
                        <a href="{{ route('hospital.requests.all_responses') }}" 
                           class="{{ request()->routeIs('hospital.requests.all_responses') ? 'text-primary-red' : 'text-gray-500 hover:text-primary-red' }} transition-colors">
                            Responses
                        </a>
                        <a href="{{ route('hospital.appointments.index') }}" 
                           class="{{ request()->routeIs('hospital.appointments.*') ? 'text-primary-red' : 'text-gray-500 hover:text-primary-red' }} transition-colors">
                            Appointments
                        </a>
                        <a href="{{ route('profile.edit') }}" 
                           class="{{ request()->routeIs('profile.edit') ? 'text-primary-red' : 'text-gray-500 hover:text-primary-red' }} transition-colors">
                            Profile
                        </a>
                    </div>

                    <div class="flex items-center gap-4 ml-4 pl-4 border-l border-gray-100">
                        <a href="{{ route('hospital.notifications') }}" class="text-gray-400 hover:text-primary-red relative group" title="Hospital Notifications">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                            @php
                                $unreadCount = \App\Models\Notification::where('user_id', auth()->id())->whereNull('read_at')->count();
                            @endphp
                            @if($unreadCount > 0)
                                <span class="absolute -top-1 -right-1 w-2 h-2 bg-primary-red rounded-full"></span>
                            @endif
                        </a>
                    </div>
                @endif

                <div class="ml-6 pl-6 border-l border-gray-100">
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-gray-400 hover:text-primary-red font-bold transition-colors cursor-pointer uppercase tracking-widest text-[10px]">Logout</button>
                    </form>
                </div>
            @endauth
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
