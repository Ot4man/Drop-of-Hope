@extends('layouts.app')

@section('title', 'Hospital Notifications')

@section('content')
    <section class="min-h-screen py-20 px-[5%] md:px-[10%] bg-off-white">
        <div class="max-w-4xl mx-auto space-y-12">

            <div class="flex justify-between items-end">
                <div>
                    <h1 class="text-4xl font-black text-text-dark mb-2">Notifications</h1>
                    <p class="text-text-muted">Stay updated with donor responses and system alerts.</p>
                </div>
            </div>

            <div class="space-y-4">
                @forelse($notifications as $notification)
                    <div
                        <div class="w-12 h-12 bg-gray-50 rounded-2xl flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-bell text-gray-500 text-xl"></i>
                        </div>
                        <div class="flex-grow">
                            <div class="flex justify-between items-start mb-1">
                                <span
                                    class="text-[10px] font-black uppercase tracking-widest text-gray-400">{{ $notification->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-text-dark font-medium leading-relaxed">{{ $notification->message }}</p>
                            @if($notification->link)
                                <a href="{{ $notification->link }}"
                                    class="inline-block mt-3 text-xs font-bold text-primary-red hover:underline italic">View details
                                    &rarr;</a>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="bg-white p-20 rounded-[2.5rem] border border-gray-100 text-center">
                        <p class="text-5xl mb-4 text-gray-200">
                            <i class="fas fa-bell-slash"></i>
                        </p>
                        <h4 class="text-xl font-bold text-text-dark">All caught up!</h4>
                        <p class="text-text-muted">No new notifications for your hospital.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-8">
                {{ $notifications->links() }}
            </div>
        </div>
    </section>
@endsection