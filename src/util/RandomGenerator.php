<?php
declare(strict_types=1);

namespace adityasetiono\util;

function generate_alphanumeric(int $length): string
{
    $characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $pool = str_repeat($characters, $length);

    return substr(str_shuffle($pool), 0, $length);
}

function generate_number(int $length): string
{
    $characters = "0123456789";
    $pool = str_repeat($characters, $length);

    return substr(str_shuffle($pool), 0, $length);
}

function generate_string(int $length): string
{
    $characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYYZ~!@#$%^&*()_+-=";
    $pool = str_repeat($characters, $length);

    return substr(str_shuffle($pool), 0, $length);
}

function generate_uuid(): string
{
    return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        mt_rand(0, 0xffff), mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0x0fff) | 0x4000,
        mt_rand(0, 0x3fff) | 0x8000,
        mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
    );
}

