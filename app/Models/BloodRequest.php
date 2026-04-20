<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BloodRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'hospital_id',
        'blood_type',
        'quantity',
        'urgency',
        'status',
    ];

    public function hospitalProfile()
    {
        return $this->belongsTo(HospitalProfile::class, 'hospital_id');
    }

    public function responses()
    {
        return $this->hasMany(Response::class);
    }
}
