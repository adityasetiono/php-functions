<?php
declare(strict_types=1);

namespace adityasetiono\util;

function check_params(array $required, ?array $params): bool
{
    return is_array($params) ? empty(array_diff($required, array_keys($params))) : false;
}

function filter_params(array $options, array $params)
{
    return array_intersect_key($params, array_flip($options));
}

function pluck(array $array, string $field): array
{
    $output = [];
    foreach ($array as $v) {
        if (is_object($v)) {
            $getter = 'get'.ucwords($field);
            if (method_exists($v, $getter)) {
                $output[] = $v->$getter();
            }
        } elseif (is_array($v)) {
            if (isset($v[$field])) {
                $output[] = $v[$field];
            }
        }
    }

    return $output;
}