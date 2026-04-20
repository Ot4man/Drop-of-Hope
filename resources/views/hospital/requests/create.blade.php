@extends('layouts.app')

@section('title', 'Request Blood')

@section('content')
    <section class="min-h-[80vh] py-20 px-[5%] md:px-[10%] bg-off-white">
        <div class="max-w-2xl mx-auto space-y-12">

            <div class="text-center space-y-4">
                <p class="text-primary-red font-black uppercase tracking-[0.4em] text-[10px]">Urgent Requirement</p>
                <h1 class="text-5xl font-serif font-bold text-text-dark tracking-tight">Post a Blood <span
                        class="text-primary-red">Request</span></h1>
                <p class="text-text-muted leading-relaxed">Submit a request to alert all matching and eligible donors in
                    your area immediately.</p>
            </div>

            <div class="premium-card overflow-hidden">
                <div class="bg-gray-900 py-6 px-12 relative overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-r from-primary-red/20 to-transparent"></div>
                    <p class="text-white text-[10px] font-black uppercase tracking-[0.4em] relative z-10">Request Details
                    </p>
                </div>

                <form action="{{ route('hospital.requests.store') }}" method="POST" class="p-12 space-y-10">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                        {{-- Blood Type --}}
                        <div class="space-y-6">
                            <label for="blood_type"
                                class="block text-xs font-black text-gray-400 uppercase tracking-[0.2em]">Required Blood
                                Type</label>
                            <select name="blood_type" id="blood_type"
                                class="w-full px-8 py-5 bg-gray-50 border-2 border-border-subtle rounded-[2rem] focus:border-primary-red focus:bg-white focus:outline-none transition-all font-bold text-text-dark appearance-none cursor-pointer"
                                required>
                                @foreach(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $type)
                                    <option value="{{ $type }}">{{ $type }}</option>
                                @endforeach
                            </select>
                            @error('blood_type')
                                <p class="text-primary-red text-[10px] font-bold px-4">× {{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Quantity --}}
                        <div class="space-y-6">
                            <label for="quantity"
                                class="block text-xs font-black text-gray-400 uppercase tracking-[0.2em]">Quantity
                                (Units)</label>
                            <input type="number" name="quantity" id="quantity" min="1" placeholder="e.g. 5"
                                class="w-full px-8 py-5 bg-gray-50 border-2 border-border-subtle rounded-[2rem] focus:border-primary-red focus:bg-white focus:outline-none transition-all font-bold text-text-dark"
                                required>
                            @error('quantity')
                                <p class="text-primary-red text-[10px] font-bold px-4">× {{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                        {{-- Urgency --}}
                        <div class="space-y-6">
                            <label for="urgency"
                                class="block text-xs font-black text-gray-400 uppercase tracking-[0.2em]">Urgency
                                Level</label>
                            <select name="urgency" id="urgency"
                                class="w-full px-8 py-5 bg-gray-50 border-2 border-border-subtle rounded-[2rem] focus:border-primary-red focus:bg-white focus:outline-none transition-all font-bold text-text-dark appearance-none cursor-pointer"
                                required>
                                <option value="low">Low - Routine</option>
                                <option value="medium">Medium - Normal</option>
                                <option value="high">High - Urgent</option>
                                <option value="critical">Critical - Emergency</option>
                            </select>
                            @error('urgency')
                                <p class="text-primary-red text-[10px] font-bold px-4">× {{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Location --}}
                        <div class="space-y-6">
                            <label for="location"
                                class="block text-xs font-black text-gray-400 uppercase tracking-[0.2em]">Collection
                                City</label>
                            <input type="text" name="location" id="location"
                                value="{{ auth()->user()->hospitalProfile->city }}"
                                class="w-full px-8 py-5 bg-gray-50 border-2 border-border-subtle rounded-[2rem] focus:border-primary-red focus:bg-white focus:outline-none transition-all font-bold text-text-dark"
                                required>
                            @error('location')
                                <p class="text-primary-red text-[10px] font-bold px-4">× {{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="pt-6">
                        <button type="submit" class="btn-primary-custom w-full py-6 text-xl shadow-2xl">
                            Create Blood Request
                        </button>
                        <div class="flex items-center justify-center gap-4 mt-10">
                            <span class="h-px w-8 bg-gray-100"></span>
                            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-[0.2em]">Notifications will be
                                sent immediately</p>
                            <span class="h-px w-8 bg-gray-100"></span>
                        </div>
                    </div>
                </form>
            </div>

            <div class="text-center">
                <a href="{{ route('hospital.dashboard') }}"
                    class="text-sm font-bold text-text-muted hover:text-primary-red transition-all underline decoration-dotted underline-offset-8">
                    Cancel and return to dashboard
                </a>
            </div>
        </div>
    </section>
@endsection