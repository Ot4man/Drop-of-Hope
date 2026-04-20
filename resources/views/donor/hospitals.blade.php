@extends('layouts.app')

@section('title', 'Verified Hospitals')

@section('content')
<section class="min-h-[80vh] py-16 px-[5%] md:px-[10%] bg-off-white">
    <div class="max-w-7xl mx-auto space-y-14">

        <div class="flex flex-col md:flex-row justify-between gap-10 border-b border-gray-200 pb-10">
            
            <div class="max-w-2xl space-y-3">
                <p class="text-primary-red font-semibold uppercase tracking-widest text-xs">
                    Medical Network
                </p>

                <h1 class="text-4xl md:text-5xl font-serif font-bold text-text-dark leading-tight">
                    Trusted <span class="text-primary-red">Hospitals</span> & Partners
                </h1>

                <p class="text-text-muted text-base leading-relaxed">
                    Explore our verified medical facilities. Each hospital is carefully reviewed to ensure quality care and patient safety.
                </p>
            </div>

            <div class="w-full md:w-[320px]">
                <label class="text-xs text-gray-500 font-medium">Search hospitals</label>
                <div class="mt-2 flex items-center gap-3 bg-white border border-gray-200 rounded-xl px-4 py-3 shadow-sm focus-within:ring-2 focus-within:ring-primary-red/20">
                    <i class="fas fa-search text-gray-400 text-sm"></i>
                    <input
                        type="text"
                        placeholder="Search by name or city..."
                        class="w-full text-sm bg-transparent focus:outline-none"
                    >
                </div>
            </div>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

            @forelse($hospitals as $hospital)
                <div class="bg-white border border-gray-100 rounded-2xl shadow-sm hover:shadow-md transition overflow-hidden flex flex-col">
                    <div class="h-40 bg-gray-50 flex items-center justify-center relative">
                        <i class="fas fa-hospital text-5xl text-gray-300"></i>

                        <span class="absolute top-4 left-4 bg-green-50 text-green-600 text-[10px] font-semibold px-3 py-1 rounded-full border border-green-100 flex items-center gap-2">
                            <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                            Verified
                        </span>
                    </div>

                    <div class="p-6 flex flex-col gap-5 flex-1">

                        <div>
                            <h3 class="text-xl font-semibold text-text-dark">
                                {{ $hospital->hospital_name }}
                            </h3>

                            <p class="text-sm text-text-muted mt-1 flex items-center gap-2">
                                <i class="fas fa-location-dot text-primary-red/60"></i>
                                {{ $hospital->city }}
                            </p>

                            <p class="text-xs text-gray-400 mt-1 line-clamp-1">
                                {{ $hospital->address }}
                            </p>
                        </div>

                        <div class="grid grid-cols-2 text-xs text-text-muted border-t border-b border-gray-100 py-4">
                            <div>
                                <p class="text-[10px] uppercase tracking-wide text-gray-400">Contact</p>
                                <p class="font-medium text-text-dark mt-1">
                                    {{ $hospital->contact_phone }}
                                </p>
                            </div>

                            <div class="text-right">
                                <p class="text-[10px] uppercase tracking-wide text-gray-400">License</p>
                                <p class="font-medium text-text-dark mt-1">
                                    #{{ $hospital->license_number }}
                                </p>
                            </div>
                        </div>

                        <div class="flex flex-col gap-3 mt-auto">

                            <a href="{{ route('donor.hospitals.show', $hospital->id) }}"
                               class="w-full text-center py-3 rounded-xl border border-gray-200 text-sm font-medium text-text-dark hover:bg-gray-50 transition">
                                View Profile
                            </a>

                            <a href="{{ route('donor.appointments.create', ['hospital_id' => $hospital->id]) }}"
                               class="w-full text-center py-3 rounded-xl bg-primary-red text-white text-sm font-semibold hover:bg-red-700 transition">
                                Schedule Visit
                            </a>

                        </div>

                    </div>
                </div>

            @empty
                <div class="col-span-full text-center py-20 border border-dashed border-gray-200 rounded-2xl bg-white">
                    <i class="fas fa-hospital text-5xl text-gray-200 mb-4"></i>
                    <h3 class="text-xl font-semibold text-text-dark">No hospitals found</h3>
                    <p class="text-text-muted mt-2 max-w-md mx-auto text-sm">
                        We are currently adding new verified medical partners. Please check back later.
                    </p>
                </div>
            @endforelse

        </div>

        <div class="flex justify-center pt-10 border-t border-gray-100">
            {{ $hospitals->links() }}
        </div>

    </div>
</section>
@endsection