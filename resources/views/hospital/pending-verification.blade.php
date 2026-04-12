@extends('layouts.app')

@section('title', 'Pending Verification')

@section('content')
<section class="min-h-screen py-24 px-6 flex justify-center items-center bg-off-white">
    <div class="form-card-custom max-w-2xl text-center">
        <div class="mb-8 flex justify-center">
            <!-- Icon placeholder: an orange pending/clock icon -->
            <div class="h-24 w-24 bg-orange-100 rounded-full flex items-center justify-center">
                <svg class="w-12 h-12 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        </div>

        <h2 class="text-3xl font-serif font-bold text-gray-800 mb-4">Verification Pending</h2>
        
        <p class="text-text-muted leading-relaxed mb-6 font-medium">
            Your hospital profile has been successfully submitted and is currently under review by our administration team. 
        </p>

        <div class="bg-gray-50 border border-gray-100 rounded-xl p-6 text-left mb-8">
            <h3 class="font-bold text-gray-800 mb-3">What happens next?</h3>
            <p class="text-text-muted text-sm space-y-2 mb-4">
                To ensure the safety and legitimacy of blood requests on <strong>Drop of Hope</strong>, all healthcare facilities undergo a manual verification process based on the provided license number.
            </p>
            <ul class="list-disc list-inside text-text-muted space-y-2 text-sm">
                <li>This process typically takes 1-2 business days.</li>
                <li>You will be notified via email once approved.</li>
                <li>Once verified, you will unlock full access to create urgent blood requests.</li>
            </ul>
        </div>

        <div class="flex justify-center">
            <a href="{{ url('/') }}" class="btn-primary-custom py-3 px-8 text-lg font-bold shadow-xl">Return to Homepage</a>
        </div>
    </div>
</section>
@endsection
