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

    
    public function donor()
    {
        return $this->belongsTo(User::class, 'donor_id');
    }
}
