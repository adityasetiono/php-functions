<?php
declare(strict_types=1);

namespace adityasetiono\util;

function generate_alphanumeric(int $length): string
{
    $characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $pool = generate_pool($characters, $length);
    return substr(str_shuffle($pool), 0, $length);
}

function generate_number(int $length): string
{
    $characters = "0123456789";
    $pool = generate_pool($characters, $length);
    return substr(str_shuffle($pool), 0, $length);
}

function generate_string(int $length): string
{
    $characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYYZ~!@#$%^&*()_+-=";
    $pool = generate_pool($characters, $length);
    return substr(str_shuffle($pool), 0, $length);
}

function generate_pool(string $characters, int $length): string
{
    $pool = "";
    for ($i = $length - 1; $i >= 0; $i--) {
        $pool .= $characters;
    }
    return $pool;
}

