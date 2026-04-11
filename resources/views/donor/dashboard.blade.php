@extends('layouts.app')

@section('title', 'Donor Dashboard')

@section('content')
<section class="min-h-[80vh] py-16 px-[10%] bg-off-white">
    <div class="bg-white p-10 md:p-16 rounded-[2rem] shadow-xl border border-red-50 max-w-6xl mx-auto">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-12 gap-6">
            <div>
                <h2 class="text-4xl font-serif font-bold text-text-dark tracking-tight leading-none mb-3">Welcome, <span class="text-primary-red">{{ auth()->user()->first_name }}!</span></h2>
                <p class="text-text-muted text-lg">Thank you for your life-saving commitment.</p>
            </div>
            <div class="bg-red-50 px-6 py-3 rounded-full flex items-center gap-3 shadow-sm border border-red-100">
                <span class="w-3 h-3 bg-primary-red rounded-full animate-pulse shadow-[0_0_8px_rgba(200,16,46,0.5)]"></span>
                <span class="text-primary-red font-bold text-sm uppercase tracking-wider">Active Donor</span>
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
            <!-- Donations Metric -->
            <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-all group">
                <div class="flex justify-between items-center mb-4">
                    <h4 class="text-text-muted font-medium text-sm">Total Donations</h4>
                    <div class="p-2 bg-red-50 rounded-lg group-hover:bg-primary-red transition-all">
                        <svg class="w-5 h-5 text-primary-red group-hover:text-white transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                    </div>
                </div>
                <p class="text-5xl font-black text-primary-red leading-none">0</p>
                <p class="text-xs text-text-muted mt-4 opacity-70 italic">*Last donation: Never</p>
            </div>

            <!-- Blood Type Metric -->
            <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-all group">
                <div class="flex justify-between items-center mb-4">
                     <h4 class="text-text-muted font-medium text-sm">Blood Type</h4>
                     <div class="p-2 bg-gray-50 rounded-lg group-hover:bg-gray-800 transition-all">
                        <svg class="w-5 h-5 text-gray-500 group-hover:text-white transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                     </div>
                </div>
                <p class="text-5xl font-black text-gray-800 leading-none">{{ auth()->user()->donorProfile->blood_type ?? '--' }}</p>
                <p class="text-xs text-primary-red mt-4 font-bold flex items-center gap-1 group-hover:underline cursor-pointer">Update pending <span class="text-lg">↗</span></p>
            </div>

            <!-- Eligibility Status Metric -->
            <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-all">
                <div class="flex justify-between items-center mb-4">
                    <h4 class="text-text-muted font-medium text-sm">Eligibility Status</h4>
                    <div class="p-2 bg-teal-50 rounded-lg">
                        <svg class="w-5 h-5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                </div>
                <p class="text-xl font-bold text-teal-600 leading-tight">Ready to<br>Save Lives</p>
                <div class="mt-4 w-full bg-gray-100 h-2 rounded-full overflow-hidden">
                    <div class="bg-teal-500 h-full w-full"></div>
                </div>
            </div>
        </div>
        
        <div class="flex flex-wrap gap-4 pt-10 border-t border-gray-50">
            <a href="#" class="btn-primary-custom px-8 py-4 text-base font-bold flex items-center gap-2 hover:scale-105 transition-transform">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                Find Blood Request
            </a>
            <a href="{{ route('profile.edit') }}" class="px-8 py-4 border-2 border-primary-red text-primary-red rounded-xl font-bold hover:bg-red-50 transition-all flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                Update Profile
            </a>
            
            <form action="{{ route('logout') }}" method="POST" class="ml-auto">
                @csrf
                <button type="submit" class="px-8 py-4 bg-gray-100 text-gray-600 rounded-xl font-bold hover:bg-gray-200 transition-all flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Logout
                </button>
            </form>
        </div>
    </div>
</section>
@endsection
