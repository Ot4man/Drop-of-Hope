@extends('layouts.app')

@section('title', 'My Notifications')

@section('content')
    <section class="min-h-[80vh] py-16 px-[5%] md:px-[10%] bg-off-white">
        <div class="max-w-4xl mx-auto space-y-8">

            <div class="flex justify-between items-center px-4">
                <h1 class="text-3xl font-serif font-bold text-text-dark tracking-tight">Notifications</h1>
                <a href="{{ route('donor.dashboard') }}"
                    class="text-sm text-text-muted hover:text-primary-red transition-colors">Back to Dashboard</a>
            </div>

            <div class="space-y-4">
                @forelse($notifications as $notification)
                    <div
                        class="bg-white p-6 rounded-2xl shadow-md border-l-4 {{ $notification->read_at ? 'border-gray-200 opacity-75' : 'border-primary-red' }} flex flex-col md:flex-row justify-between items-start md:items-center gap-6 group hover:shadow-lg transition-all">
                        <div class="flex items-center gap-4">
                            <div
                                class="w-12 h-12 {{ $notification->read_at ? 'bg-gray-50 text-gray-400' : 'bg-red-50 text-primary-red' }} rounded-xl flex items-center justify-center text-xl">
                                @if(isset($notification->data['blood_request_id']))
                                    🚨
                                @else
                                    📅
                                @endif
                            </div>
                            <div>
                                <p class="font-bold text-text-dark">
                                    {{ $notification->data['message'] ?? 'Notification received' }}
                                </p>
                                <p class="text-sm text-text-muted italic">
                                    {{ $notification->data['hospital_name'] ?? 'System' }} •
                                    {{ $notification->created_at->diffForHumans() }}
                                </p>
                            </div>
                        </div>

                        <div class="flex gap-2 w-full md:w-auto">
                            @if(isset($notification->data['blood_request_id']))
                                <a href="{{ route('donor.requests.show', $notification->data['blood_request_id']) }}"
                                    class="flex-1 md:flex-none text-center bg-primary-red text-white px-6 py-2 rounded-lg font-bold text-sm hover:bg-red-700 transition-colors">
                                    View Request
                                </a>
                            @elseif(isset($notification->data['appointment_id']))
                                <a href="{{ route('donor.appointments.index') }}"
                                    class="flex-1 md:flex-none text-center bg-gray-900 text-white px-6 py-2 rounded-lg font-bold text-sm hover:bg-black transition-colors">
                                    View Appointment
                                </a>
                            @endif

                            @if(!$notification->read_at)
                                {{-- Optional: Add mark as read button --}}
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="bg-white p-20 rounded-[3rem] text-center border border-gray-100 shadow-sm">
                        <p class="text-5xl mb-4">📭</p>
                        <h3 class="text-xl font-bold text-text-dark">All caught up!</h3>
                        <p class="text-text-muted mt-2">No new notifications for you at the moment.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-8">
                {{ $notifications->links() }}
            </div>
        </div>
    </section>
@endsection