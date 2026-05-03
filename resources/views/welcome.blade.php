@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
<!-- Hero Section -->
<section class="min-h-[80vh] px-[10%] py-16 md:py-24 flex flex-col md:flex-row items-center justify-between gap-16 overflow-hidden">
    <div class="max-w-2xl text-center md:text-left z-10">
        <h1 class="text-5xl md:text-7xl font-serif font-bold leading-tight tracking-tight text-text-dark mb-6">
            Donate <span class="text-primary-red">Blood</span>,<br>Save Lives.
        </h1>
        <p class="text-lg md:text-xl text-text-muted mb-10 max-w-xl mx-auto md:mx-0">
            A single drop of your blood can give life to someone in need. Join our community of heroes today and make a difference.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start">
            <a href="{{ route('eligibility') }}" class="btn-primary-custom px-10 py-5 text-xl">Start Your Journey</a>
            <a href="#why" class="px-10 py-5 border-2 border-primary-red text-primary-red font-bold rounded-premium hover:bg-red-50 transition-all text-xl">Learn More</a>
        </div>
    </div>
    
    <div class="relative flex-1 flex justify-center md:justify-end animate-float">
        <!-- Decoration background -->
        <div class="absolute inset-0 bg-red-100 rounded-full blur-3xl opacity-20 -z-10"></div>
        <svg class="w-64 h-80 md:w-96 md:h-full drop-shadow-2xl" viewBox="0 0 400 400">
            <defs>
                <linearGradient id="dropGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                    <stop offset="0%" style="stop-color:#ff4d6d;stop-opacity:1" />
                    <stop offset="100%" style="stop-color:#c9184a;stop-opacity:1" />
                </linearGradient>
            </defs>
            <path d="M200,40 C100,200 40,280 40,320 A160,160 0 0,0 360,320 C360,280 300,200 200,40 Z" fill="url(#dropGradient)" />
            <path d="M220,100 C240,150 210,180 200,200" stroke="white" stroke-width="8" stroke-linecap="round" opacity="0.3" fill="none" />
        </svg>
    </div>
</section>

<!-- Impact Section -->
<section id="why" class="bg-off-white py-24 px-[10%]">
    <div class="text-center mb-16">
        <h2 class="text-3xl md:text-5xl font-serif mb-4 text-text-dark">Why Your Donation Matters</h2>
        <div class="w-24 h-1.5 bg-primary-red mx-auto rounded-full"></div>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
        <div class="bg-white p-10 rounded-premium shadow-premium hover:scale-[1.03] transition-all border border-red-50">
            <div class="text-5xl mb-6">❤️</div>
            <h3 class="text-2xl font-serif mb-3 text-text-dark">Blood Donation</h3>
            <p class="text-text-muted leading-relaxed">Your blood helps patients with major surgeries, cancer treatments, or severe trauma recovery.</p>
        </div>
        <div class="bg-white p-10 rounded-premium shadow-premium hover:scale-[1.03] transition-all border border-red-50">
            <div class="text-5xl mb-6">🩸</div>
            <h3 class="text-2xl font-serif mb-3 text-text-dark">Plasma Donation</h3>
            <p class="text-text-muted leading-relaxed">Plasma provides crucial proteins for patients with immune deficiencies and clotting disorders.</p>
        </div>
        <div class="bg-white p-10 rounded-premium shadow-premium hover:scale-[1.03] transition-all border border-red-50">
            <div class="text-5xl mb-6">🌟</div>
            <h3 class="text-2xl font-serif mb-3 text-text-dark">Become a Hero</h3>
            <p class="text-text-muted leading-relaxed">Join a community of 5,000+ donors who are actively saving lives in your local hospitals.</p>
        </div>
    </div>
</section>

<!-- Compatibility Matrix Section -->
<section class="py-20 px-[5%] bg-white font-sans">
    <div class="text-center mb-12">
        <h2 class="text-3xl md:text-4xl text-[#E31837] mb-4 font-normal">Patients your blood type can help</h2>
        <p class="text-gray-500 text-sm font-normal">Donor's blood type</p>
    </div>

    <div class="max-w-6xl mx-auto overflow-x-auto">
        <table class="w-full border-t border-gray-200">
            <thead>
                <tr>
                    <th class="p-4 w-32 border-r border-gray-100"></th>
                    @foreach(['O-', 'O+', 'B-', 'B+', 'A-', 'A+', 'AB-', 'AB+'] as $type)
                        <th class="p-4 text-gray-400 font-normal text-sm">{{ $type }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @php
                    $compatibility = [
                        'AB+' => ['O-', 'O+', 'B-', 'B+', 'A-', 'A+', 'AB-', 'AB+'],
                        'AB-' => ['O-', 'B-', 'A-', 'AB-'],
                        'A+'  => ['O-', 'O+', 'A-', 'A+'],
                        'A-'  => ['O-', 'A-'],
                        'B+'  => ['O-', 'O+', 'B-', 'B+'],
                        'B-'  => ['O-', 'B-'],
                        'O+'  => ['O-', 'O+'],
                        'O-'  => ['O-'],
                    ];
                @endphp

                @foreach(['AB+', 'AB-', 'A+', 'A-', 'B+', 'B-', 'O+', 'O-'] as $row)
                <tr class="{{ $loop->even ? 'bg-[#F9F9F9]' : '' }} border-t border-gray-100">
                    <td class="p-4 text-center text-gray-500 font-normal text-sm border-r border-gray-100">{{ $row }}</td>
                    @foreach(['O-', 'O+', 'B-', 'B+', 'A-', 'A+', 'AB-', 'AB+'] as $col)
                    <td class="p-4 text-center">
                        @if(in_array($col, $compatibility[$row]))
                            <div class="w-4 h-4 bg-[#E31837] rounded-full mx-auto"></div>
                        @endif
                    </td>
                    @endforeach
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
<section class="py-24 px-[10%] text-center relative overflow-hidden">
    <div class="absolute -top-24 -left-24 w-64 h-64 bg-red-50 rounded-full mix-blend-multiply opacity-50 blur-3xl"></div>
    <div class="absolute -bottom-24 -right-24 w-64 h-64 bg-red-100 rounded-full mix-blend-multiply opacity-50 blur-3xl"></div>
    
    <div class="max-w-3xl mx-auto z-10 relative">
        <h2 class="text-4xl font-serif mb-6 text-text-dark tracking-tight">Ready to save a life today?</h2>
        <p class="text-lg text-text-muted mb-10 leading-relaxed">Each donation can save up to three lives. It’s simple, safe, and only takes about 45 minutes of your time.</p>
        <a href="{{ route('register') }}" class="btn-primary-custom px-12 py-5 text-xl font-bold">Register as a Donor</a>
    </div>
</section>
@endsection
