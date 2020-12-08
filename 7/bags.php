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
// var_dump($data);
$data = array_unique($data);
var_dump(sizeof($data));

function recurse($value, $colors, &$data = []) {
    foreach ($colors as $key => $containAr) {
        if (in_array($value, array_keys($containAr))) {
            $data [] = $key;
            recurse($key, $colors, $data);
        }
    }
}


