<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Only return true if the user is logged in (handled by middleware but safe to keep)
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'blood_type' => 'required|string|in:A+,A-,B+,B-,O+,O-,AB+,AB-',
            'phone' => 'required|string|max:15',
            'city' => 'nullable|string|max:255',
            'available' => 'nullable|boolean',
            'last_donation_date' => 'nullable|date|before_or_equal:today',
        ];
    }
}
