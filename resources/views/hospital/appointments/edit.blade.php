@extends('layouts.app')

@section('title', 'Schedule Appointment')

@section('content')
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        <div class="mb-8">
            <a href="{{ route('hospital.appointments.index') }}"
                class="text-gray-500 hover:text-gray-700 flex items-center gap-2 mb-4">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7 7-7" />
                </svg>
                Back to Appointments
            </a>
            <h1 class="text-3xl font-bold text-gray-900 font-serif">Schedule Appointment</h1>
            <p class="mt-1 text-sm text-gray-500">Set a date and time for the donor to arrive.</p>
        </div>

        <div class="bg-white rounded-[2rem] shadow-xl border border-gray-100 overflow-hidden">

            <div class="bg-gray-800 py-4 px-10">
                <p class="text-white text-xs font-black uppercase tracking-[0.3em]">Appointment Details</p>
            </div>

            <div class="p-10">

                <div class="grid grid-cols-2 gap-6 mb-8 p-6 bg-gray-50 rounded-2xl border border-gray-100">
                    <div>
                        <span class="text-xs font-bold text-gray-400 uppercase tracking-widest block mb-1">Donor</span>
                        <p class="font-bold text-gray-900">{{ $appointment->donor->first_name }}
                            {{ $appointment->donor->last_name }}</p>
                    </div>
                    <div>
                        <span class="text-xs font-bold text-gray-400 uppercase tracking-widest block mb-1">Blood Type</span>
                        <p class="font-bold text-primary-red text-xl">
                            {{ $appointment->response->bloodRequest->blood_type ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <span class="text-xs font-bold text-gray-400 uppercase tracking-widest block mb-1">Location</span>
                        <p class="font-bold text-gray-700">{{ $appointment->response->bloodRequest->location ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <span class="text-xs font-bold text-gray-400 uppercase tracking-widest block mb-1">Current
                            Status</span>
                        <span
                            class="px-3 py-1 text-xs font-black uppercase rounded-full
                            {{ $appointment->status === 'confirmed' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                            {{ $appointment->status }}
                        </span>
                    </div>
                </div>

                <form action="{{ route('hospital.appointments.update', $appointment->id) }}" method="POST"
                    class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="scheduled_at" class="block text-sm font-bold text-gray-700 mb-2">
                            Date & Time <span class="text-primary-red">*</span>
                        </label>
                        <input type="datetime-local" id="scheduled_at" name="scheduled_at"
                            value="{{ old('scheduled_at', $appointment->scheduled_at?->format('Y-m-d\TH:i')) }}"
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-red focus:border-transparent transition-all @error('scheduled_at') border-red-400 @enderror"
                            required>
                        @error('scheduled_at')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="notes" class="block text-sm font-bold text-gray-700 mb-2">
                            Notes <span class="text-gray-400 font-normal">(optional)</span>
                        </label>
                        <textarea id="notes" name="notes" rows="4"
                            placeholder="e.g. Please bring your ID and arrive 10 minutes early."
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-red focus:border-transparent transition-all resize-none @error('notes') border-red-400 @enderror">{{ old('notes', $appointment->notes) }}</textarea>
                        @error('notes')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit"
                        class="w-full py-4 bg-primary-red text-white rounded-xl font-black text-lg uppercase tracking-widest hover:bg-red-700 transition-all shadow-lg hover:shadow-xl active:scale-95">
                        Confirm Appointment
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection