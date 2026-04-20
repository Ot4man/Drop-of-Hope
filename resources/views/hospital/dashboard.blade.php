@extends('layouts.app')

@section('title', 'Hospital Dashboard')

@section('content')
<section class="min-h-[80vh] py-16 px-[5%] md:px-[10%] bg-off-white">
    <div class="max-w-6xl mx-auto space-y-12">
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 glass-card p-12 rounded-[3rem] flex flex-col md:flex-row justify-between items-center gap-8">
                <div>
                    <p class="text-primary-red font-black uppercase tracking-[0.3em] text-[10px] mb-4">Medical Dashboard</p>
                    <h2 class="text-4xl font-serif font-bold text-text-dark tracking-tight">Welcome, <span class="text-primary-red">{{ auth()->user()->hospitalProfile->hospital_name ?? 'Facility' }}</span></h2>
                </div>
                <a href="{{ route('hospital.requests.create') }}" class="btn-primary-custom whitespace-nowrap">
                    Request Blood
                </a>
            </div>
            
            <div class="bg-gray-900 p-10 rounded-[3rem] shadow-2xl text-white flex justify-around items-center">
                <div class="text-center">
                    <p class="text-4xl font-black">{{ $totalRequests }}</p>
                    <p class="text-[10px] font-bold uppercase tracking-[0.2em] text-gray-500">Total Requests</p>
                </div>
                <div class="w-px h-16 bg-gray-800"></div>
                <div class="text-center">
                    <p class="text-4xl font-black">{{ $totalDonations }}</p>
                    <p class="text-[10px] font-bold uppercase tracking-[0.2em] text-gray-500">Total Donations</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            
            <div class="lg:col-span-2 space-y-12">
                
                <section class="space-y-6">
                    <h3 class="text-2xl font-bold text-text-dark flex items-center gap-3 px-4">
                        <span class="w-2 h-8 bg-primary-red rounded-full"></span> Active Requests
                    </h3>
                    <div class="space-y-4">
                        @forelse($activeRequests as $request)
                            <div class="premium-card p-8 flex flex-col md:flex-row justify-between items-center gap-6">
                                <div class="flex items-center gap-6">
                                    <div class="w-14 h-14 bg-red-50 rounded-2xl flex items-center justify-center text-primary-red text-xl font-black border border-red-100">
                                        {{ $request->blood_type }}
                                    </div>
                                    <div>
                                        <p class="text-lg font-bold text-text-dark">{{ $request->quantity }} Units Needed</p>
                                        <div class="flex items-center gap-2 mt-1">
                                            <span class="px-3 py-0.5 bg-gray-100 rounded-full text-[8px] font-black uppercase tracking-widest text-gray-500 border border-gray-200">
                                                {{ $request->urgency }}
                                            </span>
                                            <span class="text-xs text-text-muted">• {{ $request->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex gap-3">
                                    <a href="{{ route('hospital.requests.show', $request->id) }}" class="px-5 py-2 bg-gray-50 text-text-dark rounded-xl font-bold text-xs hover:bg-gray-100 transition-all border border-gray-200">
                                        View Responses
                                    </a>
                                    <form action="{{ route('hospital.requests.close', $request->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="px-5 py-2 bg-white text-primary-red rounded-xl font-bold text-xs hover:bg-red-50 transition-all border border-red-100">
                                            Close
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div class="bg-white/50 backdrop-blur-sm rounded-[3rem] border-2 border-dashed border-gray-200 p-16 text-center">
                                <p class="text-gray-400 font-bold uppercase tracking-[0.2em] text-sm">No active requests</p>
                            </div>
                        @endforelse
                    </div>
                </section>

                <section class="space-y-6">
                    <h3 class="text-2xl font-bold text-text-dark flex items-center gap-3 px-4">
                        <span class="w-2 h-8 bg-blue-600 rounded-full"></span> Recent Donor Responses
                    </h3>
                    <div class="space-y-4">
                        @forelse($recentResponses as $response)
                            <div class="premium-card p-8 flex flex-col md:flex-row justify-between items-center gap-6">
                                <div class="flex items-center gap-6">
                                    <div class="w-12 h-12 bg-blue-50 rounded-full flex items-center justify-center text-blue-600 font-bold border border-blue-100">
                                        {{ substr($response->donorProfile->user->first_name, 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="text-lg font-bold text-text-dark">{{ $response->donorProfile->user->first_name }} {{ $response->donorProfile->user->last_name }}</p>
                                        <p class="text-xs text-text-muted mt-0.5">Responded to: <span class="font-bold text-primary-red">{{ $response->bloodRequest->blood_type }}</span> Request</p>
                                    </div>
                                </div>
                                <div class="flex gap-3">
                                    <form action="{{ route('hospital.requests.accept', $response->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="px-6 py-2 bg-gray-900 text-white rounded-xl font-bold text-xs hover:bg-black transition-all">
                                            Accept
                                        </button>
                                    </form>
                                    <form action="{{ route('hospital.requests.reject', $response->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="px-6 py-2 bg-white text-gray-500 rounded-xl font-bold text-xs hover:bg-gray-50 transition-all border border-gray-100">
                                            Reject
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div class="bg-white/50 backdrop-blur-sm rounded-[3rem] border-2 border-dashed border-gray-200 p-16 text-center">
                                <p class="text-gray-400 font-bold uppercase tracking-[0.2em] text-sm">No pending responses</p>
                            </div>
                        @endforelse
                    </div>
                </section>

            </div>

            <aside class="space-y-12">
                <section class="premium-card p-10">
                    <h3 class="text-xl font-bold text-text-dark mb-8 flex items-center gap-2">
                        <span>🗓️</span> Upcoming Appointments
                    </h3>
                    <div class="space-y-6">
                        @forelse($appointments as $appointment)
                            <div class="bg-gray-50 p-6 rounded-2xl border border-gray-100">
                                <p class="text-[10px] font-black text-primary-red uppercase tracking-widest mb-1">{{ $appointment->status }}</p>
                                <p class="text-lg font-bold text-text-dark">{{ $appointment->response->donorProfile->user->first_name }} {{ $appointment->response->donorProfile->user->last_name }}</p>
                                <p class="text-xs text-text-muted mt-2 font-medium">{{ $appointment->scheduled_at->format('M d, Y @ H:i') }}</p>
                            </div>
                        @empty
                            <div class="text-center py-12 bg-gray-50/50 rounded-[2rem] border border-dashed border-gray-200">
                                <p class="text-sm text-gray-400 font-bold uppercase tracking-widest">No appointments</p>
                            </div>
                        @endforelse
                    </div>
                    @if($appointments->count() > 0)
                        <a href="{{ route('hospital.appointments.index') }}" class="block text-center mt-8 py-2 text-xs font-bold text-text-muted hover:text-primary-red transition-all underline decoration-dotted underline-offset-8">
                            View All Appointments
                        </a>
                    @endif
                </section>

                <div class="premium-card p-10 space-y-6">
                    <h3 class="text-xl font-bold text-text-dark mb-2">Facility Info</h3>
                    <div class="space-y-2">
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">License</p>
                        <p class="text-sm font-bold text-text-dark">{{ auth()->user()->hospitalProfile->license_number }}</p>
                    </div>
                    <div class="space-y-2">
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Location</p>
                        <p class="text-sm font-bold text-text-dark">{{ auth()->user()->hospitalProfile->city }}</p>
                    </div>
                </div>
            </aside>

        </div>
    </div>
</section>
@endsection
