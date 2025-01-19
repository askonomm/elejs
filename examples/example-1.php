<?php

$test = 123.5;
$test2 = 1.23;
$test3 = $test + $test2;

echo $test3;

function some_function_name(int|float $a, int|float $b, int|float $c): int|float
{
    if ($a === 123.5) {
        return "a";
    }

    return $b + $c;
}

$thing = some_function_name($test3, 123, 5);