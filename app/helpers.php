<?php

use Illuminate\Support\Facades\Route;

/**
 * Permet de récupérer une image
 */
if (!function_exists('getImage')) {
    function getImage($post, $thumb = false)
    {
        $url = "storage/photos/{$post->user->id}";
        if($thumb) $url .= '/thumbs';
        return asset("{$url}/{$post->image}");
    }
}

/**
 * Permet de récupérer la route active
 */
if (!function_exists('currentRoute')) {
  function currentRoute($route)
  {
      return Route::currentRouteNamed($route) ? ' class=current' : '';
  }
}