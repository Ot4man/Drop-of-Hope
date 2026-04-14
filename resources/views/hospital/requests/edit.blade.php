@extends('layouts.app')

@section('title', 'Edit Blood Request')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="mb-8">
        <a href="{{ route('hospital.requests.index') }}" class="text-gray-500 hover:text-gray-700 flex items-center gap-2 mb-4">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7 7-7"></path></svg>
            Back to requests
        </a>
        <h1 class="text-3xl font-bold text-gray-900 font-serif">Edit Blood Request</h1>
        <p class="mt-2 text-sm text-gray-700">Update the details of your active blood request.</p>
    </div>

    <div class="bg-white shadow-xl rounded-2xl border border-gray-100 p-8">
        <form action="{{ route('hospital.requests.update', $request->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="space-y-6">
                {{-- Blood Type --}}
                <div>
                    <label for="blood_type" class="block text-sm font-semibold text-gray-700 mb-1">Blood Type Needed</label>
                    <select name="blood_type" id="blood_type" class="w-full rounded-xl border-gray-200 focus:border-primary-red focus:ring-primary-red shadow-sm" required>
                        @foreach(['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-'] as $type)
                            <option value="{{ $type }}" {{ old('blood_type', $request->blood_type) == $type ? 'selected' : '' }}>{{ $type }}</option>
                        @endforeach
                    </select>
                    @error('blood_type') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                {{-- Quantity --}}
                <div>
                    <label for="quantity" class="block text-sm font-semibold text-gray-700 mb-1">Quantity (Units)</label>
                    <input type="number" name="quantity" id="quantity" min="1" step="1" 
                           value="{{ old('quantity', $request->quantity) }}"
                           class="w-full rounded-xl border-gray-200 focus:border-primary-red focus:ring-primary-red shadow-sm"
                           required>
                    @error('quantity') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                {{-- Urgency --}}
                <div>
                    <label for="urgency" class="block text-sm font-semibold text-gray-700 mb-1">Urgency Level</label>
                    <select name="urgency" id="urgency" class="w-full rounded-xl border-gray-200 focus:border-primary-red focus:ring-primary-red shadow-sm" required>
                        <option value="low" {{ old('urgency', $request->urgency) == 'low' ? 'selected' : '' }}>Low (Routine Stock)</option>
                        <option value="medium" {{ old('urgency', $request->urgency) == 'medium' ? 'selected' : '' }}>Medium</option>
                        <option value="high" {{ old('urgency', $request->urgency) == 'high' ? 'selected' : '' }}>High (Needed Soon)</option>
                        <option value="critical" {{ old('urgency', $request->urgency) == 'critical' ? 'selected' : '' }}>Critical (Emergency)</option>
                    </select>
                    @error('urgency') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                {{-- Location --}}
                <div>
                    <label for="location" class="block text-sm font-semibold text-gray-700 mb-1">Location / Department</label>
                    <input type="text" name="location" id="location" 
                           value="{{ old('location', $request->location) }}"
                           class="w-full rounded-xl border-gray-200 focus:border-primary-red focus:ring-primary-red shadow-sm"
                           required>
                    @error('location') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                {{-- Status (Bonus functionality) --}}
                <div>
                    <label for="status" class="block text-sm font-semibold text-gray-700 mb-1">Request Status</label>
                    <select name="status" id="status" class="w-full rounded-xl border-gray-200 focus:border-primary-red focus:ring-primary-red shadow-sm">
                        <option value="open" {{ old('status', $request->status) == 'open' ? 'selected' : '' }}>Open (Accepting Responses)</option>
                        <option value="closed" {{ old('status', $request->status) == 'closed' ? 'selected' : '' }}>Closed</option>
                        <option value="cancelled" {{ old('status', $request->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>

                <div class="pt-6 border-t border-gray-50 flex gap-4">
                    <button type="submit" class="btn-primary-custom flex-1 justify-center py-4 bg-gray-900 hover:bg-black text-white font-bold rounded-xl shadow-lg transition-all active:scale-95">
                        Update Request
                    </button>
                    <a href="{{ route('hospital.requests.index') }}" class="flex-1 text-center py-4 border-2 border-gray-200 text-gray-700 bg-white rounded-xl font-bold hover:bg-gray-50 transition-all">
                        Cancel
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
