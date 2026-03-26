@extends('layouts.app')

@section('title', 'Login')

@section('content')
<section class="min-h-[85vh] py-24 px-6 flex justify-center items-center bg-off-white">
    <div class="form-card-custom max-w-lg">
        <div class="text-center mb-10">
            <h2 class="text-3xl md:text-4xl font-extrabold text-primary-red mb-3">Welcome Back</h2>
            <p class="text-text-muted leading-relaxed">Ready to save more lives? Log in to your account.</p>
        </div>

        <form method="POST" action="{{ route('login.post') }}" class="space-y-6">
            @csrf
            <div class="space-y-2">
                <label for="email" class="block font-semibold text-text-dark text-sm">Email or Username</label>
                <input type="text" id="email" name="login" placeholder="Email or Username" required
                       class="w-full px-4 py-3 rounded-xl border border-gray-100 bg-gray-50 outline-none focus:bg-white focus:border-primary-red transition-all duration-300">
            </div>

            <div class="space-y-2">
                <label for="password" class="block font-semibold text-text-dark text-sm">Password</label>
                <input type="password" id="password" name="password" placeholder="Password" required
                       class="w-full px-4 py-3 rounded-xl border border-gray-100 bg-gray-50 outline-none focus:bg-white focus:border-primary-red transition-all duration-300">
            </div>

            <div class="flex justify-between items-center text-sm">
                <label class="flex items-center gap-2 cursor-pointer group">
                    <input type="checkbox" name="remember" class="w-4 h-4 rounded border-gray-300 text-primary-red focus:ring-primary-red transition-all"> 
                    <span class="text-text-muted group-hover:text-text-dark transition-colors">Remember me</span>
                </label>
                <a href="#" class="text-primary-red font-bold hover:underline transition-all underline-offset-4">Forgot Password?</a>
            </div>

            <button type="submit" class="w-full btn-primary-custom py-4 text-xl font-bold mt-4 shadow-xl">Login</button>
        </form>

        <div class="mt-8 text-center border-t py-6 border-gray-50">
            <p class="text-text-muted">Don't have an account? <a href="{{ route('register') }}" class="text-primary-red font-extrabold hover:underline transition-all">Join us today</a></p>
        </div>
    </div>
</section>
@endsection
