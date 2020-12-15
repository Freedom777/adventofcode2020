<?php

$data = file('input.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

// $data [1] = '7,13,x,x,59,x,31,19'; // 1202161486
// $data [1] = '67,7,59,61';
$intervals = explode(',', $data [1]);
foreach ($intervals as $key => $interval) {
    if ($interval == 'x') {
        unset($intervals [$key]);
    }
}
array_walk($intervals, function (&$item) {
    $item = (int) $item;
});

define('MAX_INTERVAL', max($intervals));
define('MAX_KEY', array_search(MAX_INTERVAL, $intervals));
unset($intervals [MAX_KEY]);

$ints = [];
foreach ($intervals as $key => $interval) {
    $ints [$key - MAX_KEY] = $interval;
}


$cur = 0;
$curValue = 0;
$curSum = MAX_INTERVAL;
foreach ($ints as $key => $interval) {
    while ( $curValue != $cur + $key) {
        $cur += $curSum;
        $multiplier = (int) ceil(($cur + $key) / $interval);
        $curValue = $interval * $multiplier;
    }
    $curSum *= $interval;
}

var_dump($cur - MAX_KEY);