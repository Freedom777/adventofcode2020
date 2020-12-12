<?php

$data = file('input.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
/*$data = [
    'F10',
    'N3',
    'F7',
    'R90',
    'F11',
];*/
$x = 0;
$y = 0;
$degree = 90;
const DEGREES = [
    0 => 'N',
    90 => 'E',
    180 => 'S',
    270 => 'W',
];

foreach ($data as $item) {
    step($x, $y, $degree, $item);
}

echo abs($x) + abs($y);


function step(&$x, &$y, &$degree, $item) {
    $direction = substr($item, 0, 1);
    $value = (int) substr($item, 1);
    switch ($direction) {
        // Action N means to move north by the given value.
        case 'N':
            $y += $value;
            break;
        // Action S means to move south by the given value.
        case 'S':
            $y -= $value;
            break;
        // Action E means to move east by the given value.
        case 'E':
            $x += $value;
            break;
        // Action W means to move west by the given value.
        case 'W':
            $x -= $value;
            break;
        // Action L means to turn left the given number of degrees.
        case 'L':
            $degree -= $value;
            if ($degree < 0) {
                $degree += 360;
            }
            break;
        // Action R means to turn right the given number of degrees.
        case 'R':
            $degree += $value;
            if ($degree > 270) {
                $degree -= 360;
            }
            break;
        // Action F means to move forward by the given value in the direction the ship is currently facing.
        case 'F':
            step($x, $y, $degree, DEGREES[$degree].$value);
        break;
    }
}