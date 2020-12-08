<?php

$data = file('input.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$steps = 3;
$rowLen = strlen($data[0]);
$lines = sizeof($data);

/*foreach ($data as &$row) {
    $row = str_split($row);
}*/

$multipliers = [];

$slopeIdx = 0;
$slopes = [
    [1, 1],
    [3, 1],
    [5, 1],
    [7, 1],
    [1, 2],
];

foreach ($slopes as $slope) {
    $trees = 0;
    $step = 0;

    $stepLen = $slope[0];
    $lineStep = $slope[1];
    $line = $lineStep;

    while ($line < $lines) {
        $row = $data [$line];
        $newStep = $step + $stepLen;

        $rowRepeat = ceil($newStep / $rowLen);
        $rowData = str_repeat($row, $rowRepeat + 1);
        $rowAr = str_split($rowData);

        if ('#' == $rowAr[$newStep]) {
            ++$trees;
        }

        $step = $newStep;
        $line += $lineStep;
    }
    $multipliers [] = $trees;
}

echo PHP_EOL . array_product($multipliers) . ' / ' . $lines . PHP_EOL;
