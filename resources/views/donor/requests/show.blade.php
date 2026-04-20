@extends('layouts.app')

@section('title', 'Request Details')

@section('content')
<section class="min-h-[80vh] py-20 px-[5%] md:px-[10%] bg-off-white">
    <div class="max-w-4xl mx-auto">
        
        <a href="{{ route('donor.dashboard') }}" class="inline-flex items-center gap-2 text-text-muted hover:text-primary-red transition-all mb-10 font-bold group">
            <i class="fas fa-arrow-left group-hover:-translate-x-1 transition-transform"></i>
            Back to Dashboard
        </a>

        <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">
            
            {{-- Request Card --}}
            <div class="lg:col-span-3 premium-card p-10">
                <div class="flex items-center gap-6 mb-10">
                    <div class="w-20 h-20 rounded-3xl bg-red-50 flex items-center justify-center text-primary-red text-3xl font-black border border-red-100">
                        {{ $bloodRequest->blood_type }}
                    </div>
                    <div>
                        <span class="px-3 py-1 rounded-lg text-[10px] font-black uppercase tracking-widest bg-red-50 text-red-700">
                            {{ $bloodRequest->urgency }} Priority
                        </span>
                        <h2 class="text-3xl font-black text-text-dark mt-2">{{ $bloodRequest->quantity }} Units Needed</h2>
                    </div>
                </div>

                <div class="space-y-6 text-text-muted leading-relaxed">
                    <p>A critical request has been placed for blood type <strong>{{ $bloodRequest->blood_type }}</strong>. Your contribution can save a life today.</p>
                    
                    <div class="grid grid-cols-2 gap-8 pt-6 border-t border-gray-100">
                        <div>
                            <p class="text-[10px] uppercase font-black tracking-widest text-gray-400 mb-1">Status</p>
                            <p class="font-bold text-text-dark uppercase">{{ $bloodRequest->status }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] uppercase font-black tracking-widest text-gray-400 mb-1">Posted On</p>
                            <p class="font-bold text-text-dark">{{ $bloodRequest->created_at->format('M d, Y') }}</p>
                        </div>
                    </div>
                </div>

                <div class="mt-12">
                    @if($alreadyResponded)
                        <div class="p-6 bg-blue-50 text-blue-700 rounded-2xl flex items-center gap-4 font-bold border border-blue-100">
                            <i class="fas fa-circle-check text-xl"></i>
                            You have already responded to this request.
                        </div>
                    @elseif(!auth()->user()->donorProfile->evaluateEligibility())
                        <div class="p-6 bg-orange-50 text-orange-700 rounded-2xl flex items-center gap-4 font-bold border border-orange-100">
                            <i class="fas fa-triangle-exclamation text-xl"></i>
                            You are not eligible to donate yet (56-day rule).
                        </div>
                    @else
                        <form action="{{ route('donor.requests.respond', $bloodRequest->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full py-5 bg-primary-red text-white rounded-2xl font-black text-lg hover:bg-red-700 transition-all shadow-xl shadow-red-100 active:scale-[0.98]">
                                I Can Help
                            </button>
                        </form>
                    @endif
                </div>
            </div>

            {{-- Hospital Info Card --}}
            <div class="lg:col-span-2 space-y-8">
                <div class="bg-gray-900 p-8 rounded-[2.5rem] text-white shadow-xl relative overflow-hidden">
                    <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-white/5 rounded-full blur-3xl"></div>
                    
                    <p class="text-primary-red font-black uppercase tracking-[0.3em] text-[10px] mb-6">Medical Facility</p>
                    <h3 class="text-2xl font-black mb-4">{{ $bloodRequest->hospitalProfile->hospital_name }}</h3>
                    
                    <div class="space-y-4 text-sm text-gray-400">
                        @php
                            $fullAddress = $bloodRequest->hospitalProfile->address . ', ' . $bloodRequest->hospitalProfile->city;
                            $mapUrl = "https://www.google.com/maps/search/" . urlencode($bloodRequest->hospitalProfile->hospital_name . ' ' . $fullAddress);
                        @endphp
                        <a href="{{ $mapUrl }}" target="_blank" class="flex items-start gap-3 hover:text-white transition-colors group/map">
                            <i class="fas fa-location-dot mt-1 text-gray-500 group-hover/map:text-primary-red transition-colors"></i>
                            <span>{{ $fullAddress }}</span>
                        </a>
                        <p class="flex items-center gap-3">
                            <i class="fas fa-phone text-gray-500"></i> {{ $bloodRequest->hospitalProfile->contact_phone }}
                        </p>
                    </div>

                    <div class="mt-10 pt-8 border-t border-white/10">
                        <span class="inline-block px-4 py-1 rounded-full bg-green-500/10 text-green-400 text-[10px] font-black uppercase tracking-widest border border-green-500/20">
                            <i class="fas fa-shield-check mr-1"></i> Verified Facility
                        </span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection
