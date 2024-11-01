<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * Les attributs qui sont assignables.
     */
    protected $fillable = [
        'title', 
        'slug',
    ];

    public $timestamps = false;
}
