<?php

$data = file('input.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$lastIdx = sizeof($data) - 1;
$changed = [];
$idx = 0;

while($idx != ($lastIdx + 1)) {
    $acc = 0;
    $idx = 0;
    $commands = [];
    $flag = FALSE;
    while (!in_array($idx, $commands)) { //  && $idx <= $lastIdx
        $commands [] = $idx;
        list($operator, $operand) = explode(' ', $data [$idx]);
        switch ($operator) {
            case 'acc':
                $acc += $operand;
                break;
            case 'jmp':
                if (!$flag && !in_array($idx, $changed)) {
                    $flag = TRUE; // changed to nop
                    $changed [] = $idx;
                } else {
                    $idx += $operand - 1;
                }
                break;
            case 'nop':
                if (!$flag && !in_array($idx, $changed)) {
                    $flag = TRUE; // changed to jmp
                    $changed [] = $idx;
                    $idx += $operand - 1;
                }
                break;
        }
        ++$idx;
        if ($idx > $lastIdx) {
            break;
        }
    }
}

echo $idx . PHP_EOL . PHP_EOL . $acc;


