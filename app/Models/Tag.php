<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /**
     * Les attributs qui sont assignables.
     */
    protected $fillable = [
        'tag'
    ];

    public $timestamps = false;

    /**
     * Les articles du tag.
     */
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
