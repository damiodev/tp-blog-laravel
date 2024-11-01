<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration {

    public function up()
    {
        Schema::create('comments', function(Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('body');  // Corps du commentaire
            $table->nestedSet();   // Pour les réponses imbriquées
            // Clés étrangères pour les utilisateurs
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade')
                ->onUpdate('cascade');
            // Clé étrangère pour les articles
            $table->foreignId('post_id')
                ->constrained()
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('comments');
    }
}