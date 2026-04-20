@extends('layouts.app')

@section('title', 'Request Details')

@section('content')
    <section class="min-h-[80vh] py-20 px-[5%] md:px-[10%] bg-off-white">
        <div class="max-w-5xl mx-auto space-y-12">

            <a href="{{ route('hospital.dashboard') }}"
                class="inline-flex items-center gap-3 text-text-muted hover:text-primary-red transition-all group font-bold">
                <div
                    class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-sm border border-gray-100 group-hover:bg-primary-red group-hover:text-white transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7 7-7" />
                    </svg>
                </div>
                Back to Dashboard
            </a>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                {{-- Request Summary --}}
                <div class="lg:col-span-1 space-y-8">
                    <div class="premium-card p-10 bg-gray-900 text-white relative overflow-hidden">
                        <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-primary-red/10 rounded-full blur-3xl"></div>
                        <p class="text-primary-red font-black uppercase tracking-[0.3em] text-[10px] mb-4">Request Summary
                        </p>
                        <div class="flex items-center gap-6 mb-8">
                            <div
                                class="w-16 h-16 bg-white/10 rounded-3xl flex items-center justify-center text-primary-red text-3xl font-black border border-white/10">
                                {{ $request->blood_type }}
                            </div>
                            <div>
                                <h2 class="text-3xl font-black">{{ $request->quantity }} Units</h2>
                                <p class="text-gray-400 text-xs font-bold uppercase tracking-widest">{{ $request->urgency }}
                                    Priority</p>
                            </div>
                        </div>
                        <div class="space-y-4 pt-8 border-t border-white/5 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-500 font-bold uppercase tracking-tighter text-[10px]">Posted
                                    On</span>
                                <span class="font-bold">{{ $request->created_at->format('M d, Y') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500 font-bold uppercase tracking-tighter text-[10px]">Location</span>
                                <span class="font-bold">{{ $request->hospitalProfile->city }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500 font-bold uppercase tracking-tighter text-[10px]">Status</span>
                                <span
                                    class="font-bold text-primary-red uppercase tracking-widest text-[10px]">{{ $request->status }}</span>
                            </div>
                        </div>
                    </div>

                    @if($request->status === 'open')
                        <form action="{{ route('hospital.requests.close', $request->id) }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="w-full py-4 bg-white text-primary-red rounded-2xl font-bold hover:bg-red-50 transition-all border border-red-100 shadow-sm">
                                Close This Request
                            </button>
                        </form>
                    @endif
                </div>

                {{-- Donor Responses --}}
                <div class="lg:col-span-2 space-y-8">
                    <h3 class="text-2xl font-bold text-text-dark flex items-center gap-3 px-4">
                        <span class="w-2 h-8 bg-primary-red rounded-full"></span> Donor Responses
                    </h3>

                    <div class="space-y-4">
                        @forelse($request->responses()->with('donorProfile.user')->latest()->get() as $response)
                            <div class="premium-card p-8 flex flex-col md:flex-row justify-between items-center gap-6">
                                <div class="flex items-center gap-6">
                                    <div
                                        class="w-14 h-14 bg-red-50 rounded-2xl flex items-center justify-center text-primary-red font-bold border border-red-100 shadow-inner">
                                        {{ substr($response->donorProfile->user->first_name, 0, 1) }}
                                    </div>
                                    <div>
                                        <h4 class="text-lg font-bold text-text-dark">{{ $response->donorProfile->user->first_name }}
                                            {{ $response->donorProfile->user->last_name }}</h4>
                                        <p class="text-xs text-text-muted">Responded
                                            {{ $response->created_at->diffForHumans() }}</p>
                                        <span
                                            class="inline-block mt-2 px-3 py-0.5 rounded-full text-[8px] font-black uppercase tracking-widest border {{ $response->status === 'accepted' ? 'bg-green-50 text-green-600 border-green-100' : ($response->status === 'rejected' ? 'bg-red-50 text-red-600 border-red-100' : 'bg-gray-50 text-gray-500 border-gray-100') }}">
                                            {{ $response->status }}
                                        </span>
                                    </div>
                                </div>

                                @if($response->status === 'pending')
                                    <div class="flex gap-3">
                                        <form action="{{ route('hospital.requests.accept', $response->id) }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="px-6 py-3 bg-gray-900 text-white rounded-xl font-bold text-xs hover:bg-black transition-all shadow-lg active:scale-95">
                                                Accept Response
                                            </button>
                                        </form>
                                        <form action="{{ route('hospital.requests.reject', $response->id) }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="px-6 py-3 bg-white text-gray-400 rounded-xl font-bold text-xs hover:bg-gray-50 transition-all border border-gray-100">
                                                Reject
                                            </button>
                                        </form>
                                    </div>
                                @elseif($response->status === 'accepted')
                                    <a href="{{ route('hospital.appointments.index') }}"
                                        class="px-6 py-3 bg-green-600 text-white rounded-xl font-bold text-xs hover:bg-green-700 transition-all shadow-lg">
                                        Schedule Now
                                    </a>
                                @endif
                            </div>
                        @empty
                            <div
                                class="bg-white/50 backdrop-blur-sm rounded-[3rem] border-2 border-dashed border-gray-200 p-20 text-center">
                                <p class="text-7xl mb-6 grayscale opacity-20">👋</p>
                                <h4 class="text-xl font-bold text-text-dark">No responses yet</h4>
                                <p class="text-text-muted mt-2">Donors will appear here as soon as they respond to your request.
                                </p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection