<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Slot;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed users
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('0000000000')
        ]);

        User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('0000000000'),
        ]);

        // Seed a slot
        Slot::create([
            'number' => 0,
        ]);
    }
}
