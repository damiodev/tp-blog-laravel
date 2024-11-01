<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Post extends Model
{
    use HasFactory, Notifiable; // Rajout du trait Notifiable

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
}
