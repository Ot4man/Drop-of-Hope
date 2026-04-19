<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonorProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'blood_type',
        'city',
        'phone',
        'last_donation_date',
        'is_eligible',
        'available',
    ];

    protected $casts = [
        'last_donation_date' => 'date',
        'is_eligible' => 'boolean',
        'available' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function responses()
    {
        return $this->hasMany(Response::class);
    }

    /**
     * Check if the donor is eligible to donate based on last donation date.
     * Blood donation rule: 56 days between donations.
     */
    public function evaluateEligibility()
    {
        if (!$this->last_donation_date) {
            return true;
        }

        return $this->last_donation_date->diffInDays(now()) >= 56;
    }
}
