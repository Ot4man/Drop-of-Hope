@extends('layouts.app')

@section('title', $hospital->hospital_name)

@section('content')
<section class="min-h-[80vh] py-16 px-[5%] md:px-[10%] bg-off-white">
    <div class="max-w-4xl mx-auto">

        <a href="{{ route('donor.hospitals') }}" class="text-gray-500 hover:text-primary-red transition-colors flex items-center gap-2 mb-8 font-bold">
            <i class="fas fa-arrow-left"></i>
            Back to Hospitals
        </a>

        <div class="bg-white rounded-[3rem] shadow-2xl overflow-hidden border border-gray-100">
            <div class="h-64 bg-gradient-to-br from-primary-red to-red-800 p-12 flex items-end">
                <div>
                    <span class="bg-white/20 backdrop-blur-md text-white text-[10px] font-black uppercase tracking-[0.3em] px-4 py-1 rounded-full mb-4 inline-block">Verified Facility</span>
                    <h1 class="text-5xl font-serif font-bold text-white tracking-tight">{{ $hospital->hospital_name }}</h1>
                </div>
            </div>

            <div class="p-12 grid grid-cols-1 md:grid-cols-3 gap-12">
                <div class="md:col-span-2 space-y-8">
                    <div class="space-y-4">
                        <h3 class="text-xl font-bold text-text-dark border-b pb-2">Facility Information</h3>
                        <div class="grid grid-cols-1 gap-6">
                            <div class="flex items-start gap-4">
                                <span class="text-xl text-gray-400 mt-1"><i class="fas fa-location-dot"></i></span>
                                <div>
                                    <p class="text-xs font-black text-gray-400 uppercase tracking-widest">Address</p>
                                    <p class="text-lg font-bold text-text-dark">{{ $hospital->address }}</p>
                                    <p class="text-text-muted">{{ $hospital->city }}</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4">
                                <span class="text-xl text-gray-400 mt-1"><i class="fas fa-phone"></i></span>
                                <div>
                                    <p class="text-xs font-black text-gray-400 uppercase tracking-widest">Contact Phone</p>
                                    <p class="text-lg font-bold text-text-dark">{{ $hospital->contact_phone }}</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4">
                                <span class="text-xl text-gray-400 mt-1"><i class="fas fa-envelope"></i></span>
                                <div>
                                    <p class="text-xs font-black text-gray-400 uppercase tracking-widest">Email Address</p>
                                    <p class="text-lg font-bold text-text-dark">{{ $hospital->user->email }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="p-8 bg-red-50 rounded-3xl border border-red-100">
                        <h4 class="font-bold text-primary-red mb-2">Ready to save a life?</h4>
                        <p class="text-sm text-red-700 leading-relaxed">Book an appointment today. Our staff is ready to welcome you in a safe and professional environment.</p>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="bg-gray-50 p-8 rounded-[2rem] border border-gray-100 space-y-6">
                        <div>
                            <p class="text-xs font-black text-gray-400 uppercase tracking-widest mb-1">License Number</p>
                            <p class="font-bold text-text-dark text-lg">#{{ $hospital->license_number }}</p>
                        </div>

                        <a href="{{ route('donor.appointments.create', ['hospital_id' => $hospital->id]) }}" class="block w-full text-center py-5 bg-primary-red text-white rounded-2xl font-black uppercase tracking-widest hover:bg-red-700 transition-all shadow-xl hover:shadow-2xl active:scale-95 text-sm">
                            Book Now 
                        </a>

                        <a href="https://www.google.com/maps/search/{{ urlencode($hospital->hospital_name . ' ' . $hospital->city) }}" target="_blank" class="block w-full text-center py-4 bg-white text-text-dark border-2 border-gray-100 rounded-2xl font-bold hover:bg-gray-100 transition-all text-sm">
                            Get Directions
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
