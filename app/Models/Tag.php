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
}
