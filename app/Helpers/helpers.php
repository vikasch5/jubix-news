<?php
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
