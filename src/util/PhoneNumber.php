<?php
declare(strict_types=1);

namespace adityasetiono\util;

function validate_phone_number(string $number, ?string $countryCode = '0'): ?string
{
    if (!preg_match("/(^\\${countryCode})|(^\d)/", $number)) {
        return null;
    }
    $realNumber = preg_replace('/([^\d\+])|(?<=\d)(\+)/', '', $number);
    $realNumber = preg_replace("/(^\\${countryCode}0|^\\${countryCode}|^0)/", '',
        $realNumber);
    if (!preg_match('/^\d{9}$/', $realNumber)) {
        return null;
    }
    if (!empty($countryCode)) {
        $realNumber = $countryCode.$realNumber;
    }

    return $realNumber;
}

function obfuscate_phone_number(string $number): string
{
    $obfuscatedNumber = substr($number, -3);
    $countryCode = substr($number, 0, 3);

    return "${countryCode} XXX XXX ${obfuscatedNumber}";
}