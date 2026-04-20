@extends('layouts.app')

@section('title', 'Donor Dashboard')

@section('content')
<section class="min-h-screen py-20 px-[5%] md:px-[10%] bg-off-white">
    <div class="max-w-6xl mx-auto">
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-12">
            <div class="lg:col-span-2 premium-card p-10 flex flex-col md:flex-row items-center gap-10">
                <div class="w-24 h-24 rounded-3xl bg-primary-red flex items-center justify-center text-white text-3xl font-black shadow-lg">
                    {{ $profile->blood_type }}
                </div>
                
                <div class="flex-1 text-center md:text-left">
                    <h2 class="text-3xl font-black text-text-dark mb-2">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</h2>
                    <p class="text-text-muted flex items-center justify-center md:justify-start gap-2">
                        <i class="fas fa-location-dot text-sm"></i>
                        {{ $profile->city }}
                    </p>
                    
                    <div class="flex flex-wrap gap-3 mt-6">
                        <span class="px-4 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider {{ $profile->available ? 'bg-blue-50 text-blue-700' : 'bg-gray-100 text-gray-500' }}">
                            {{ $profile->available ? 'Available' : 'Unavailable' }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="bg-gray-900 p-8 rounded-[2.2rem] text-white shadow-sm flex flex-col justify-center gap-6">
                <div class="flex justify-between items-center">
                    <div class="text-center flex-1">
                        <p class="text-3xl font-black">{{ $totalDonations }}</p>
                        <p class="text-[10px] uppercase tracking-widest text-gray-400 mt-1">Donations</p>
                    </div>
                    <div class="w-px h-10 bg-gray-800"></div>
                    <div class="text-center flex-1">
                        <p class="text-3xl font-black">{{ $totalResponses }}</p>
                        <p class="text-[10px] uppercase tracking-widest text-gray-400 mt-1">Responses</p>
                    </div>
                </div>

                <div class="border-t border-gray-800"></div>

                <div class="text-center">
                    <p class="text-sm font-bold">
                        {{ $lastDonation ? $lastDonation->format('M d, Y') : 'No history' }}
                    </p>
                    <p class="text-[10px] text-gray-400 uppercase tracking-widest mt-1">Last Donation</p>
                </div>
            </div>
        </div>

        <div class="space-y-8">
            <h3 class="text-2xl font-bold text-text-dark flex items-center gap-3">
                <span class="w-2 h-8 bg-primary-red rounded-full"></span> Matching Blood Requests
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($requests as $request)
                    @php
                        $urgencyColor = match(strtolower($request->urgency)) {
                            'critical' => 'bg-red-500',
                            'high' => 'bg-orange-500',
                            'medium' => 'bg-yellow-500',
                            'low' => 'bg-green-500',
                            default => 'bg-gray-500'
                        };
                        $urgencyBg = match(strtolower($request->urgency)) {
                            'critical' => 'bg-red-50 text-red-700',
                            'high' => 'bg-orange-50 text-orange-700',
                            'medium' => 'bg-yellow-50 text-yellow-700',
                            'low' => 'bg-green-50 text-green-700',
                            default => 'bg-gray-50 text-gray-700'
                        };
                    @endphp

                    <div class="premium-card p-6 border-t-4 {{ str_replace('bg', 'border', $urgencyColor) }}">
                        <div class="flex justify-between items-start mb-6">
                            <span class="px-3 py-1 rounded-lg text-[10px] font-black uppercase tracking-widest {{ $urgencyBg }}">
                                {{ $request->urgency }}
                            </span>
                            <span class="text-xs font-bold text-text-muted">{{ $request->created_at->diffForHumans() }}</span>
                        </div>

                        <div class="mb-6">
                            <h4 class="text-xl font-bold text-text-dark mb-1">{{ $request->hospitalProfile->hospital_name }}</h4>
                            <p class="text-sm text-text-muted"><i class="fas fa-location-dot mr-1"></i> {{ $request->hospitalProfile->city }}</p>
                        </div>

                        <div class="flex items-center justify-between p-4 bg-off-white rounded-2xl mb-6">
                            <div class="text-center">
                                <p class="text-xs text-text-muted uppercase font-bold tracking-tighter">Required</p>
                                <p class="text-lg font-black text-primary-red">{{ $request->blood_type }}</p>
                            </div>
                            <div class="w-px h-8 bg-gray-200"></div>
                            <div class="text-center">
                                <p class="text-xs text-text-muted uppercase font-bold tracking-tighter">Units</p>
                                <p class="text-lg font-black text-gray-900">{{ $request->quantity }}</p>
                            </div>
                        </div>

                        <a href="{{ route('donor.requests.show', $request->id) }}" class="block w-full text-center py-3 bg-gray-900 text-white rounded-xl font-bold text-sm hover:bg-black transition-all">
                            View Details
                        </a>
                    </div>
                @empty
                    <div class="col-span-full bg-white/50 backdrop-blur-sm rounded-[3rem] border-2 border-dashed border-gray-200 p-20 text-center">
                        <p class="text-7xl mb-6 text-gray-200">
                            <i class="fas fa-hospital-user"></i>
                        </p>
                        <h4 class="text-xl font-bold text-text-dark">No matching requests</h4>
                        <p class="text-text-muted mt-2">There are currently no active requests for your blood type in {{ $profile->city }}.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</section>
@endsection