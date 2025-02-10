<?php
if (!function_exists('shortenString')) {
    function shortenString(string $string2Shorten, int $maxLength, string $suffix = '...'): string
    {
        return mb_strlen($string2Shorten) > $maxLength ? mb_substr($string2Shorten, 0, $maxLength) . $suffix : $string2Shorten;
    }
}
