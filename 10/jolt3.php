<?php

$data = file('input.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

array_walk($data, function (&$item) {
    $item = (int)$item;
});

sort($data);
$builtin = max($data) + 3;
array_unshift($data, 0);
$data [] = $builtin;
$data = array_combine($data, $data);

define ('DATA', $data);
unset($data);

$paths = [0 => 0];
$cool = 0;

foreach (DATA as $value) {
    $newIter = [];
    foreach ($paths as $sum) {
        $successAr = [];
        for ($step = 1; $step <= 3; ++$step) {
            $curSum = $sum + $step;
            if (isset(DATA[$curSum])) {
                if ($curSum == $builtin) {
                    ++$cool;
                } else {
                    $successAr [] = $curSum;
                }
            }
        }
        $newIter = array_merge($newIter, $successAr);
    }
    $paths = $newIter;
}

var_dump($cool);