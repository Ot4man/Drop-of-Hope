@extends('layouts.app')

@section('title', 'My Appointments')

@section('content')
<section class="min-h-screen py-20 px-[5%] md:px-[10%] bg-off-white">
    <div class="max-w-5xl mx-auto space-y-12">
        
        <div>
            <h1 class="text-4xl font-black text-text-dark mb-2">Appointments</h1>
            <p class="text-text-muted">Manage and track your donation schedule.</p>
        </div>

        <div class="grid grid-cols-1 gap-6">
            @forelse($appointments as $appointment)
                <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg transition-all group">

                    <div class="flex flex-col md:flex-row">
                        {{-- Date Sidebar --}}
                        <div class="bg-gray-900 md:w-48 p-8 flex flex-col items-center justify-center text-center">
                            @if($appointment->scheduled_at)
                                <p class="text-primary-red text-[10px] font-black uppercase tracking-[0.3em] mb-2">Confirmed</p>
                                <p class="text-4xl font-black text-white">{{ $appointment->scheduled_at->format('d') }}</p>
                                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mt-1">{{ $appointment->scheduled_at->format('M Y') }}</p>
                                <p class="text-sm font-bold text-white mt-4">{{ $appointment->scheduled_at->format('H:i') }}</p>
                            @else
                                <p class="text-yellow-500 text-[10px] font-black uppercase tracking-[0.3em] mb-2">Pending</p>
                                <div class="w-12 h-12 rounded-full border-2 border-dashed border-gray-700 flex items-center justify-center text-2xl">
                                    <i class="fas fa-hourglass-half text-gray-500"></i>
                                </div>
                            @endif
                        </div>

                        {{-- Main Info --}}
                        <div class="flex-1 p-10 flex flex-col md:flex-row justify-between items-center gap-8">
                            <div class="flex items-center gap-6">
                                <div class="w-16 h-16 bg-red-50 rounded-2xl flex items-center justify-center text-primary-red text-2xl font-black border border-red-100">
                                    {{ $appointment->response ? $appointment->response->bloodRequest->blood_type : auth()->user()->donorProfile->blood_type }}
                                </div>
                                <div>
                                    @php
                                        $hospitalProfile = $appointment->response ? $appointment->response->bloodRequest->hospitalProfile : $appointment->hospitalProfile;
                                        $hospitalName = $hospitalProfile->hospital_name;
                                        $fullAddress = $hospitalProfile->address . ', ' . $hospitalProfile->city;
                                        $mapUrl = "https://www.google.com/maps/search/" . urlencode($hospitalName . ' ' . $fullAddress);
                                    @endphp

                                    <h4 class="text-2xl font-black text-text-dark mb-1">
                                        {{ $hospitalName }}
                                    </h4>
                                    
                                    <a href="{{ $mapUrl }}" target="_blank" class="text-sm text-text-muted flex items-center gap-2 hover:text-primary-red transition-colors group/link">
                                        <i class="fas fa-location-dot text-gray-400 group-hover/link:text-primary-red transition-colors"></i>
                                        <span>{{ $fullAddress }}</span>
                                        <i class="fas fa-up-right-from-square text-[10px] opacity-0 group-hover/link:opacity-100 transition-all"></i>
                                    </a>
                                    
                                    @if($appointment->notes)
                                        <div class="mt-4 p-4 bg-gray-50 rounded-2xl text-xs text-text-muted italic border border-gray-100">
                                            "{{ $appointment->notes }}"
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="flex flex-col items-center md:items-end gap-4">
                                <span class="px-5 py-2 rounded-full text-[10px] font-black uppercase tracking-[0.2em] 
                                    {{ $appointment->status === 'confirmed' ? 'bg-green-50 text-green-700 border border-green-100' : 'bg-blue-50 text-blue-700 border border-blue-100' }}">
                                    {{ $appointment->status }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white/50 border-2 border-dashed border-gray-200 p-20 rounded-[3rem] text-center">
                    <p class="text-7xl mb-6 text-gray-200">
                        <i class="fas fa-calendar-xmark"></i>
                    </p>
                    <h3 class="text-xl font-bold text-text-dark">No appointments yet</h3>
                    <p class="text-text-muted mt-2">Accepted responses will appear here as scheduled appointments.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>
@endsection
