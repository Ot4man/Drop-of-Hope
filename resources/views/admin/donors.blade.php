@extends('layouts.app')

@section('title', 'Manage Donors')

@section('content')
<div class="max-w-6xl mx-auto py-12 px-4">
    <h1 class="text-3xl font-bold mb-8">Donor Management</h1>
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50 border-b border-gray-100">
                <tr>
                    <th class="px-8 py-4 font-bold text-gray-900">Name</th>
                    <th class="px-8 py-4 font-bold text-gray-900">Email</th>
                    <th class="px-8 py-4 font-bold text-gray-900">Joined Date</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($donors as $donor)
                <tr>
                    <td class="px-8 py-6 font-bold text-gray-800">{{ $donor->first_name }} {{ $donor->last_name }}</td>
                    <td class="px-8 py-6 text-gray-500">{{ $donor->email }}</td>
                    <td class="px-8 py-6 text-gray-400 text-sm">{{ $donor->created_at->format('M d, Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
