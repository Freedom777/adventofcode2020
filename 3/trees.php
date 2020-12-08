<?php

$data = file('input.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$steps = 3;
$rowLen = strlen($data[0]);
$lines = sizeof($data);

$trees = 0;
$step = 0;

for ($line = 1;$line < $lines;$line++) {
    $row = $data [$line];
    $newStep = $step + $steps;
    $rowRepeat = ceil($newStep / $rowLen);
    $rowData = str_repeat($row, $rowRepeat + 1);
    $rowAr = str_split($rowData);
    if ('#' == $rowAr[$newStep]) {
        ++$trees;
    }
    $step = $newStep;
}

echo PHP_EOL . $trees . ' / ' . $lines . PHP_EOL;
