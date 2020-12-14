<?php

$data = file('input.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
/*$data = [
    'mask = XXXXXXXXXXXXXXXXXXXXXXXXXXXXX1XXXX0X',
    'mem[8] = 11',
    'mem[7] = 101',
    'mem[8] = 0',
];*/
$mem = [];


foreach ($data as $item) {
    list($operation, $value) = explode(' = ', $item);

    switch (substr($operation, 0, 4)) {
        case 'mask':
            $curMask = array_reverse(str_split($item));
        break;
        case 'mem[':
            $idx = (int) substr($operation, 4, -1);
            if (empty($mem [$idx])) {
                $mem [$idx] = 0;
            }
            $value = (int) $value;
            for ($i = 0, $cnt = sizeof($curMask); $i < $cnt; $i++) {
                $curMultiplier = pow(2,$i);

                switch ($curMask[$i]) {
                    case '0':
                        if ($mem [$idx] & $curMultiplier) {
                            $mem [$idx] -= $curMultiplier;
                        }
                    break;
                    case '1':
                        if (!($mem [$idx] & $curMultiplier)) {
                            $mem [$idx] += $curMultiplier;
                        }
                    break;
                    case 'X':
                        if ($curMultiplier & $value) {
                            if (!($mem [$idx] & $curMultiplier)) {
                                $mem [$idx] += $curMultiplier;
                            }
                        } elseif ($mem [$idx] & $curMultiplier) {
                            $mem [$idx] -= $curMultiplier;
                        }
                    break;
                }
            }
        break;
    }

}

var_dump(array_sum($mem));