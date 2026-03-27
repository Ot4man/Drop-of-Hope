<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileUser extends Model
{
    use HasFactory;

    protected $table = 'profiles';

    protected $fillable = [
        'user_id', 'blood_type', 'phone', 'city', 'available', 'last_donation_date'
    ];

    // Relation back to user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
