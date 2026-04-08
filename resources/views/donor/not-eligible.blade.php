@extends('layouts.app')

@section('title', 'Not Eligible to Donate')

@section('content')
<section class="min-h-screen py-24 px-6 flex justify-center items-center bg-off-white">
    <div class="form-card-custom max-w-2xl text-center">
        <div class="mb-8 flex justify-center">
            <!-- Icon placeholder: a red stop/warning icon -->
            <div class="h-24 w-24 bg-red-100 rounded-full flex items-center justify-center">
                <svg class="w-12 h-12 text-primary-red" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
            </div>
        </div>

        <h2 class="text-3xl font-serif font-bold text-gray-800 mb-4">Currently Not Eligible</h2>
        
        <p class="text-text-muted leading-relaxed mb-6 font-medium">
            Thank you for your willingness to save lives. Unfortunately, based on the information provided in your profile, you are currently not eligible to donate blood.
        </p>

        <div class="bg-gray-50 border border-gray-100 rounded-xl p-6 text-left mb-8">
            <h3 class="font-bold text-gray-800 mb-3">Common Eligibility Requirements:</h3>
            <ul class="list-disc list-inside text-text-muted space-y-2">
                <li>Age must be between 18 and 65 years old.</li>
                <li>You must have a valid blood type defined in your profile.</li>
                <li>You must be marked as "Available" for donation.</li>
                <li>At least 3 months must have passed since your last donation.</li>
            </ul>
        </div>

        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('profile.edit') }}" class="btn-primary-custom py-3 px-8 text-lg font-bold shadow-xl">Update Profile</a>
            <a href="{{ url('/') }}" class="px-8 py-3 rounded-xl border-2 border-gray-200 text-gray-600 font-bold hover:border-gray-300 transition-all bg-white hover:bg-gray-50">Back to Home</a>
        </div>
    </div>
</section>
@endsection
