<?php
if (!function_exists('shortenString')) {
    function shortenString(string|null $string2Shorten, int $maxLength, string $suffix = '...'): string|null
    {
        // Check to see if the string is not null or empty
        if (isNullOrEmptyString($string2Shorten) === false) {
            // Check if the string is longer than the max length and truncate it if necessary
            return mb_strlen($string2Shorten) > $maxLength ? mb_substr($string2Shorten, 0, $maxLength) . $suffix : $string2Shorten;
        } else {
            // Do NOTHING, just let it play.
            return "";
        }
    }
}

if (!function_exists('isNullOrEmptyString')) {
    function isNullOrEmptyString(string|null $string2Check)
    {
        // Check if the string is null or empty and return either TRUE or FALSE
        return $string2Check === null || trim($string2Check) === '';
    }
}
