<?php

/**
 * Fonction permettant de récupérer une image
 */
if (!function_exists('getImage')) {
    function getImage($post, $thumb = false)
    {
        $url = "storage/photos/{$post->user->id}";
        if($thumb) $url .= '/thumbs';
        return asset("{$url}/{$post->image}");
    }
}