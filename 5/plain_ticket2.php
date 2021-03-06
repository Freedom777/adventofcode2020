<?php

$data = file('input.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$globalmax = 0;
$places = [];

foreach ($data as $string) {
    $min = 0;
    $max = 127;

    $lrmin = 0;
    $lrmax = 7;

    $letters = str_split($string);
    foreach ($letters as $letter) {
        switch ($letter) {
            case 'F':
                $max = $min + (($max - $min) >> 1);
                break;
            case 'L':
                $lrmax = $lrmin + (($lrmax - $lrmin) >> 1);
                break;

            case 'B':
                $min = $min + (($max - $min) >> 1) + 1;
                break;

            case 'R':
                $lrmin = $lrmin + (($lrmax - $lrmin) >> 1) + 1;
                break;
        }
    }
    $value = $min * 8 + $lrmin;
    $places [] = $value;
    if ($value > $globalmax) {
        $globalmax = $value;
    }
}
sort($places);
$num = current($places);
for ($i=0; $i < sizeof($places);$i++) {
    if ($num != $places[$i]) {
        echo $num;
        break;
    }
    ++$num;
}