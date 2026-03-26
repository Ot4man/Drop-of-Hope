@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<section class="min-h-[80vh] py-16 px-[10%] bg-off-white">
    <div class="bg-white p-10 md:p-16 rounded- premium shadow-premium border border-red-50 max-w-5xl mx-auto">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-12 gap-6">
            <div>
                <h2 class="text-4xl font-extrabold text-text-dark tracking-tight leading-none mb-3">Welcome, <span class="text-primary-red">Hero!</span></h2>
                <p class="text-text-muted text-lg">Thank you for your life-saving commitment.</p>
            </div>
            <div class="bg-red-50 px-6 py-3 rounded-full flex items-center gap-3">
                <span class="w-3 h-3 bg-primary-red rounded-full animate-pulse"></span>
                <span class="text-primary-red font-bold text-sm uppercase tracking-wider">Active Donor</span>
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
            <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-all">
                <h4 class="text-text-muted font-medium text-sm mb-4">Total Donations</h4>
                <p class="text-5xl font-black text-primary-red leading-none">0</p>
                <p class="text-xs text-text-muted mt-4 opacity-70 italic">*Last donation: Never</p>
            </div>
            <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-all">
                <h4 class="text-text-muted font-medium text-sm mb-4">Blood Type</h4>
                <p class="text-5xl font-black text-gray-800 leading-none">--</p>
                <p class="text-xs text-primary-red mt-4 font-bold flex items-center gap-1">Update pending <span class="text-lg">↗</span></p>
            </div>
            <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-all">
                <h4 class="text-text-muted font-medium text-sm mb-4">Eligibility Status</h4>
                <p class="text-xl font-bold text-teal-600 leading-tight">Ready to<br>Save Lives</p>
                <div class="mt-4 w-full bg-gray-100 h-2 rounded-full overflow-hidden">
                    <div class="bg-teal-500 h-full w-full"></div>
                </div>
            </div>
        </div>
        
        <div class="flex flex-wrap gap-4 pt-10 border-t border-gray-50">
            <a href="#" class="btn-primary-custom px-8 py-4 text-base font-bold">Find Blood Bank</a>
            <a href="#" class="px-8 py-4 border-2 border-primary-red text-primary-red rounded-premium font-bold hover:bg-red-50 transition-all">Update Profile</a>
            <form action="{{ route('logout') }}" method="POST" class="ml-auto">
                @csrf
                <button type="submit" class="px-8 py-4 bg-gray-100 text-gray-600 rounded-premium font-bold hover:bg-gray-200 transition-all">Logout</button>
            </form>
        </div>
    </div>
</section>
@endsection
