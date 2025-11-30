<?php

use App\Models\Ads;

if (!function_exists('youtube_id')) {
    function youtube_id($url)
    {
        $pattern = '/(?:youtu\.be\/|youtube\.com\/(?:embed\/|watch\?v=|v\/|.*[?&]v=))([A-Za-z0-9_-]{11})/';

        if (preg_match($pattern, $url, $matches)) {
            return $matches[1];
        }
        return null;
    }
}

if (!function_exists('getAd')) {

    function getAd($position)
    {
        return Ads::where('position', $position)
            ->where('status', 'active')
            ->first();
    }
}

if (!function_exists('firstImage')) {

    function firstImage($jsonImages)
    {
        $images = $jsonImages ? json_decode($jsonImages, true) : [];
        return $images[0] ?? null;
    }
}
