@extends('layouts.app')

@section('title', 'Eligibility Check')

@section('content')
<section class="min-h-[90vh] py-20 px-6 flex justify-center items-center bg-off-white">
    <div class="form-card-custom max-w-xl">
        <div class="text-center mb-10">
            <h2 class="text-3xl md:text-4xl font-serif font-bold text-primary-red mb-3">Eligibility Check</h2>
            <p class="text-text-muted text-sm md:text-base leading-relaxed">Ensure you are eligible to donate before registering.</p>
        </div>

        <form id="eligibility-form" class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label for="age" class="block font-semibold text-text-dark text-sm">What is your Age? (years)</label>
                    <input type="number" id="age" name="age" placeholder="e.g. 18" required
                           class="w-full px-4 py-3 rounded-lg border border-gray-200 outline-none focus:border-primary-red transition-colors duration-300">
                </div>
                <div class="space-y-2">
                    <label for="weight" class="block font-semibold text-text-dark text-sm">What is your Weight? (kg)</label>
                    <input type="number" id="weight" name="weight" placeholder="e.g. 65" required
                           class="w-full px-4 py-3 rounded-lg border border-gray-200 outline-none focus:border-primary-red transition-colors duration-300">
                </div>
            </div>

            <div class="space-y-2">
                <label for="health" class="block font-semibold text-text-dark text-sm">Do you have any major health conditions (Cancer, Heart Disease, HIV, Hepatitis)?</label>
                <select id="health" name="health" required
                        class="w-full px-4 py-3 rounded-lg border border-gray-200 outline-none focus:border-primary-red transition-colors duration-300 bg-white">
                    <option value="" disabled selected>Select an option</option>
                    <option value="no">No</option>
                    <option value="yes">Yes</option>
                </select>
            </div>

            <div class="space-y-2">
                <label for="surgery" class="block font-semibold text-text-dark text-sm">Have you had any major surgery in the last 6 months?</label>
                <select id="surgery" name="surgery" required
                        class="w-full px-4 py-3 rounded-lg border border-gray-200 outline-none focus:border-primary-red transition-colors duration-300 bg-white">
                    <option value="" disabled selected>Select an option</option>
                    <option value="no">No</option>
                    <option value="yes">Yes</option>
                </select>
            </div>

            <button type="submit" class="w-full btn-primary-custom py-4 text-xl font-bold mt-4">Check Eligibility</button>
        </form>
    </div>
</section>
@endsection

@push('scripts')
<script src="{{ asset('js/app.js') }}"></script>
@endpush
