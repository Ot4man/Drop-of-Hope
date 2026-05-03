@extends('layouts.app')

@section('title', 'All Blood Requests')

@section('content')
<section class="min-h-screen py-20 px-[5%] md:px-[10%] bg-off-white">
    <div class="max-w-6xl mx-auto space-y-12">
        
        <div class="flex justify-between items-end">
            <div>
                <h1 class="text-4xl font-black text-text-dark mb-2">My Blood Requests</h1>
                <p class="text-text-muted">Manage your active and closed blood donation requests.</p>
            </div>
            <a href="{{ route('hospital.requests.create') }}" class="btn-primary-custom px-8 py-3">
                Create New Request
            </a>
        </div>

        <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-gray-50/50 border-b border-gray-100">
                        <th class="p-6 text-xs font-black uppercase tracking-widest text-gray-400">Date</th>
                        <th class="p-6 text-xs font-black uppercase tracking-widest text-gray-400">Blood Type</th>
                        <th class="p-6 text-xs font-black uppercase tracking-widest text-gray-400">Quantity</th>
                        <th class="p-6 text-xs font-black uppercase tracking-widest text-gray-400">Urgency</th>
                        <th class="p-6 text-xs font-black uppercase tracking-widest text-gray-400">Status</th>
                        <th class="p-6 text-xs font-black uppercase tracking-widest text-gray-400 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($requests as $request)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="p-6 text-sm text-text-muted">
                            {{ $request->created_at->format('M d, Y') }}
                        </td>
                        <td class="p-6">
                            <span class="w-10 h-10 bg-red-50 text-primary-red rounded-lg flex items-center justify-center font-black text-sm border border-red-100">
                                {{ $request->blood_type }}
                            </span>
                        </td>
                        <td class="p-6 text-sm font-bold text-text-dark">
                            {{ $request->quantity }} Units
                        </td>
                        <td class="p-6">
                            @php
                                $urgencyClasses = match(strtolower($request->urgency)) {
                                    'critical' => 'text-red-600',
                                    'high' => 'text-orange-600',
                                    'medium' => 'text-yellow-600',
                                    'low' => 'text-green-600',
                                    default => 'text-gray-600'
                                };
                            @endphp
                            <span class="text-xs font-black uppercase tracking-widest {{ $urgencyClasses }}">
                                {{ $request->urgency }}
                            </span>
                        </td>
                        <td class="p-6">
                            <span class="px-3 py-1 rounded-lg text-[10px] font-black uppercase tracking-widest {{ $request->status === 'open' ? 'bg-green-50 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                                {{ $request->status }}
                            </span>
                        </td>
                        <td class="p-6 text-right">
                            <div class="flex justify-end gap-3">
                                <a href="{{ route('hospital.requests.show', $request->id) }}" class="text-xs font-bold text-gray-400 hover:text-primary-red transition">View</a>
                                @if($request->status === 'open')
                                    <a href="{{ route('hospital.requests.edit', $request->id) }}" class="text-xs font-bold text-gray-400 hover:text-blue-600 transition">Edit</a>
                                    <form action="{{ route('hospital.requests.close', $request->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="text-xs font-bold text-gray-400 hover:text-red-600 transition">Close</button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="p-20 text-center">
                            <p class="text-5xl mb-4 grayscale opacity-20">📋</p>
                            <h4 class="text-xl font-bold text-text-dark">No requests found</h4>
                            <p class="text-text-muted">Start by creating your first blood request.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-8">
            {{ $requests->links() }}
        </div>
    </div>
</section>
@endsection
