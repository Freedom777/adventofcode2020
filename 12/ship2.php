<?php

$data = file('input.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
/*$data = [
    'F10',
    'N3',
    'F7',
    'R90',
    'F11',
];*/

$waypointX = 10;
$waypointY = 1;


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
    step($x, $y, /*$degree,*/ $waypointX, $waypointY, $item);
}

echo abs($x) + abs($y);


function step(&$x, &$y/*, &$degree*/, &$waypointX, &$waypointY, $item) {
    $direction = substr($item, 0, 1);
    $value = (int) substr($item, 1);
    switch ($direction) {
        // Action N means to move the waypoint north by the given value.
        case 'N':
            $waypointY += $value;
            break;
        // Action S means to move the waypoint south by the given value.
        case 'S':
            $waypointY -= $value;
            break;
        // Action E means to move the waypoint east by the given value.
        case 'E':
            $waypointX += $value;
            break;
        // Action W means to move the waypoint west by the given value.
        case 'W':
            $waypointX -= $value;
            break;
        // Action L means to rotate the waypoint around the ship left (counter-clockwise) the given number of degrees.
        case 'L':
            switch ($value) {
                case 90:
                    $tmpX = $waypointX;
                    $waypointX = -$waypointY;
                    $waypointY = $tmpX;
                break;
                case 180:
                    $waypointY = -$waypointY;
                    $waypointX = -$waypointX;
                break;
                case 270:
                    $tmpX = $waypointX;
                    $waypointX = $waypointY;
                    $waypointY = -$tmpX;
                break;
            }
            break;
        // Action R means to rotate the waypoint around the ship right (clockwise) the given number of degrees.
        case 'R':
            switch ($value) {
                case 90:
                    $tmpX = $waypointX;
                    $waypointX = $waypointY;
                    $waypointY = -$tmpX;
                    break;
                case 180:
                    $waypointY = -$waypointY;
                    $waypointX = -$waypointX;
                    break;
                case 270:
                    $tmpX = $waypointX;
                    $waypointX = -$waypointY;
                    $waypointY = $tmpX;
                    break;
            }
            break;
        // Action F means to move forward to the waypoint a number of times equal to the given value.
        case 'F':
            $x += $waypointX * $value;
            $y += $waypointY * $value;
        break;
    }
}