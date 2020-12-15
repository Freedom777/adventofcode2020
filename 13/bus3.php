<?php

$data = file('input.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

// $data [1] = '1789,37,47,1889';
// $data [1] = '10,3';
$intervals = explode(',', $data [1]);
foreach ($intervals as $key => $interval) {
    if ($interval == 'x') {
        unset($intervals [$key]);
    }
}
array_walk($intervals, function (&$item) {
    $item = (int) $item;
});


$firstInterval = $intervals [0];
unset($intervals [0]);

$cur = 0;
$curValue = 0;
$curSum = $firstInterval;
foreach ($intervals as $key => $interval) {
    while ( $curValue != $cur + $key) {
        $cur += $curSum;
        $multiplier = (int) ceil($cur / $interval);
        $curValue = $interval * $multiplier;
    }
    $curSum *= $interval;
}

var_dump($cur);