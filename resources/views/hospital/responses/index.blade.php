@extends('layouts.app')

@section('title', 'Donor Responses')

@section('content')
<section class="min-h-screen py-20 px-[5%] md:px-[10%] bg-off-white">
    <div class="max-w-6xl mx-auto space-y-12">
        
        <div class="flex justify-between items-end">
            <div>
                <h1 class="text-4xl font-black text-text-dark mb-2">Donor Responses</h1>
                <p class="text-text-muted">Manage all incoming donation offers from the community.</p>
            </div>
        </div>

        <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-gray-50/50 border-b border-gray-100">
                        <th class="p-6 text-xs font-black uppercase tracking-widest text-gray-400">Donor</th>
                        <th class="p-6 text-xs font-black uppercase tracking-widest text-gray-400">Blood Type</th>
                        <th class="p-6 text-xs font-black uppercase tracking-widest text-gray-400">Request</th>
                        <th class="p-6 text-xs font-black uppercase tracking-widest text-gray-400">Status</th>
                        <th class="p-6 text-xs font-black uppercase tracking-widest text-gray-400 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($responses as $response)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="p-6">
                            <div class="font-bold text-text-dark">{{ $response->donorProfile->user->first_name }} {{ $response->donorProfile->user->last_name }}</div>
                            <div class="text-xs text-text-muted">📍 {{ $response->donorProfile->city }}</div>
                        </td>
                        <td class="p-6">
                            <span class="px-3 py-1 bg-red-50 text-primary-red rounded-lg font-black text-xs">{{ $response->bloodRequest->blood_type }}</span>
                        </td>
                        <td class="p-6 text-sm text-text-muted">
                            Req #{{ $response->bloodRequest->id }} ({{ $response->bloodRequest->urgency }})
                        </td>
                        <td class="p-6">
                            @php
                                $statusClasses = match($response->status) {
                                    'pending' => 'bg-yellow-50 text-yellow-700',
                                    'accepted' => 'bg-green-50 text-green-700',
                                    'rejected' => 'bg-gray-50 text-gray-400',
                                    default => 'bg-gray-50 text-gray-400'
                                };
                            @endphp
                            <span class="px-3 py-1 rounded-lg text-[10px] font-black uppercase tracking-widest {{ $statusClasses }}">
                                {{ $response->status }}
                            </span>
                        </td>
                        <td class="p-6 text-right">
                            @if($response->status === 'pending')
                                <div class="flex justify-end gap-2">
                                    <form action="{{ route('hospital.requests.accept', $response->id) }}" method="POST">
                                        @csrf
                                        <button class="px-4 py-2 bg-gray-900 text-white rounded-xl text-xs font-bold hover:bg-black transition">Accept</button>
                                    </form>
                                    <form action="{{ route('hospital.requests.reject', $response->id) }}" method="POST">
                                        @csrf
                                        <button class="px-4 py-2 border border-gray-200 text-gray-600 rounded-xl text-xs font-bold hover:bg-gray-50 transition">Reject</button>
                                    </form>
                                </div>
                            @else
                                <span class="text-xs text-text-muted italic">Processed</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="p-20 text-center">
                            <p class="text-5xl mb-4 grayscale opacity-20">📥</p>
                            <h4 class="text-xl font-bold text-text-dark">No responses yet</h4>
                            <p class="text-text-muted">New donor responses will appear here.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-8">
            {{ $responses->links() }}
        </div>
    </div>
</section>
@endsection
