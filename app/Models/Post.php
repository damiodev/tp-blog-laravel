<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Post extends Model
{
    use HasFactory, Notifiable; // Rajout du trait Notifiable

    /**
     * Les attributs qui sont assignables.
     */
    protected $fillable = [
        'title',
        'slug',
        'seo_title',
        'excerpt',
        'body',
        'meta_description',
        'meta_keywords',
        'active',
        'image',
        'user_id',
    ];

    /**
     * Récupère l'utilisateur qui a écrit l'article.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Les catégories de l'article.
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * Les tags de l'article.
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * Les commentaires de l'article.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Les commentaires validés de l'article.
     */
    public function validComments()
    {
        return $this->comments()->whereHas('user', function ($query) {
            $query->whereValid(true);
        });
    }
}
