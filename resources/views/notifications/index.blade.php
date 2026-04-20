@extends('layouts.app')

@section('title', 'Notifications')

@section('content')
<section class="min-h-screen py-20 px-[5%] md:px-[10%] bg-off-white">
    <div class="max-w-4xl mx-auto space-y-12">
        
        <div class="flex justify-between items-end">
            <div>
                <h1 class="text-4xl font-black text-text-dark mb-2">Notifications</h1>
                <p class="text-text-muted">Stay updated with system activities.</p>
            </div>
        </div>

        <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
            <div class="divide-y divide-gray-50">
                @forelse($notifications as $notification)
                    <div class="p-8 hover:bg-gray-50 transition-all flex gap-6 items-start {{ $notification->read_at ? 'opacity-60' : '' }}">
                        <div class="w-12 h-12 rounded-2xl bg-gray-50 flex items-center justify-center text-gray-500 flex-shrink-0">
                            @if($notification->type === 'urgent_request')
                                <i class="fas fa-triangle-exclamation text-xl"></i>
                            @elseif($notification->type === 'response_accepted')
                                <i class="fas fa-circle-check text-xl"></i>
                            @else
                                <i class="fas fa-bell text-xl"></i>
                            @endif
                        </div>
                        
                        <div class="flex-1">
                            <div class="flex justify-between items-start mb-2">
                                <h4 class="font-bold text-text-dark leading-snug">{{ $notification->message }}</h4>
                                <span class="text-[10px] font-black uppercase tracking-widest text-gray-400 whitespace-nowrap ml-4">
                                    {{ $notification->created_at->diffForHumans() }}
                                </span>
                            </div>
                            
                            @if($notification->link)
                                <a href="{{ $notification->link }}" class="inline-block mt-4 text-xs font-bold text-primary-red hover:underline">
                                    View Details &rarr;
                                </a>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="p-20 text-center">
                        <p class="text-5xl mb-6 grayscale opacity-20">📭</p>
                        <h4 class="text-xl font-bold text-text-dark">All caught up!</h4>
                        <p class="text-text-muted mt-2">No new notifications at the moment.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <div class="mt-8">
            {{ $notifications->links() }}
        </div>
    </div>
</section>
@endsection
