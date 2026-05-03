@extends('layouts.app')

@section('title', 'My Responses')

@section('content')
<section class="min-h-screen py-20 px-[5%] md:px-[10%] bg-off-white">
    <div class="max-w-5xl mx-auto space-y-12">
        
        <div class="flex justify-between items-end">
            <div>
                <h1 class="text-4xl font-black text-text-dark mb-2">My Responses</h1>
                <p class="text-text-muted">Track the status of your blood donation offers.</p>
            </div>
        </div>

        {{-- Status Tabs / Groups --}}
        <div class="space-y-12">
            
            {{-- ACCEPTED --}}
            @if($acceptedResponses->count() > 0)
            <div class="space-y-6">
                <h3 class="text-xl font-bold text-green-600 flex items-center gap-3">
                    <span class="w-2 h-6 bg-green-600 rounded-full"></span> Accepted Responses
                </h3>
                <div class="grid gap-4">
                    @foreach($acceptedResponses as $response)
                    <div class="premium-card p-6 flex justify-between items-center border-l-4 border-green-500">
                        <div>
                            <h4 class="font-bold text-lg">{{ $response->bloodRequest->hospitalProfile->hospital_name }}</h4>
                            <p class="text-sm text-text-muted">Type: <strong>{{ $response->bloodRequest->blood_type }}</strong> • {{ $response->created_at->format('M d, Y') }}</p>
                        </div>
                        <div class="flex items-center gap-4">
                            <span class="px-4 py-1 rounded-full bg-green-50 text-green-700 text-[10px] font-black uppercase tracking-widest">Accepted</span>
                            <a href="{{ route('donor.appointments.index') }}" class="px-5 py-2 bg-gray-900 text-white rounded-xl text-xs font-bold hover:bg-black transition">View Appointment</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- PENDING --}}
            <div class="space-y-6">
                <h3 class="text-xl font-bold text-text-dark flex items-center gap-3">
                    <span class="w-2 h-6 bg-primary-red rounded-full"></span> Pending Responses
                </h3>
                <div class="grid gap-4">
                    @forelse($pendingResponses as $response)
                    <div class="premium-card p-6 flex justify-between items-center border-l-4 border-gray-300">
                        <div>
                            <h4 class="font-bold text-lg">{{ $response->bloodRequest->hospitalProfile->hospital_name }}</h4>
                            <p class="text-sm text-text-muted">Type: <strong>{{ $response->bloodRequest->blood_type }}</strong> • {{ $response->created_at->format('M d, Y') }}</p>
                        </div>
                        <span class="px-4 py-1 rounded-full bg-yellow-50 text-yellow-700 text-[10px] font-black uppercase tracking-widest">Waiting for Hospital</span>
                    </div>
                    @empty
                    <div class="bg-white/50 border-2 border-dashed border-gray-200 p-10 rounded-3xl text-center text-text-muted italic">
                        No pending responses.
                    </div>
                    @endforelse
                </div>
            </div>

            {{-- REJECTED --}}
            @if($rejectedResponses->count() > 0)
            <div class="space-y-6 opacity-60">
                <h3 class="text-xl font-bold text-gray-400 flex items-center gap-3">
                    <span class="w-2 h-6 bg-gray-400 rounded-full"></span> Past / Rejected
                </h3>
                <div class="grid gap-4">
                    @foreach($rejectedResponses as $response)
                    <div class="premium-card p-6 flex justify-between items-center border-l-4 border-gray-200">
                        <div>
                            <h4 class="font-bold text-lg">{{ $response->bloodRequest->hospitalProfile->hospital_name }}</h4>
                            <p class="text-sm text-text-muted">{{ $response->created_at->format('M d, Y') }}</p>
                        </div>
                        <span class="px-4 py-1 rounded-full bg-gray-50 text-gray-500 text-[10px] font-black uppercase tracking-widest">Rejected / Closed</span>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

        </div>
    </div>
</section>
@endsection
