@extends('layouts.app')

@section('title', 'Manage Hospitals')

@section('content')
<div class="max-w-6xl mx-auto py-12 px-4">
    <h1 class="text-3xl font-bold mb-8">Hospital Management</h1>
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50 border-b border-gray-100">
                <tr>
                    <th class="px-8 py-4 font-bold text-gray-900">Hospital Name</th>
                    <th class="px-8 py-4 font-bold text-gray-900">City</th>
                    <th class="px-8 py-4 font-bold text-gray-900">Status</th>
                    <th class="px-8 py-4 font-bold text-gray-900">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($hospitals as $hospital)
                <tr>
                    <td class="px-8 py-6 font-bold text-gray-800">{{ $hospital->hospitalProfile->hospital_name ?? 'Unnamed' }}</td>
                    <td class="px-8 py-6 text-gray-500">{{ $hospital->hospitalProfile->city ?? 'N/A' }}</td>
                    <td class="px-8 py-6">
                        @if($hospital->hospitalProfile && $hospital->hospitalProfile->is_verified)
                            <span class="text-green-600 bg-green-50 px-3 py-1 rounded-full text-xs font-black">VERIFIED</span>
                        @else
                            <span class="text-red-600 bg-red-50 px-3 py-1 rounded-full text-xs font-black">NOT VERIFIED</span>
                        @endif
                    </td>
                    <td class="px-8 py-6">
                        @if($hospital->hospitalProfile && !$hospital->hospitalProfile->is_verified)
                            <form action="{{ route('admin.hospitals.verify', $hospital->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" style="background-color: #10b981;" class="text-white px-4 py-2 rounded-lg text-xs font-bold hover:opacity-90 transition shadow-sm">
                                    Verify Now
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
