<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

         $this->call(TemplateSeeder::class);
         User::create([
            'name' => 'Admin',
            'email' => 'rahman@gmail.com',
            'password' => Hash::make('12345678'),
            'is_premium' => true
        ]);

        User::create([
    'name' => 'Premium User',
    'email' => 'premium@gmail.com',
    'password' => Hash::make('12345678'),
    'is_premium' => true,
]);

User::create([
    'name' => 'User A',
    'email' => 'usera@gmail.com',
    'password' => Hash::make('12345678'),
    'is_premium' => false,
]);

User::create([
    'name' => 'User B',
    'email' => 'userb@gmail.com',
    'password' => Hash::make('12345678'),
    'is_premium' => false,
]);
    }
}
