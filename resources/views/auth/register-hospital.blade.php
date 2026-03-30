@extends('layouts.app')

@section('title', 'Register as a Hospital')

@section('content')
<section class="min-h-screen py-24 px-6 flex justify-center items-center bg-off-white">
    <div class="form-card-custom max-w-3xl">
        <div class="text-center mb-10">
            <h2 class="text-4xl font-serif font-bold text-gray-800 mb-3">Hospital Registration</h2>
            <p class="text-text-muted leading-relaxed">Register your facility to post urgent blood requests.</p>
        </div>

        <form id="hospital-register-form" method="POST" action="{{ route('register.hospital.post') }}" class="space-y-6">
            @csrf
            
            <div class="space-y-2">
                <label for="hospital_name" class="block font-semibold text-text-dark text-sm">Hospital / Bank Name</label>
                <input type="text" id="hospital_name" name="hospital_name" placeholder="General Hospital" required
                       class="w-full px-4 py-3 rounded-xl border border-gray-100 bg-gray-50 outline-none focus:bg-white focus:border-gray-800 transition-all duration-300">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-2">
                    <label for="license_number" class="block font-semibold text-text-dark text-sm">License Number</label>
                    <input type="text" id="license_number" name="license_number" placeholder="LIC-123456" required
                           class="w-full px-4 py-3 rounded-xl border border-gray-100 bg-gray-50 outline-none focus:bg-white focus:border-gray-800 transition-all duration-300">
                </div>
                <div class="space-y-2">
                    <label for="contact_phone" class="block font-semibold text-text-dark text-sm">Contact Phone</label>
                    <input type="text" id="contact_phone" name="contact_phone" placeholder="+212 600000000" required
                           class="w-full px-4 py-3 rounded-xl border border-gray-100 bg-gray-50 outline-none focus:bg-white focus:border-gray-800 transition-all duration-300">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-2">
                    <label for="city" class="block font-semibold text-text-dark text-sm">City</label>
                    <input type="text" id="city" name="city" placeholder="Casablanca" required
                           class="w-full px-4 py-3 rounded-xl border border-gray-100 bg-gray-50 outline-none focus:bg-white focus:border-gray-800 transition-all duration-300">
                </div>
                <div class="space-y-2">
                    <label for="address" class="block font-semibold text-text-dark text-sm">Detailed Address</label>
                    <input type="text" id="address" name="address" placeholder="123 Health Ave." required
                           class="w-full px-4 py-3 rounded-xl border border-gray-100 bg-gray-50 outline-none focus:bg-white focus:border-gray-800 transition-all duration-300">
                </div>
            </div>

            <div class="space-y-2 pt-4 border-t divide-gray-100">
                <label for="username" class="block font-semibold text-text-dark text-sm">Admin Username</label>
                <input type="text" id="username" name="username" placeholder="hospitalAdmin" required
                       class="w-full px-4 py-3 rounded-xl border border-gray-100 bg-gray-50 outline-none focus:bg-white focus:border-gray-800 transition-all duration-300">
            </div>

            <div class="space-y-2">
                <label for="email" class="block font-semibold text-text-dark text-sm">Contact Email Address</label>
                <input type="email" id="email" name="email" placeholder="contact@hospital.com" required
                       class="w-full px-4 py-3 rounded-xl border border-gray-100 bg-gray-50 outline-none focus:bg-white focus:border-gray-800 transition-all duration-300">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-2">
                    <label for="password" class="block font-semibold text-text-dark text-sm">Password</label>
                    <input type="password" id="password" name="password" placeholder="Min. 8 characters" required
                           class="w-full px-4 py-3 rounded-xl border border-gray-100 bg-gray-50 outline-none focus:bg-white focus:border-gray-800 transition-all duration-300">
                </div>
                <div class="space-y-2">
                    <label for="repeat-password" class="block font-semibold text-text-dark text-sm">Confirm Password</label>
                    <input type="password" id="repeat-password" name="password_confirmation" placeholder="Confirm your password" required
                           class="w-full px-4 py-3 rounded-xl border border-gray-100 bg-gray-50 outline-none focus:bg-white focus:border-gray-800 transition-all duration-300">
                </div>
            </div>

            <button type="submit" class="w-full bg-gray-800 text-white rounded-xl py-4 text-xl font-bold mt-4 shadow-xl hover:bg-gray-900 transition-colors">Submit Registration</button>
        </form>

        <div class="mt-8 text-center border-t py-6 border-gray-50">
            <p class="text-text-muted">Already registered? <a href="{{ route('login') }}" class="text-gray-800 font-extrabold hover:underline transition-all">Log In</a></p>
        </div>
    </div>
</section>
@endsection
