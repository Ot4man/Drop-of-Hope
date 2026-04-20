<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'response_id',
        'donor_id',
        'hospital_id',
        'scheduled_at',
        'status',
        'notes',
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
    ];

    public function response()
    {
        return $this->belongsTo(Response::class);
    }

    public function hospitalProfile()
    {
        return $this->belongsTo(HospitalProfile::class, 'hospital_id');
    }

    public function donorProfile()
    {
        return $this->belongsTo(DonorProfile::class, 'donor_id');
    }
}
