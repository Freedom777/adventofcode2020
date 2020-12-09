<?php

$data = file('input.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

define('PREAMBLE_LEN', 25);

// $preamble = array_slice($data, 0, PREAMBLE_LEN);
// $data = array_values(array_slice($data, PREAMBLE_LEN));

for ($s = PREAMBLE_LEN, $dataCnt = sizeof($data); $s < $dataCnt; $s++) {
    $sum = $data [$s];
    $idx = $s - PREAMBLE_LEN;

    $found = false;
    for ($i = $idx; $i < $idx + PREAMBLE_LEN; $i++) {
        for ($j = $idx; $j < $idx + PREAMBLE_LEN; $j++) {
            if ($i != $j && $sum == $data [$i] + $data [$j]) {
                $found = true;
                break 2;
            }
        }
    }

    if (!$found) {
        for ($i = 0; $i < $s; $i++) {
            $sumIJ = $data [$i];
            for ($j = $i + 1; $j < $s; $j++) {
                $sumIJ += $data [$j];
                if ($sumIJ == $sum) {
                    $dataNeeded = array_slice($data, $i, $j - $i + 1);
                    echo max($dataNeeded) + min($dataNeeded);
                    break 2;
                } elseif ($sumIJ > $sum) {
                    break;
                }
            }
        }

        break;
    }
}