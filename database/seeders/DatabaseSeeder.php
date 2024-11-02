<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Appel des seeders pour peupler la base de données
        $this->call([
            UsersSeeder::class,
            CategoriesSeeder::class,
            TagsSeeder::class,
            PostsSeeder::class,
            CommentsSeeder::class,
        ]);
    }
}
