@extends('layouts.app')

@section('title', 'Register as a Donor')

@section('content')
<section class="min-h-screen py-24 px-6 flex justify-center items-center bg-off-white">
    <div class="form-card-custom max-w-3xl">
        <div class="text-center mb-10">
            <h2 class="text-4xl font-serif font-bold text-primary-red mb-3">Create an Account</h2>
            <p class="text-text-muted leading-relaxed">Become a part of our life-saving community today.</p>
        </div>

        <form id="register-form" method="POST" action="{{ route('register.donor.post') }}" class="space-y-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-2">
                    <label for="first_name" class="block font-semibold text-text-dark text-sm">First Name</label>
                    <input type="text" id="first_name" name="first_name" placeholder="John" required
                           class="w-full px-4 py-3 rounded-xl border border-gray-100 bg-gray-50 outline-none focus:bg-white focus:border-primary-red transition-all duration-300">
                </div>
                <div class="space-y-2">
                    <label for="last_name" class="block font-semibold text-text-dark text-sm">Last Name</label>
                    <input type="text" id="last_name" name="last_name" placeholder="Doe" required
                           class="w-full px-4 py-3 rounded-xl border border-gray-100 bg-gray-50 outline-none focus:bg-white focus:border-primary-red transition-all duration-300">
                </div>
            </div>

            <div class="space-y-2">
                <label for="email" class="block font-semibold text-text-dark text-sm">Email Address</label>
                <input type="email" id="email" name="email" placeholder="john.doe@email.com" required
                       class="w-full px-4 py-3 rounded-xl border border-gray-100 bg-gray-50 outline-none focus:bg-white focus:border-primary-red transition-all duration-300">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-2">
                    <label for="dob" class="block font-semibold text-text-dark text-sm">Date of Birth</label>
                    <input type="date" id="dob" name="date_of_birth" required
                           class="w-full px-4 py-3 rounded-xl border border-gray-100 bg-gray-50 outline-none focus:bg-white focus:border-primary-red transition-all duration-300">
                </div>
                <div class="space-y-2">
                    <label for="blood_type" class="block font-semibold text-text-dark text-sm">Blood Type</label>
                    <select id="blood_type" name="blood_type" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-100 bg-gray-50 outline-none focus:bg-white focus:border-primary-red transition-all duration-300">
                        <option value="">Select Blood Type</option>
                        <option value="A+">A+</option>
                        <option value="A-">A-</option>
                        <option value="B+">B+</option>
                        <option value="B-">B-</option>
                        <option value="AB+">AB+</option>
                        <option value="AB-">AB-</option>
                        <option value="O+">O+</option>
                        <option value="O-">O-</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-2">
                    <label for="city" class="block font-semibold text-text-dark text-sm">City</label>
                    <input type="text" id="city" name="city" placeholder="Casablanca" required
                           class="w-full px-4 py-3 rounded-xl border border-gray-100 bg-gray-50 outline-none focus:bg-white focus:border-primary-red transition-all duration-300">
                </div>
                <div class="space-y-2">
                    <label for="phone" class="block font-semibold text-text-dark text-sm">Phone Number</label>
                    <input type="text" id="phone" name="phone" placeholder="0612345678" required
                           class="w-full px-4 py-3 rounded-xl border border-gray-100 bg-gray-50 outline-none focus:bg-white focus:border-primary-red transition-all duration-300">
                </div>
            </div>

            <div class="space-y-2">
                <label for="username" class="block font-semibold text-text-dark text-sm">Username</label>
                <input type="text" id="username" name="username" placeholder="johndoe123" required
                       class="w-full px-4 py-3 rounded-xl border border-gray-100 bg-gray-50 outline-none focus:bg-white focus:border-primary-red transition-all duration-300">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-2">
                    <label for="password" class="block font-semibold text-text-dark text-sm">Password</label>
                    <input type="password" id="password" name="password" placeholder="Min. 8 characters" required
                           class="w-full px-4 py-3 rounded-xl border border-gray-100 bg-gray-50 outline-none focus:bg-white focus:border-primary-red transition-all duration-300">
                </div>
                <div class="space-y-2">
                    <label for="repeat-password" class="block font-semibold text-text-dark text-sm">Confirm Password</label>
                    <input type="password" id="repeat-password" name="password_confirmation" placeholder="Confirm your password" required
                           class="w-full px-4 py-3 rounded-xl border border-gray-100 bg-gray-50 outline-none focus:bg-white focus:border-primary-red transition-all duration-300">
                </div>
            </div>

            <button type="submit" class="w-full btn-primary-custom py-4 text-xl font-bold mt-4 shadow-xl">Join the Movement</button>
        </form>

        <div class="mt-8 text-center border-t py-6 border-gray-50">
            <p class="text-text-muted">Already have an account? <a href="{{ route('login') }}" class="text-primary-red font-extrabold hover:underline transition-all">Log In</a></p>
        </div>
    </div>
</section>
@endsection
