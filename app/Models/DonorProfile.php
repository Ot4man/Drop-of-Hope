<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class DonorProfile extends Model
{
    protected $fillable = [
        'user_id',
        'blood_type',
        'phone',
        'city',
        'available',
        'last_donation_date',
        'is_eligible',
    ];

    protected $casts = [
        'available' => 'boolean',
        'is_eligible' => 'boolean',
        'last_donation_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getAgeAttribute()
    {
        if ($this->user && $this->user->dob) {
            return Carbon::parse($this->user->dob)->age;
        }
        return 0;
    }

    /**
     * Re-evaluate donor eligibility dynamically based on specific conditions.
     */
    public function evaluateEligibility()
    {
        $age = $this->age;
        $isAgeValid = ($age >= 18 && $age <= 65);
        
        $hasValidBloodType = in_array($this->blood_type, ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-']);
        $isAvailable = $this->available;
        
        // Wait at least 3 months since last donation
        $isDonationDelayRespected = true;
        if ($this->last_donation_date) {
            $isDonationDelayRespected = $this->last_donation_date->diffInMonths(Carbon::now()) >= 3;
        }

        $eligible = ($isAgeValid && $hasValidBloodType && $isAvailable && $isDonationDelayRespected);

        if ($this->is_eligible !== $eligible) {
            $this->update(['is_eligible' => $eligible]);
        }

        return $eligible;
    }
}
