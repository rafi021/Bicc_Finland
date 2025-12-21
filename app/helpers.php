<?php

if (!function_exists('image')) {
    /**
     * Global helper to get image URL with fallbacks.
     */
    function image($path, $default = null, $dimensions = '400x300', $text = 'No Image')
    {
        return \App\Helpers\ImageHelper::get($path, $default, $dimensions, $text);
    }
}
