<?php

$data = file('input.txt', FILE_IGNORE_NEW_LINES);

$tiles = [];
$currentTileNum = 0;
foreach ($data as $row) {
    if (substr($row, 0, 4) == 'Tile') {
        $parts = explode(' ', $row);
        $currentTileNum = (int) substr($parts[1], 0, -1);
        $tiles [$currentTileNum] = [];
    } elseif (trim($row) == '') {

    } else {
        $rowAr = str_split($row);
        $tmp = [];
        foreach ($rowAr as $char) {
            if ('#' == $char) {
                $tmp [] = 1;
            } else {
                $tmp [] = 0;
            }
        }
        $tiles[$currentTileNum] [] = $tmp;
    }
}

$columns = sizeof(current($tiles)[0]);
$rows = sizeof(current($tiles));

$sums = [];
foreach ($tiles as $tileNum => $tile) {
    // UP
    $sum = 0;
    for ($i = 0; $i < $columns;$i++) {
        if ($tile [0] [$i] == 1) {
            $sum += pow(2, $i);
        }
    }
    $sums [$tileNum] [] = $sum;

    $sum = 0;
    for ($i = $columns - 1; $i >= 0;$i--) {
        if ($tile [0] [$i] == 1) {
            $sum += pow(2, $columns - $i - 1);
        }
    }
    $sums [$tileNum] [] = $sum;

    // LEFT
    $sum = 0;
    for ($i = 0; $i < $rows;$i++) {
        if ($tile [$i] [0] == 1) {
            $sum += pow(2, $i);
        }
    }
    $sums [$tileNum] [] = $sum;

    $sum = 0;
    for ($i = $rows - 1; $i >= 0;$i--) {
        if ($tile [$i] [0] == 1) {
            $sum += pow(2, $rows - $i - 1);
        }
    }
    $sums [$tileNum] [] = $sum;

    // RIGHT
    $sum = 0;
    for ($i = 0; $i < $rows;$i++) {
        if ($tile [$i] [$columns - 1] == 1) {
            $sum += pow(2, $i);
        }
    }
    $sums [$tileNum] [] = $sum;

    $sum = 0;
    for ($i = $rows - 1; $i >= 0;$i--) {
        if ($tile [$i] [$columns - 1] == 1) {
            $sum += pow(2, $rows - $i - 1);
        }
    }
    $sums [$tileNum] [] = $sum;

    // DOWN
    $sum = 0;
    for ($i = 0; $i < $columns;$i++) {
        if ($tile [$rows - 1] [$i] == 1) {
            $sum += pow(2, $i);
        }
    }
    $sums [$tileNum] [] = $sum;

    $sum = 0;
    for ($i = $columns - 1; $i >= 0;$i--) {
        if ($tile [$rows - 1] [$i] == 1) {
            $sum += pow(2, $columns - $i - 1);
        }
    }
    $sums [$tileNum] [] = $sum;

}

$values = $sums;
$cnts = [];
foreach ($sums as $key => $sum) {
    $cnts [$key] = 0;
    foreach (array_diff_key($values, [$key => 1]) as $otherKey => $otherSum) {
        foreach ($sum as $number) {
            if (in_array($number, $otherSum)) {
                ++$cnts [$key];
            }
        }
    }
}

$m = 1;
foreach ($cnts as $key => $value) {
    if ($value == 4) {
        $m *= $key;
    }
}
var_dump($m);
die();




$value = current($sums) [0];
$key = key($sums);
var_dump($value);

$currentX = 0;
$currentY = 0;
$positions = [];
$positions [$currentY] = [];
$positions [$currentY] [$currentX] = $key;

while (!empty($sums)) {
    $key = array_key_last($sums);
    $values = array_pop($sums);
    $positions [$currentY] [$currentX] = $key;

    foreach ($values as $sourceKey => $value) {
        $flagUp = false;
        $flagLeft = false;
        $flagDown = false;
        $flagRight = false;

        foreach ($sums as $sum) {
            $findedKey = array_search($value, $sum);
            if (FALSE !== $findedKey) {
                switch ($sourceKey) {
                    // UP
                    case 0:
                    case 1:
                        if (!$flagUp) {
                            if (!isset($positions [$currentY - 1])) {
                                $positions [$currentY - 1] = [];
                            }
                            $positions [$currentY - 1] [$currentX] = $findedKey;
                            $flagUp = true;
                        }
                        break;
                    // LEFT
                    case 2:
                    case 3:
                        if (!$flagLeft) {
                            $positions [$currentY] [$currentX - 1] = $findedKey;
                            $flagLeft = true;
                        }
                        break;
                    // RIGHT
                    case 4:
                    case 5:
                        if (!$flagRight) {
                            $positions [$currentY] [$currentX + 1] = $findedKey;
                            $flagRight = true;
                        }
                        break;
                    // DOWN
                    case 6:
                    case 7:
                        if (!$flagDown) {
                            if (!isset($positions [$currentY + 1])) {
                                $positions [$currentY + 1] = [];
                            }
                            $positions [$currentY + 1] [$currentX] = $findedKey;
                            $flagDown = true;
                        }
                    break;
                }
            }
        }
    }
}


function array_key_last($array) {
    $lastKey = key(array_slice($array, -1, 1, true));

    return $lastKey;
}
