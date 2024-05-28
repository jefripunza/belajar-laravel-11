<?php

namespace Database\Seeders;

use App\Models\Post;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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

        if (app()->environment('local')) {
            Post::factory(99)->recycle(User::factory(9)->create())->create();
            $this->command->info('Additional data created in local environment.');
        }

        // -------------------------------------------------------------------------------------------------- //
        // -------------------------------------------------------------------------------------------------- //
    }
}
