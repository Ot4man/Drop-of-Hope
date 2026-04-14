@extends('layouts.app')

@section('title', 'Blood Request Details')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="mb-8">
        <a href="{{ route('donor.dashboard') }}" class="text-gray-500 hover:text-gray-700 flex items-center gap-2 mb-4">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7 7-7"></path></svg>
            Back to Dashboard
        </a>
    </div>

    <div class="bg-white shadow-2xl rounded-[2.5rem] border border-gray-100 overflow-hidden">
        {{-- Header Status Bar --}}
        @php $isUrgent = in_array($bloodRequest->urgency, ['critical', 'high']); @endphp
        <div class="{{ $isUrgent ? 'bg-primary-red' : 'bg-gray-800' }} py-4 px-10">
            <p class="text-white text-xs font-black uppercase tracking-[0.3em]">
                {{ $isUrgent ? 'Urgent Emergency Request' : 'Standard Blood Request' }}
            </p>
        </div>

        <div class="p-10 md:p-16">
            <div class="flex flex-col md:flex-row justify-between items-start gap-10">
                
                {{-- Left Side: Blood Type Circle --}}
                <div class="flex-shrink-0">
                    <div class="w-32 h-32 {{ $isUrgent ? 'bg-primary-red shadow-[0_0_30px_rgba(200,16,46,0.3)]' : 'bg-gray-800' }} rounded-[2rem] flex items-center justify-center text-white text-5xl font-black">
                        {{ $bloodRequest->blood_type }}
                    </div>
                    <div class="mt-6 text-center">
                        <span class="text-xs font-bold text-gray-400 uppercase tracking-widest block mb-1">Impact</span>
                        <p class="text-sm font-bold text-gray-900 italic">Potential Lives Saved: 3</p>
                    </div>
                </div>

                {{-- Right Side: Content --}}
                <div class="flex-grow">
                    <h1 class="text-4xl font-serif font-bold text-gray-900 mb-2">{{ $bloodRequest->hospital->hospitalProfile->hospital_name ?? 'Facility' }}</h1>
                    <p class="text-xl text-gray-500 mb-8 flex items-center gap-2">
                        📍 {{ $bloodRequest->location }}
                    </p>

                    <div class="grid grid-cols-2 gap-8 mb-10">
                        <div class="p-6 bg-gray-50 rounded-2xl border border-gray-100">
                            <span class="text-xs font-bold text-gray-400 uppercase tracking-widest block mb-2">Quantity Needed</span>
                            <p class="text-3xl font-black text-gray-900">{{ $bloodRequest->quantity }} <span class="text-sm font-medium text-gray-500">Units</span></p>
                        </div>
                        <div class="p-6 bg-gray-50 rounded-2xl border border-gray-100">
                            <span class="text-xs font-bold text-gray-400 uppercase tracking-widest block mb-2">Current Urgency</span>
                            <p class="text-xl font-black {{ $isUrgent ? 'text-primary-red' : 'text-gray-900' }} uppercase">{{ $bloodRequest->urgency }}</p>
                        </div>
                    </div>

                    <div class="bg-blue-50 p-6 rounded-2xl border border-blue-100 flex items-start gap-4 mb-10">
                        <div class="text-2xl">ℹ️</div>
                        <p class="text-blue-800 text-sm leading-relaxed">
                            Respond only if you are healthy, weigh over 50kg, and haven't donated in the last 3 months. Your response will notify the hospital staff immediately.
                        </p>
                    </div>

                    @if($alreadyResponded)
                        <div class="bg-green-50 p-8 rounded-3xl border border-green-200 text-center">
                            <p class="text-green-700 font-bold text-lg mb-2">✓ You have responded to this request</p>
                            <p class="text-green-600 text-sm">Thank you for your generosity! The hospital will contact you if needed.</p>
                        </div>
                    @else
                        <form action="{{ route('donor.requests.respond', $bloodRequest->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full btn-primary-custom py-6 text-xl font-black uppercase tracking-widest bg-primary-red hover:bg-red-700 text-white rounded-[1.5rem] shadow-xl hover:shadow-2xl transition-all active:scale-95 flex items-center justify-center gap-3">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path></svg>
                                I Want to Help
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
