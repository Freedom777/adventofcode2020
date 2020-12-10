<?php

$data = file('input.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

array_walk($data, function (&$item) {
    $item = (int) $item;
});

sort($data);
$builtin = max($data) + 3;
array_unshift($data, 0);
$data [] = $builtin;

$diff = [];
for ($i = 1, $cnt = sizeof($data); $i < $cnt;$i++) {
    $idx = $data[$i] - $data[$i-1];
    if (empty($diff[$idx])) {
        $diff[$idx] = 1;
    } else {
        ++$diff[$idx];
    }
}

var_dump($diff[1] * $diff[3]);
die();