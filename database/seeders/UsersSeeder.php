<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $nbrUsers = 6;

        User::withoutEvents(function () {
            // Create 1 admin
            User::factory()->create([
                'role' => 'admin',
            ]);

            // Create 2 redactors
            User::factory()->count(2)->create([
                'role' => 'redac',
            ]);

            // Create 3 users
            User::factory()->count(3)->create();
        });
    }
}
