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
