@extends('layouts.app')

@section('title', 'Donor Dashboard')

@section('content')
<section class="min-h-[80vh] py-16 px-[5%] md:px-[10%] bg-off-white">
    <div class="max-w-6xl mx-auto space-y-8">
        
        {{-- Welcome Header --}}
        <div class="bg-white p-10 rounded-[2rem] shadow-xl border border-red-50 flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
            <div>
                <h2 class="text-4xl font-serif font-bold text-text-dark tracking-tight leading-none mb-3">Welcome, <span class="text-primary-red">{{ auth()->user()->first_name }}!</span></h2>
                <p class="text-text-muted text-lg">Thank you for your life-saving commitment.</p>
            </div>
            <div class="bg-red-50 px-6 py-3 rounded-full flex items-center gap-3 shadow-sm border border-red-100">
                <span class="w-3 h-3 bg-primary-red rounded-full animate-pulse"></span>
                <span class="text-primary-red font-bold text-sm uppercase tracking-wider">Active Donor</span>
            </div>
        </div>

        {{-- Intelligence: Notifications --}}
        @if($notifications->count() > 0)
        <div class="space-y-4">
            <h3 class="text-xl font-bold text-text-dark flex items-center gap-2 px-4">
                <span class="text-2xl">🔔</span> Notifications
            </h3>
            <div class="grid grid-cols-1 gap-4">
                @foreach($notifications as $notification)
                <div class="bg-white p-6 rounded-2xl shadow-md border-l-4 border-primary-red flex justify-between items-center group hover:shadow-lg transition-all">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-red-50 rounded-xl flex items-center justify-center text-xl">
                            🚨
                        </div>
                        <div>
                            <p class="font-bold text-text-dark">{{ $notification->data['message'] }}</p>
                            <p class="text-sm text-text-muted italic">{{ $notification->data['hospital_name'] }} • {{ $notification->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    <a href="{{ route('donor.requests.show', $notification->data['blood_request_id']) }}" class="bg-primary-red text-white px-5 py-2 rounded-lg font-bold text-sm hover:bg-red-700 transition-colors">
                        View Request
                    </a>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        {{-- Blood Requests Feed --}}
        <div class="space-y-6">
            <h3 class="text-2xl font-bold text-text-dark flex items-center gap-2 px-4">
                <span class="text-3xl">📋</span> Blood Requests Feed
            </h3>

            <div class="grid grid-cols-1 gap-6">
                @forelse($requests as $request)
                    @php
                        $isUrgent = in_array($request->urgency, ['critical', 'high']);
                    @endphp
                    <div class="bg-white rounded-[2rem] shadow-lg border {{ $isUrgent ? 'border-primary-red ring-2 ring-red-50' : 'border-gray-100' }} overflow-hidden hover:scale-[1.01] transition-transform">
                        <div class="p-8">
                            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
                                <div class="flex items-center gap-4">
                                    <div class="w-16 h-16 {{ $isUrgent ? 'bg-primary-red' : 'bg-gray-100' }} rounded-2xl flex items-center justify-center text-white text-2xl font-black shadow-lg">
                                        {{ $request->blood_type }}
                                    </div>
                                    <div>
                                        <h4 class="text-xl font-bold text-text-dark leading-tight">{{ $request->hospital->hospitalProfile->hospital_name ?? 'Hospital' }}</h4>
                                        <p class="text-text-muted text-sm flex items-center gap-1">
                                            📍 {{ $request->location }}
                                        </p>
                                    </div>
                                </div>
                                <div class="flex flex-col items-end">
                                    <span class="px-4 py-1.5 {{ $isUrgent ? 'bg-primary-red text-white' : 'bg-gray-100 text-gray-700' }} rounded-full text-xs font-black uppercase tracking-widest mb-2">
                                        {{ $request->urgency }}
                                    </span>
                                    <p class="text-xs text-text-muted italic">{{ $request->created_at->diffForHumans() }}</p>
                                </div>
                            </div>

                            <div class="flex justify-between items-end">
                                <div>
                                    <p class="text-text-muted text-sm mb-1 uppercase font-bold tracking-tighter">Required Quantity</p>
                                    <p class="text-2xl font-black text-text-dark">{{ $request->quantity }} <span class="text-lg font-medium text-text-muted">Units</span></p>
                                </div>
                                <a href="{{ route('donor.requests.show', $request->id) }}" class="btn-primary-custom px-10 py-4 bg-gray-900 text-white rounded-xl font-bold hover:bg-black transition-all">
                                    Respond to Request
                                </a>
                            </div>
                        </div>
                        
                        @if($isUrgent)
                        <div class="bg-primary-red py-2 px-8">
                            <p class="text-white text-[10px] font-black uppercase tracking-[0.2em] animate-pulse">Critical Priority • Immediate Action Requested</p>
                        </div>
                        @endif
                    </div>
                @empty
                    <div class="bg-gray-50 rounded-[2rem] border-2 border-dashed border-gray-200 p-20 text-center">
                        <p class="text-gray-400 font-bold uppercase tracking-widest">Everything is calm right now.</p>
                        <p class="text-gray-300 text-sm italic mt-2">No active blood requests in your area.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-8">
                {{ $requests->links() }}
            </div>
        </div>

        {{-- Quick Actions --}}
        <div class="bg-white p-10 rounded-[2rem] shadow-xl border border-gray-100 flex flex-wrap gap-4">
            <a href="{{ route('profile.edit') }}" class="px-8 py-4 border-2 border-primary-red text-primary-red rounded-xl font-bold hover:bg-red-50 transition-all flex items-center gap-2">
                Update Profile
            </a>
            <form action="{{ route('logout') }}" method="POST" class="ml-auto">
                @csrf
                <button type="submit" class="px-8 py-4 bg-gray-100 text-gray-600 rounded-xl font-bold hover:bg-gray-200 transition-all flex items-center gap-2">
                    Logout
                </button>
            </form>
        </div>
    </div>
</section>
@endsection
