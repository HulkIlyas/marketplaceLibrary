<?php

function __($key)
{
    global $translations;

    $keys = explode('.', $key);
    $value = $translations;

    foreach ($keys as $k) {
        if (!is_array($value) || !array_key_exists($k, $value)) {
            return $key; // return the key if translation is missing
        }

        $value = $value[$k];
    }

    return $value;
}