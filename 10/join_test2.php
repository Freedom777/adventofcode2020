<?php

$data = file('test2.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

array_walk($data, function (&$item) {
    $item = (int)$item;
});

sort($data);
$builtin = max($data) + 3;
array_unshift($data, 0);
$data [] = $builtin;
$dataLen = sizeof($data);

$data = array_combine($data, $data);

$paths = ['0' => 0];
$cool = [];
foreach ($data as $value) {
    $tmpAr = $paths;
    foreach ($tmpAr as $path => $sum) {
        $successAr = recurse($data, $sum, $path);
        unset($paths[$path]);
        $paths = array_merge($paths, $successAr);
    }
}
var_dump(sizeof($cool));

function recurse($data, $curSum = 0, $curPath = '') {
    global $cool, $builtin;
    $successAr = [];
    for ($step = 1; $step <= 3; $step++) {
        if (isset($data[$curSum+$step])) {
            $successAr [$curPath . $step] = $curSum + $step;
            if ($curSum + $step == $builtin) {
                $cool [] = $curPath . $step;
            }
        }
    }
    return $successAr;
}

