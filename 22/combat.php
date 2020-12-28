<?php

$data = file('input.txt', FILE_IGNORE_NEW_LINES);

$players = [];
$currentPlayerNum = 0;
foreach ($data as $row) {
    if (substr($row, 0, 6) == 'Player') {
        $parts = explode(' ', $row);
        $currentPlayerNum = (int) substr($parts[1], 0, -1);
        $players [$currentPlayerNum] = [];
    } elseif (trim($row) == '') {

    } else {
        $players[$currentPlayerNum] [] = (int) $row;
    }
}

while (!empty($players [1]) && !empty($players [2])) {
    $number1 = array_shift($players [1]);
    $number2 = array_shift($players [2]);
    if ($number1 > $number2) {
        $players [1] = array_merge($players [1], [$number1, $number2]);
    } else {
        $players [2] = array_merge($players [2], [$number2, $number1]);
    }
}

if (!empty($players [1])) {
    $sum = calc($players[1]);
} else {
    $sum = calc($players[2]);
}

var_dump($sum);
die();


function calc($ar) {
    $i = count($ar);
    $sum = 0;
    foreach ($ar as $value) {
        $sum += $value * $i--;
    }

    return $sum;
}
