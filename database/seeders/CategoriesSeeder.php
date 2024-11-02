<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    public function run()
    {
        // Désactiver les contraintes de clé étrangère
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Vider la table des catégories
        DB::table('categories')->truncate();

        // Réactiver les contraintes de clé étrangère
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Insérer les catégories
        DB::table('categories')->insert([
            ['title' => 'Category 1', 'slug' => 'category-1'],
            ['title' => 'Category 2', 'slug' => 'category-2'],
            ['title' => 'Category 3', 'slug' => 'category-3'],
        ]);
    }
}
