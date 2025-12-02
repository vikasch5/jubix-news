<?php

use App\Models\Ads;
use App\Models\NewsView;
use App\Models\View;

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

if (!function_exists('recordView')) {
    function recordView($type, $item_id)
    {
        $ip = request()->ip();
        $agent = request()->header('User-Agent');

        $already = View::where('type', $type)
            ->where('item_id', $item_id)
            ->where('ip', $ip)
            ->where('created_at', '>=', now()->subDay()) // prevent duplicate views in 24h
            ->first();

        if (!$already) {
            View::create([
                'type'       => $type,
                'item_id'    => $item_id,
                'ip'         => $ip,
                'user_agent' => $agent,
            ]);
        } else {
            $already->touch();
        }
    }
}
