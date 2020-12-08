<?php


$data = file('input.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);


$colors = [];
foreach ($data as $row) {
    list($color, $bags) = explode (' bags contain ', $row);
    $bagCntColors = explode(', ', $bags);
    foreach ($bagCntColors as $bagCntColor) {
        $bagData = explode(' ', $bagCntColor);
        if ('no' == $bagData [0]) {
            $cnt = 0;
        } else {
            array_pop($bagData);
            $cnt = array_shift($bagData);
            $curColor = implode(' ', $bagData);
            $colors[$color][$curColor] = $cnt;
        }
    }
}

$data = [];
recurse('shiny gold', $colors, $data);
var_dump(array_sum($data));
die();

function recurse($value, $colors, &$data = [], $multiplier = 1) {
    if (!empty($colors[$value])) {
        foreach ($colors[$value] as $color => $cnt) {
            $data[] = $cnt * $multiplier;
            recurse($color, $colors, $data, $multiplier * $cnt);
        }
    }
}


