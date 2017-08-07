<?php
namespace Plexo\Sdk\Utilities\functions;

function array_filter_recursive($input, $canonize = false)
{
    foreach ($input as &$value) {
        if ($value instanceof \Plexo\Sdk\Models\PlexoModelInterface) {
            $value = $value->toArray($canonize);
        }
        if (is_array($value)) {
            $value = array_filter_recursive($value, $canonize);
        }
    }
    return array_filter($input, function ($v) {
        return !is_null($v);
    });
}

function ksortRecursive(&$array)
{
    if (!is_array($array) || key($array) === 0) {
        return false;
    }
    ksort($array, SORT_REGULAR);
    foreach ($array as &$arr) {
        ksortRecursive($arr);
    }
    return true;
}

function replace_unicode_escape_sequence($match)
{
    return mb_convert_encoding(pack('H*', $match[1]), 'UTF-8', 'UCS-2BE');
}
