<?php
declare(strict_types=1);

namespace adityasetiono\util;

function deserialize($object, $options = null)
{
    $arr = [];
    if (is_object($object)) {
        list($fields, $nestedOptions) = extractFields($object, $options);
        foreach ($fields as $field => $getter) { // loop through the field-getter key-value pair
            $attr = null;
            $n = empty($nestedOptions[$field]) ? null : $nestedOptions[$field]; // reset nestedOptions to null if empty
            $gs = $getter !== false ? explode('.', $getter) : false;
            if ($getter === false) {
                $attr = deserialize($object, $n);
            } elseif (method_exists($object, $getter)) {
                $attr = $object->{$getter}(); // call the getter method
                if (is_object($attr) || (is_array($attr) && isset($attr[0]) && is_object($attr[0]))) { // if the result is an object, value needs to be deserialized again
                    $attr = deserialize($attr, $n);
                }
            } elseif (count($gs) > 1) {
                $attr = $object;
                foreach ($gs as $g) {
                    if (method_exists($attr, $g)) {
                        $attr = $attr->{$g}();
                    }
                }
            }
            $arr[$field] = $attr;
        }
    } else {
        if (is_array($object)) {
            foreach ($object as $key => $value) {
                $arr[$key] = deserialize($value, $options);
            }
        }
    }

    return $arr;
}

function serialize($params, $className, $object = null)
{
    $object = is_null($object) ? new $className : $object;
    if (!is_array($params)) {
        return $object;
    }
    foreach ($params as $field => $value) {
        $setter = 'set'.ucwords($field);
        if (method_exists($object, $setter)) {
            $rp = (new \ReflectionMethod($className, $setter))->getParameters()[0];
            if (is_null($rp->getClass())) {
                $object->{$setter}($value);
            } elseif (is_object($value) && (get_class($value) === $rp->getClass()->name || get_class($value) === "Proxies\\__CG__\\".$rp->getClass()->name)) {
                $object->{$setter}($value);
            } elseif (!is_scalar($value) && !is_null($value)) {
                $object->{$setter}(serialize($value, $rp->getClass()->name));
            }
        }
    }

    return $object;
}

function extractFields($object, $fields)
{
    $getters = [];
    $nestedOptions = [];
    if (is_array($fields)) { // if the options are passed in
        foreach ($fields as $label => $field) {
            // initialize the getters from the field name
            if (!is_string($field)) { // if the attribute needs to be deserialized again
                if (isset($field['__field'])) {
                    $getters[] = 'get'.ucwords($field['__field']);
                    unset($field['__field']);
                } else { // else the object is a custom object which values derived from this parent object
                    $getters[] = false;
                }
                $nestedOptions[$label] = $field;
            } else { // else the attribute is just a primitive value from the getter method
                $fs = explode('.', $field);
                if (count($fields) <= 1) {
                    $getters[] = 'get'.ucwords($field);
                } else {
                    $fs = array_map(function ($f) {
                        return 'get'.ucwords($f);
                    }, $fs);
                    $getters[] = implode('.', $fs);
                }
            }
        }
        $labels = array_keys($fields);
    } else { // else the options are not passed in
        $methods = get_class_methods(get_class($object));
        $getters = array_filter($methods, function ($method) {
            return preg_match('/^get.*/', $method);
        });
        $labels = array_map(function ($getter) {
            return lcfirst(preg_replace('/^get/', '', $getter));
        }, $getters);
    }
    $fields = array_combine($labels, $getters);

    return [$fields, $nestedOptions];
}
