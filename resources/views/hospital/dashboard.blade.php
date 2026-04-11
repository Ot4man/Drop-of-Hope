@extends('layouts.app')

@section('title', 'Hospital Dashboard')

@section('content')
<section class="min-h-[80vh] py-16 px-[10%] bg-off-white">
    <div class="bg-white p-10 md:p-16 rounded-[2rem] shadow-xl border border-gray-100 max-w-6xl mx-auto">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-12 gap-6">
            <div>
                <h2 class="text-4xl font-serif font-bold text-text-dark tracking-tight leading-none mb-3">Welcome, <span class="text-primary-red">{{ auth()->user()->hospitalProfile->hospital_name ?? 'Hospital Admin' }}</span></h2>
                <p class="text-text-muted text-lg">Manage your blood inventory and urgent requests.</p>
            </div>
            <div class="bg-teal-50 px-6 py-3 rounded-full flex items-center gap-3 shadow-sm border border-teal-100">
                <span class="w-3 h-3 bg-teal-500 rounded-full animate-pulse shadow-[0_0_8px_rgba(20,184,166,0.6)]"></span>
                <span class="text-teal-700 font-bold text-sm uppercase tracking-wider">Verified Facility</span>
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
            <!-- Urgent Requests Metric -->
            <div class="bg-white p-8 rounded-2xl border border-red-50 shadow-sm hover:shadow-md hover:border-red-100 transition-all group">
                <div class="flex justify-between items-center mb-4">
                    <h4 class="text-text-muted font-medium text-sm">Active Requests</h4>
                    <div class="p-2 bg-red-50 rounded-lg group-hover:bg-primary-red transition-all">
                        <svg class="w-5 h-5 text-primary-red group-hover:text-white transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                </div>
                <p class="text-5xl font-black text-primary-red leading-none">0</p>
                <p class="text-xs text-text-muted mt-4 opacity-70 italic">No urgent needs</p>
            </div>

            <!-- Donors Metric -->
            <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-all group">
                <div class="flex justify-between items-center mb-4">
                     <h4 class="text-text-muted font-medium text-sm">Total Donors Reached</h4>
                     <div class="p-2 bg-gray-50 rounded-lg group-hover:bg-gray-800 transition-all">
                        <svg class="w-5 h-5 text-gray-500 group-hover:text-white transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                     </div>
                </div>
                <p class="text-5xl font-black text-gray-800 leading-none">--</p>
                <p class="text-xs text-primary-red mt-4 font-bold flex items-center gap-1 group-hover:underline">Start requesting <span class="text-lg">↗</span></p>
            </div>

            <!-- System Status Metric -->
            <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-all">
                <div class="flex justify-between items-center mb-4">
                    <h4 class="text-text-muted font-medium text-sm">System Status</h4>
                    <div class="p-2 bg-teal-50 rounded-lg">
                        <svg class="w-5 h-5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                </div>
                <p class="text-xl font-bold text-teal-600 leading-tight">Connected to<br>Network</p>
                <div class="mt-4 w-full bg-gray-100 h-2 rounded-full overflow-hidden">
                    <div class="bg-teal-500 h-full w-full"></div>
                </div>
            </div>
        </div>
        
        <div class="flex flex-wrap gap-4 pt-10 border-t border-gray-50">
            <a href="#" class="btn-primary-custom px-8 py-4 text-base font-bold flex items-center gap-2 hover:scale-105 transition-transform">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Create Urgent Request
            </a>
            <a href="#" class="px-8 py-4 border-2 border-gray-200 text-gray-700 bg-white rounded-xl font-bold hover:bg-gray-50 hover:border-gray-300 transition-all flex items-center gap-2">
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                View Inventory
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
