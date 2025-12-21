<?php

namespace App\Helpers;

class ImageHelper
{
    /**
     * Get image URL with fallback to default and placeholder.
     * 
     * @param string|null $path The relative path to the image
     * @param string|null $default Local fallback path
     * @param string $dimensions Placeholder dimensions if everything fails
     * @param string|null $text Placeholder text
     * @return string
     */
    public static function get($path, $default = null, $dimensions = '400x300', $text = 'No Image')
    {
        // 1. Try the actual path from DB
        if ($path && file_exists(public_path($path))) {
            return asset($path);
        }

        // 2. Try the local default path provided in the view
        if ($default && file_exists(public_path($default))) {
            return asset($default);
        }

        // 3. Ultimate Fallback: Placeholder service
        $encodedText = urlencode($text);
        return "https://placehold.co/{$dimensions}?text={$encodedText}";
    }
}
