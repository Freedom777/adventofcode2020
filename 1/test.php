<?php

$sum = 2020;
$numbers = file('input.txt');

$differences = [];
foreach ($numbers as $key => &$number) {
    $number = (int) $number;
    $differences [$key] = $sum - $number;
}

$n = 1;
foreach ($differences as $difference) {
    foreach ($numbers as $number) {
        if ($difference == $number) {
            $n *= $number;
        }
    }
}

echo $n;