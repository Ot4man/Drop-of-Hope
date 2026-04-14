<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBloodRequestRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'blood_type' => 'required|string|in:A+,A-,B+,B-,O+,O-,AB+,AB-',
            'quantity'   => 'required|integer|min:1',
            'urgency'    => 'required|string|in:low,medium,high,critical',
            'location'   => 'required|string|max:255',
            'status'     => 'nullable|string|in:open,closed,cancelled',
        ];
    }
}
