@extends('layouts.app')

@section('title', 'Manage Appointments')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 font-serif">Appointments</h1>
            <p class="mt-1 text-sm text-gray-500">Manage scheduled donation appointments.</p>
        </div>
        <a href="{{ route('hospital.requests.index') }}" class="text-sm text-gray-500 hover:text-gray-700 flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7 7-7"/></svg>
            Back to Requests
        </a>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 font-bold rounded shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 gap-6">
        @forelse($appointments as $appointment)
            <div class="bg-white rounded-2xl shadow-md border border-gray-100 p-6 flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                <div class="flex items-center gap-5">
                    @php
                        $donorProfile = $appointment->response ? $appointment->response->donorProfile : $appointment->donorProfile;
                        $bloodType = $appointment->response ? $appointment->response->bloodRequest->blood_type : $donorProfile->blood_type;
                    @endphp
                    <div class="w-14 h-14 bg-red-50 rounded-xl flex items-center justify-center text-xl font-black text-primary-red shadow-inner">
                        {{ $bloodType }}
                    </div>
                    <div>
                        <h4 class="text-lg font-bold text-gray-900">
                            {{ $donorProfile->user->first_name }} {{ $donorProfile->user->last_name }}
                        </h4>
                        <p class="text-sm text-gray-500">
                            <i class="fas fa-location-dot"></i> {{ $appointment->response ? $appointment->response->bloodRequest->hospitalProfile->city : 'Direct Booking' }}
                        </p>
                        <div class="mt-1">
                            <span class="text-[10px] font-black px-3 py-1 rounded-full uppercase tracking-widest
                                {{ $appointment->status === 'confirmed' ? 'bg-green-100 text-green-700' : ($appointment->status === 'completed' ? 'bg-blue-100 text-blue-700' : 'bg-yellow-100 text-yellow-700') }}">
                                {{ $appointment->status }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col items-start md:items-end gap-3">
                    <div class="text-sm text-gray-500">
                        @if($appointment->scheduled_at)
                            <i class="fas fa-calendar-day"></i> <span class="font-bold text-gray-800">{{ $appointment->scheduled_at->format('M d, Y \a\t H:i') }}</span>
                        @else
                            <span class="text-yellow-600 font-bold italic">No date set yet</span>
                        @endif
                    </div>
                    @if($appointment->status !== 'completed' && $appointment->status !== 'cancelled')
                        <div class="flex gap-2">
                            <form action="{{ route('hospital.appointments.complete', $appointment->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="px-5 py-2 bg-green-600 text-white rounded-xl font-bold text-sm hover:bg-green-700 transition-colors shadow flex items-center gap-2">
                                    <i class="fas fa-check-circle"></i> Validate Donation
                                </button>
                            </form>
                            
                            <a href="{{ route('hospital.appointments.edit', $appointment->id) }}"
                               class="px-5 py-2 bg-gray-100 text-text-dark rounded-xl font-bold text-sm hover:bg-gray-200 transition-colors border border-gray-200">
                                {{ $appointment->scheduled_at ? 'Reschedule' : 'Set Date & Time' }}
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        @empty
            <div class="bg-gray-50 rounded-3xl border-2 border-dashed border-gray-200 p-20 text-center">
                <div class="text-5xl mb-4 text-gray-300">
                    <i class="fas fa-calendar-xmark"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-500">No appointments yet</h3>
                <p class="text-gray-400 mt-1 text-sm">Appointments will appear here when donors schedule a visit.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
