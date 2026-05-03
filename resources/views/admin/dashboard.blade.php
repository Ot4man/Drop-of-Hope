@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="max-w-6xl mx-auto py-12 px-4">
    <div class="mb-12">
        <h1 class="text-4xl font-bold text-gray-900 mb-2">Admin Dashboard</h1>
        <p class="text-gray-500">Manage hospitals and monitor system activity.</p>
    </div>

    @if(session('success'))
        <div class="mb-8 p-4 bg-green-50 border border-green-100 text-green-700 font-bold rounded-xl shadow-sm">
            Hospital verified successfully
        </div>
    @endif

    {{-- Stats Section --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
        <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm">
            <p class="text-gray-400 text-xs font-black uppercase tracking-widest mb-1">Total Donors</p>
            <p class="text-3xl font-black text-gray-900">{{ $stats['donors'] }}</p>
        </div>
        <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm">
            <p class="text-gray-400 text-xs font-black uppercase tracking-widest mb-1">Total Hospitals</p>
            <p class="text-3xl font-black text-gray-900">{{ $stats['hospitals'] }}</p>
        </div>
        <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm">
            <p class="text-gray-400 text-xs font-black uppercase tracking-widest mb-1">Blood Requests</p>
            <p class="text-3xl font-black text-gray-900">{{ $stats['requests'] }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
        
        {{-- Hospitals Section --}}
        <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
            <div class="bg-gray-50 px-8 py-5 border-b border-gray-100">
                <h2 class="text-xl font-bold text-gray-900">Hospitals</h2>
            </div>
            <div class="divide-y divide-gray-100">
                @forelse($hospitals as $hospital)
                    <div class="p-8 flex items-center justify-between hover:bg-gray-50 transition-colors">
                        <div>
                            <p class="text-lg font-bold text-gray-800">{{ $hospital->hospitalProfile->hospital_name ?? 'Unnamed' }}</p>
                            <p class="text-sm text-gray-500">📍 {{ $hospital->hospitalProfile->city ?? 'No city set' }}</p>
                            <div class="mt-3">
                                @if($hospital->hospitalProfile && $hospital->hospitalProfile->is_verified)
                                    <span class="inline-block bg-green-50 text-green-600 text-[10px] font-black uppercase tracking-widest px-3 py-1 rounded-full border border-green-100">Verified</span>
                                @else
                                    <span class="inline-block bg-red-50 text-red-600 text-[10px] font-black uppercase tracking-widest px-3 py-1 rounded-full border border-red-100">Not Verified</span>
                                @endif
                            </div>
                        </div>
                        
                        @if($hospital->hospitalProfile && !$hospital->hospitalProfile->is_verified)
                            <form action="{{ route('admin.hospitals.verify', $hospital->id) }}" method="POST">
                                @csrf
                                <button type="submit" style="background-color: #10b981;" class="text-white px-6 py-3 rounded-xl font-bold text-xs hover:opacity-90 transition-all shadow-lg active:scale-95">
                                    Verify
                                </button>
                            </form>
                        @endif
                    </div>
                @empty
                    <div class="p-12 text-center text-gray-400 font-medium">No hospitals registered yet.</div>
                @endforelse
            </div>
        </div>

        {{-- Donors Section --}}
        <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
            <div class="bg-gray-50 px-8 py-5 border-b border-gray-100">
                <h2 class="text-xl font-bold text-gray-900">Donors</h2>
            </div>
            <div class="divide-y divide-gray-100">
                @forelse($donors as $donor)
                    <div class="p-8 hover:bg-gray-50 transition-colors">
                        <p class="text-lg font-bold text-gray-800">{{ $donor->first_name }} {{ $donor->last_name }}</p>
                        <p class="text-sm text-gray-500 mt-1">{{ $donor->email }}</p>
                        <p class="text-[10px] text-gray-400 mt-3 uppercase font-black tracking-widest">Joined {{ $donor->created_at->format('M d, Y') }}</p>
                    </div>
                @empty
                    <div class="p-12 text-center text-gray-400 font-medium">No donors registered yet.</div>
                @endforelse
            </div>
        </div>

    </div>
</div>
@endsection
