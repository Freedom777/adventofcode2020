<?php

$data = file('input.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

define('PREAMBLE_LEN', 25);

for ($s = PREAMBLE_LEN, $dataCnt = sizeof($data); $s < $dataCnt;$s++) {
    $sum = $data [$s];
    $idx = $s - PREAMBLE_LEN;

    $found = false;
    for ($i = $idx; $i < $idx + PREAMBLE_LEN;$i++) {
        for ($j = $idx; $j < $idx + PREAMBLE_LEN;$j++) {
            if ($i != $j && $sum == $data [$i] + $data [$j]) {
                $found = true;
                break 2;
            }
        }
    }
    if (!$found) {
        break;
    }
}

echo $sum;
