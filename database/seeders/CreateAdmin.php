<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreateAdmin extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userExist = User::where('email', 'admin@example.com')->where('is_admin', true)->exists();
        if (!$userExist) {
            User::factory()->create([
                'first_name' => 'Admin',
                'last_name' => "Uyee",
                'email' => 'admin@example.com',
                'password' => Hash::make('v3ry_secret'), // default admin password
                'is_admin' => true,
            ]);
            $this->command->info('Admin user created successfully.');
        } else {
            $this->command->info('Admin user already exists.');
        }
    }
}
