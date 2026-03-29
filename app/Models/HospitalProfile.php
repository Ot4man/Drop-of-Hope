<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HospitalProfile extends Model
{
    protected $fillable = [
        'user_id',
        'hospital_name',
        'license_number',
        'contact_phone',
        'address',
        'city',
        'is_verified',
    ];

    protected $casts = [
        'is_verified' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
