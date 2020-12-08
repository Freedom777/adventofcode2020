<?php

$data = file('input.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$idx = 0;
$commands = [];
$acc = 0;

while (!in_array($idx, $commands)) {
    $commands [] = $idx;
    list($operator, $operand) = explode(' ', $data [$idx]);
    switch ($operator) {
        case 'acc':
            $acc += $operand;
        break;
        case 'jmp':
            $idx += $operand - 1;
        break;
    }
    ++$idx;
}

echo $acc;


