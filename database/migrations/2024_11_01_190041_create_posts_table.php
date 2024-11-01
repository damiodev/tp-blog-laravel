<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('title');                    // Titre de l'article
            $table->string('slug')->unique();           // Texte qui va apparaître dans l'URL (qui ne doit comporter que des caractères autorisés)
            $table->string('seo_title')->nullable();    // Titre pour le SEO
            $table->text('excerpt');                    // Texte d'introduction (Résumé sur la page d'accueil)
            $table->text('body');                       // Corps de l'article
            $table->text('meta_description');           // La description pour le SEO
            $table->text('meta_keywords');              // Les mots-clés pour le SEO
            $table->boolean('active')->default(false);  // Article publié ou non
            $table->string('image')->nullable();        // Nom de l'image réduite (miniature pour la page d'accueil)

            // Clé étrangère
            $table->foreignId('user_id')
                ->constrained()         // Clé étrangère (user_id) qui fait référence à l'ID de la table users
                ->onDelete('cascade')   // Suppression en cascade (si l'utilisateur est supprimé, ses articles le sont aussi)
                ->onUpdate('cascade');  // Mise à jour en cascade (si l'ID de l'utilisateur est modifié, les articles le sont aussi)
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
