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
        // User::factory(10)->create();

        // -------------------------------------------------------------------------------------------------- //
        // -------------------------------------------------------------------------------------------------- //

        $userExist = User::where('email', 'admin@example.com')->where('is_admin', true)->exists();
        if (!$userExist) {
            User::factory()->create([
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('v3ry_secret'), // default admin password
                'is_admin' => true,
            ]);
            $this->command->info('Admin user created successfully.');
        } else {
            $this->command->info('Admin user already exists.');
        }

        $userExist = User::where('email', 'jefri@example.com')->where('is_admin', false)->exists();
        $jefri_id = 0;
        if (!$userExist) {
            $user = User::factory()->create([ // id user
                'name' => 'Jefri Herdi Triyanto',
                'email' => 'jefri@example.com',
                'password' => Hash::make('akulupa'),
                'is_admin' => false,
            ]);
            $jefri_id = $user->id;
            $this->command->info('User jefri created successfully with ID: ' . $jefri_id);
        } else {
            $this->command->info('User jefri already exists.');
        }

        $userExist = User::where('email', 'watini@example.com')->where('is_admin', false)->exists();
        $watini_id = 0;
        if (!$userExist) {
            $user = User::factory()->create([ // id user
                'name' => 'Watini',
                'email' => 'watini@example.com',
                'password' => Hash::make('akujuga'),
                'is_admin' => false,
            ]);
            $watini_id = $user->id;
            $this->command->info('User watini created successfully with ID: ' . $watini_id);
        } else {
            $this->command->info('User watini already exists.');
        }

        // -------------------------------------------------------------------------------------------------- //
        // -------------------------------------------------------------------------------------------------- //

        $postExist = Post::where('slug', 'belajar-laravel-dengan-cepat')->exists();
        if (!$postExist) {
            Post::create([
                "slug" => "belajar-laravel-dengan-cepat",
                "title" => "Belajar Laravel dengan Cepat?",
                "body" => "saya sedang mencoba untuk belajar laravel secepat mungkin agar bisa menembus batas 7.5 JT, demi anak bojo bree",
                "author_id" => $jefri_id,
            ]);
            $this->command->info('Post belajar-laravel-dengan-cepat created successfully.');
        } else {
            $this->command->info('Post belajar-laravel-dengan-cepat already exists.');
        }

        $postExist = Post::where('slug', 'mampukah-menerima-cobaan-ini')->exists();
        if (!$postExist) {
            Post::create([
                "slug" => "mampukah-menerima-cobaan-ini",
                "title" => "Mampukah Menerima Cobaan Ini?",
                "body" => "ketika saya niat ingsun, insya allah barokah lancar. Amiinnn...",
                "author_id" => $watini_id,
            ]);
            $this->command->info('Post mampukah-menerima-cobaan-ini created successfully.');
        } else {
            $this->command->info('Post mampukah-menerima-cobaan-ini already exists.');
        }
    }
}
