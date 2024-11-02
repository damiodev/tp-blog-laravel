<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostsSeeder extends Seeder
{
    public function run()
    {
        $nbrTags = 6; // Nombre total d'étiquettes
        $nbrCategories = 3; // Nombre total de catégories

        // Supprimer toutes les entrées existantes
        DB::table('posts')->delete();
        DB::table('category_post')->delete(); // Optionnel : si vous souhaitez supprimer aussi les associations

        Post::withoutEvents(function () {
            // Crée 9 articles pour les deux rédacteurs
            foreach (range(1, 2) as $i) {
                Post::factory()->create([
                    'title' => 'Post ' . $i,
                    'slug' => 'post-' . uniqid(), // Générer un slug unique
                    'seo_title' => 'Post ' . $i,
                    'user_id' => 2,
                    'image' => 'img0' . $i . '.jpg',
                ]);
            }

            foreach (range(3, 9) as $i) {
                Post::factory()->create([
                    'title' => 'Post ' . $i,
                    'slug' => 'post-' . uniqid(), // Générer un slug unique
                    'seo_title' => 'Post ' . $i,
                    'user_id' => 3,
                    'image' => 'img0' . $i . '.jpg',
                ]);
            }
        });

        // Attachement des étiquettes aux articles
        $posts = Post::all();
        foreach ($posts as $post) {
            if ($post->id === 9) {
                $numbers = [1, 2, 5, 6];
                $n = 4;
            } else {
                $numbers = range(1, $nbrTags);
                shuffle($numbers);
                $n = rand(2, 4);
            }
            for ($i = 0; $i < $n; ++$i) {
                $post->tags()->attach($numbers[$i]);
            }
        }

        // Attachement des catégories aux articles
        foreach ($posts as $post) {
            if ($post->id === 9) {
                DB::table('category_post')->insert([
                    'category_id' => 1,
                    'post_id' => 9,
                ]);
            } else {
                $numbers = range(1, $nbrCategories);
                shuffle($numbers);
                $n = rand(1, 2);
                for ($i = 0; $i < $n; ++$i) {
                    DB::table('category_post')->insert([
                        'category_id' => $numbers[$i],
                        'post_id' => $post->id,
                    ]);
                }
            }
        }
    }
}
