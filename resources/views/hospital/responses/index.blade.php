@extends('layouts.app')

@section('title', 'Blood Request Responses')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="mb-8 flex justify-between items-end">
        <div>
            <a href="{{ route('hospital.requests.index') }}" class="text-gray-500 hover:text-gray-700 flex items-center gap-2 mb-4">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7 7-7"></path></svg>
                Back to requests
            </a>
            <h1 class="text-3xl font-bold text-gray-900 font-serif">Donor Responses</h1>
            <p class="mt-2 text-sm text-gray-600">
                Responses for <span class="font-bold text-primary-red">{{ $bloodRequest->blood_type }}</span> request 
                in <span class="font-medium">{{ $bloodRequest->location }}</span>
            </p>
        </div>
        <div class="text-right">
            <span class="text-xs font-bold text-gray-400 uppercase tracking-widest block mb-1">Request Status</span>
            <span class="px-4 py-1.5 bg-gray-100 text-gray-700 rounded-full font-bold text-sm">
                {{ strtoupper($bloodRequest->status) }}
            </span>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6">
        @forelse($responses as $response)
            <div class="bg-white shadow-md rounded-2xl border border-gray-100 p-6 flex flex-col md:flex-row justify-between items-center gap-6 hover:shadow-lg transition-shadow">
                <div class="flex items-center gap-5">
                    <div class="w-16 h-16 bg-red-50 rounded-full flex items-center justify-center text-2xl shadow-inner">
                        🩸
                    </div>
                    <div>
                        <h4 class="text-xl font-bold text-gray-900">{{ $response->donor->first_name }} {{ $response->donor->last_name }}</h4>
                        <p class="text-sm text-gray-500 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            {{ $response->donor->phone ?? 'No phone provided' }}
                        </p>
                        <div class="mt-2 flex gap-2">
                             <span class="px-2 py-0.5 bg-gray-100 text-gray-600 text-[10px] font-bold uppercase rounded">
                                 Joined {{ $response->donor->created_at->format('M Y') }}
                             </span>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col items-center md:items-end gap-3 w-full md:w-auto">
                    <div class="text-center md:text-right">
                        <span class="text-xs text-gray-400 block mb-1 uppercase font-bold tracking-tighter">Response Date</span>
                        <span class="text-sm font-medium text-gray-700">{{ $response->created_at->diffForHumans() }}</span>
                    </div>
                    
                    <div class="flex gap-2 w-full md:w-auto">
                        <a href="tel:{{ $response->donor->phone }}" class="flex-1 md:flex-none text-center px-6 py-2.5 bg-primary-red text-white rounded-xl font-bold hover:bg-red-700 transition-colors shadow-md">
                            Call Donor
                        </a>
                        <button class="flex-1 md:flex-none px-6 py-2.5 bg-gray-100 text-gray-700 rounded-xl font-bold hover:bg-gray-200 transition-colors">
                            Accept
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="bg-gray-50 rounded-3xl border-2 border-dashed border-gray-200 p-20 text-center">
                <div class="text-5xl mb-4 text-gray-300">⏳</div>
                <h3 class="text-xl font-bold text-gray-500">No responses yet</h3>
                <p class="text-gray-400 mt-1">We'll alert the network about your urgent need.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
