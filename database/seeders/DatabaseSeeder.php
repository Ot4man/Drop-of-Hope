<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin
        User::updateOrCreate(
            ['username' => 'admin'],
            [
                'first_name' => 'Admin',
                'last_name' => 'System',
                'email' => 'admin@hope.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'dob' => '1990-01-01',
            ]
        );

        // Donor
        $donorUser = User::updateOrCreate(
            ['username' => 'donor'],
            [
                'first_name' => 'John',
                'last_name' => 'Donor',
                'email' => 'donor@test.com',
                'password' => Hash::make('password'),
                'role' => 'donor',
                'dob' => '1995-05-05',
            ]
        );
        $donorUser->donorProfile()->updateOrCreate(
            ['user_id' => $donorUser->id],
            [
                'blood_type' => 'O+',
                'phone' => '0612345678',
                'city' => 'Casablanca',
                'available' => true,
            ]
        );

        // Hospital
        $hospitalUser = User::updateOrCreate(
            ['username' => 'hospital'],
            [
                'first_name' => 'Hospital',
                'last_name' => 'Admin',
                'email' => 'hospital@test.com',
                'password' => Hash::make('password'),
                'role' => 'hospital',
                'dob' => '1980-01-01',
            ]
        );
        $hospitalUser->hospitalProfile()->updateOrCreate(
            ['user_id' => $hospitalUser->id],
            [
                'hospital_name' => 'City Hospital',
                'license_number' => 'LIC-789',
                'contact_phone' => '0522334455',
                'city' => 'Casablanca',
                'address' => '123 Health St',
                'is_verified' => true,
            ]
        );

        // Unverified Hospital
        $unverifiedHospital = User::updateOrCreate(
            ['username' => 'unverified'],
            [
                'first_name' => 'Unverified',
                'last_name' => 'Hospital',
                'email' => 'unverified@test.com',
                'password' => Hash::make('password'),
                'role' => 'hospital',
                'dob' => '1985-01-01',
            ]
        );
        $unverifiedHospital->hospitalProfile()->updateOrCreate(
            ['user_id' => $unverifiedHospital->id],
            [
                'hospital_name' => 'Waiting for Verification Clinic',
                'license_number' => 'LIC-404',
                'contact_phone' => '0600000000',
                'city' => 'Marrakech',
                'address' => '404 Street',
                'is_verified' => false,
            ]
        );
    }
}
