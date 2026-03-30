@extends('layouts.app')

@section('title', 'Join Drop of Hope')

@section('content')
<section class="min-h-[85vh] py-24 px-6 flex justify-center items-center bg-off-white">
    <div class="max-w-4xl w-full">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-serif font-bold text-primary-red mb-4">How would you like to join?</h2>
            <p class="text-text-muted text-lg">Select your role to continue the registration process.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Donor Card -->
            <a href="{{ route('register.donor') }}" class="group block bg-white rounded-3xl p-10 border-2 border-transparent hover:border-primary-red shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                <div class="flex justify-center mb-6">
                    <div class="h-24 w-24 bg-red-50 rounded-full flex items-center justify-center group-hover:bg-primary-red transition-colors duration-300">
                        <svg class="w-12 h-12 text-primary-red group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </div>
                </div>
                <h3 class="text-2xl font-bold text-center text-gray-800 mb-3 group-hover:text-primary-red transition-colors">I am a Donor</h3>
                <p class="text-center text-text-muted">Register to donate blood, receive urgent alerts, and help save lives in your community.</p>
            </a>

            <!-- Hospital Card -->
            <a href="{{ route('register.hospital') }}" class="group block bg-white rounded-3xl p-10 border-2 border-transparent hover:border-gray-800 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                <div class="flex justify-center mb-6">
                    <div class="h-24 w-24 bg-gray-50 rounded-full flex items-center justify-center group-hover:bg-gray-800 transition-colors duration-300">
                        <svg class="w-12 h-12 text-gray-800 group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                </div>
                <h3 class="text-2xl font-bold text-center text-gray-800 mb-3 group-hover:text-gray-900 transition-colors">I am a Hospital</h3>
                <p class="text-center text-text-muted">Register your healthcare facility to request emergency blood supplies and track availability.</p>
            </a>
        </div>
        
        <div class="mt-12 text-center">
            <p class="text-text-muted">Already have an account? <a href="{{ route('login') }}" class="text-primary-red font-extrabold hover:underline transition-all">Log In</a></p>
        </div>
    </div>
</section>
@endsection
