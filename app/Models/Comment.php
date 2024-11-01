<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Kalnoy\Nestedset\NodeTrait;

class Comment extends Model
{
    // On utilise le trait NodeTrait pour gérer les commentaires imbriqués
    // On utilise également HasFactory pour générer des commentaires de test
    // On utilise Notifiable pour envoyer des notifications
    use NodeTrait, HasFactory, Notifiable;

    /**
     * Les attributs qui sont assignables en masse.
     */
    protected $fillable = [
        'body',
        'post_id',
        'user_id',
    ];

    /**
     * Récupère l'utilisateur qui a écrit le commentaire.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Récupère l'article auquel le commentaire appartient.
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
