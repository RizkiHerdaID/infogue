<?php
/*
|--------------------------------------------------------------------------
| Application Helper
|--------------------------------------------------------------------------
|
| General helper for general purpose, below are lists of independent
| function that can called in every view.
|
*/

function formatSortNumeric($value, $precision = 1)
{
    $value = doubleval($value);

    if ($value < 1000) {
        // Anything less than a thousand
        $n_format = number_format($value);
    } else if ($value < 1000000) {
        // Anything less than a million
        $n_format = number_format($value / 1000, $precision) . 'K';
    } else if ($value < 1000000000) {
        // Anything less than a billion
        $n_format = number_format($value / 1000000, $precision) . 'M';
    } else {
        // At least a billion
        $n_format = number_format($value / 1000000000, $precision) . 'B';
    }

    return $n_format;
}

function formatBytes($bytes, $precision = 2)
{
    $units = array('B', 'KB', 'MB', 'GB', 'TB');

    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($units) - 1);

    // Uncomment one of the following alternatives
    // $bytes /= pow(1024, $pow);
    // $bytes /= (1 << (10 * $pow));

    return round($bytes, $precision) . ' ' . $units[$pow];
}