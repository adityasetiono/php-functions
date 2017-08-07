<?php
declare(strict_types=1);

namespace adityasetiono\util;

function check_params(array $required, array $params): bool
{
    return empty(array_diff($required, array_keys($params)));
}
