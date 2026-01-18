<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class OrganizationSeeder extends Seeder
{
    public function run(): void
    {
        // 1. System Organization (The Provider)
        $systemOrg = Organization::create([
            'name' => 'Connek System',
            'slug' => 'connek',
            'primary_color' => '#4A70A9',
        ]);

        User::create([
            'name' => 'Admin User',
            'email' => 'admin@connek.com',
            'password' => Hash::make('password'),
            'organization_id' => $systemOrg->id,
            'role' => 'super_admin',
            'email_verified_at' => now(),
        ]);

        // 2. Client Organization (Wallmart)
        $wallmartOrg = Organization::create([
            'name' => 'Wallmart Optical',
            'slug' => 'wallmart',
            'primary_color' => '#0071CE', // Wallmart Blue
        ]);

        User::create([
            'name' => 'Evelyn User',
            'email' => 'evelyn@admin.com',
            'password' => Hash::make('password'),
            'organization_id' => $wallmartOrg->id,
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        // 3. Demo Data for Wallmart (Optional: Add some employees)
        User::create([
            'name' => 'Dr. Smith',
            'email' => 'smith@wallmart.com',
            'password' => Hash::make('password'),
            'organization_id' => $wallmartOrg->id,
            'role' => 'doctor',
            'email_verified_at' => now(),
        ]);
    }
}
