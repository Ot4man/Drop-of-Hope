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
        return true;
    }

   
    public function rules(): array
    {
        $user = $this->user();

        if ($user && $user->role === 'hospital') {
            return [
                'contact_phone' => 'required|string|max:20',
                'city' => 'required|string|max:255',
                'address' => 'required|string|max:255',
            ];
        }

        return [
            'blood_type' => 'required|string|in:A+,A-,B+,B-,O+,O-,AB+,AB-',
            'phone' => 'required|string|max:20',
            'city' => 'required|string|max:255',
            'available' => 'nullable|boolean',
            'last_donation_date' => 'nullable|date|before_or_equal:today',
        ];
    }
}
