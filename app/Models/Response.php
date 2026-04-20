<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    use HasFactory;

    protected $fillable = [
        'blood_request_id',
        'donor_id',
        'status',
    ];

    public function bloodRequest()
    {
        return $this->belongsTo(BloodRequest::class);
    }

    public function donorProfile()
    {
        return $this->belongsTo(DonorProfile::class, 'donor_id');
    }

    public function appointment()
    {
        return $this->hasOne(Appointment::class);
    }
}
