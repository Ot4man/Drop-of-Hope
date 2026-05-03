@extends('layouts.app')

@section('title', 'Book Appointment')

@section('content')
    <section class="min-h-[80vh] py-16 px-[5%] md:px-[10%] bg-off-white">
        <div class="max-w-2xl mx-auto">

            <div class="mb-12 text-center">
                <h1 class="text-4xl font-serif font-bold text-text-dark tracking-tight">Schedule Your <span
                        class="text-primary-red">Donation</span></h1>
                <p class="text-text-muted mt-2">Book an appointment with
                    <strong>{{ $hospital->hospital_name }}</strong></p>
            </div>

            <div class="bg-white rounded-[3rem] shadow-2xl border border-gray-100 overflow-hidden">
                <div class="bg-gray-900 py-4 px-10">
                    <p class="text-white text-[10px] font-black uppercase tracking-[0.3em]">Appointment Request Form</p>
                </div>

                <form action="{{ route('donor.appointments.store') }}" method="POST" class="p-10 space-y-8">
                    @csrf
                    <input type="hidden" name="hospital_id" value="{{ $hospital->id }}">

                    <div class="space-y-4">
                        <label for="scheduled_at"
                            class="block text-sm font-black text-gray-700 uppercase tracking-widest">Select Date &
                            Time</label>
                        <input type="datetime-local" name="scheduled_at" id="scheduled_at"
                            class="w-full px-6 py-4 bg-gray-50 border-2 border-gray-100 rounded-2xl focus:border-primary-red focus:outline-none transition-all font-bold text-text-dark"
                            required min="{{ date('Y-m-d\TH:i') }}">
                        @error('scheduled_at')
                            <p class="text-primary-red text-xs font-bold">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-4">
                        <label for="notes"
                            class="block text-sm font-black text-gray-700 uppercase tracking-widest">Additional Notes <span
                                class="text-gray-300 font-normal italic">(Optional)</span></label>
                        <textarea name="notes" id="notes" rows="4"
                            placeholder="Any medical conditions or specific requirements?"
                            class="w-full px-6 py-4 bg-gray-50 border-2 border-gray-100 rounded-2xl focus:border-primary-red focus:outline-none transition-all font-medium text-text-dark resize-none"></textarea>
                        @error('notes')
                            <p class="text-primary-red text-xs font-bold">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pt-4">
                        <button type="submit"
                            class="w-full py-5 bg-primary-red text-white rounded-2xl font-black uppercase tracking-widest hover:bg-red-700 transition-all shadow-xl hover:shadow-2xl active:scale-95 text-lg">
                            Confirm Request
                        </button>
                        <p class="text-center text-xs text-gray-400 mt-6 italic">The hospital will review your request and
                            confirm the slot.</p>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection