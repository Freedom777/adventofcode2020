<?php

$data = file('input.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

array_walk($data, function (&$item) {
    $item = (int)$item;
});

sort($data);
$builtin = max($data) + 3;
array_unshift($data, 0);
$data [] = $builtin;
$dataLen = sizeof($data);

$data = array_combine($data, $data);

$paths = [0 => 0];
$cool = 0;
$unset = [];
foreach ($data as $value) {
    $newIter = [];
    foreach ($paths as $key => $sum) {
        $successAr = [];
        for ($step = 1; $step <= 3; $step++) {
            $curSum = $sum + $step;
            if (isset($data[$curSum])) {
                if ($curSum == $builtin) {
                    ++$cool;
                } else {
                    $successAr [] = $curSum; // $curIdx + $step
                }
            }
        }
        $newIter = array_merge($newIter, $successAr);
    }
    $paths = $newIter;
}
var_dump($cool);