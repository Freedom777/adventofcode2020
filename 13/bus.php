<?php

$data = file('input.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
/*$data = [939,
'7,13,x,x,59,x,31,19'
];*/


$depart = (int) $data[0];

$intervals = array_filter(explode(',', $data [1]), function($v) {
    return $v != 'x';
});
array_walk($intervals, function (&$item) {
    $item = (int)$item;
});

$result = [];
foreach ($intervals as $interval) {
    $result [$interval] = $interval - ($depart % $interval);
}

$minutes = min($result);
$busId = array_search($minutes, $result);

var_dump($minutes * $busId);
