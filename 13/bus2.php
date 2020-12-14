<?php

$data = file('input.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

// $data [1] = '7,13,x,x,59,x,31,19';
$intervals = explode(',', $data [1]);
foreach ($intervals as $key => $interval) {
    if ($interval == 'x') {
        unset($intervals [$key]);
    }
}

$flag = false;
$i = 0;
while (!$flag) {
    $curValue = ++$i * $intervals [0];
    $flag = true;
    foreach ($intervals as $key => $interval) {
        if (($curValue + $key) % $interval != 0) {
            $flag = false;
            break;
        }
    }
}

var_dump($curValue);