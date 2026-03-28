<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'email',
        'dob',
        'zip_code',
        'password',
        'donor_id',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function donorProfile()
    {
        return $this->hasOne(DonorProfile::class);
    }

    public function hospitalProfile()
    {
        return $this->hasOne(HospitalProfile::class);
    }

    // Role Helper Methods
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isHospital(): bool
    {
        return $this->role === 'hospital';
    }

    public function isDonor(): bool
    {
        return $this->role === 'donor';
    }
}
