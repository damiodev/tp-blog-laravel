<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CommentsSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $nbrPosts = 9; // Nombre total d'articles
        $nbrUsers = 6; // Nombre total d'utilisateurs

        // Création des commentaires de premier niveau
        foreach (range(1, $nbrPosts - 1) as $i) {
            Comment::factory()->create([
                'post_id' => $i,
                'user_id' => rand(1, $nbrUsers),
                'body' => $faker->paragraph(4, true), // Ajout du champ body
            ]);
        }

        // Création des commentaires imbriqués
        Comment::create([
            'post_id' => 2,
            'user_id' => 3,
            'body' => $faker->paragraph(4, true),
            'children' => [
                [
                    'post_id' => 2,
                    'user_id' => 4,
                    'body' => $faker->paragraph(4, true),
                    'children' => [
                        [
                            'post_id' => 2,
                            'user_id' => 2,
                            'body' => $faker->paragraph(4, true),
                        ],
                    ],
                ],
            ],
        ]);

        Comment::create([
            'post_id' => 2,
            'user_id' => 6,
            'body' => $faker->paragraph(4, true),
            'children' => [
                [
                    'post_id' => 2,
                    'user_id' => 3,
                    'body' => $faker->paragraph(4, true),
                ],
                [
                    'post_id' => 2,
                    'user_id' => 6,
                    'body' => $faker->paragraph(4, true),
                    'children' => [
                        [
                            'post_id' => 2,
                            'user_id' => 3,
                            'body' => $faker->paragraph(4, true),
                            'children' => [
                                [
                                    'post_id' => 2,
                                    'user_id' => 6,
                                    'body' => $faker->paragraph(4, true),
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ]);

        Comment::create([
            'post_id' => 4,
            'user_id' => 4,
            'body' => $faker->paragraph(4, true),
            'children' => [
                [
                    'post_id' => 4,
                    'user_id' => 5,
                    'body' => $faker->paragraph(4, true),
                    'children' => [
                        [
                            'post_id' => 4,
                            'user_id' => 2,
                            'body' => $faker->paragraph(4, true),
                        ],
                        [
                            'post_id' => 4,
                            'user_id' => 1,
                            'body' => $faker->paragraph(4, true),
                        ],
                    ],
                ],
            ],
        ]);
    }
}
