<?php

$data = file('input.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

// $data[0] = '0,3,6';
$data = explode(',', $data[0]);

array_walk($data, function (&$item) {
    $item = (int) $item;
});

$spokenAr = array_flip($data);

$turnsAr = [];
$currentTurn = 0;
foreach (array_keys($spokenAr) as $value) {
    $turnsAr [++$currentTurn] = $value;
    $spokenAr [$value] = 1;
}

$flag = false;
$cnt = 0;
while (!$flag) {
    ++$currentTurn;
    $currentNumber = turn($currentTurn, $turnsAr, $spokenAr);
    if ($currentTurn == 30000000) {
        $flag = true;
    }
}

var_dump($currentNumber);

function turn($currentTurn, &$turnsAr, &$spokenAr) {
    $prevTurnNumber = $turnsAr[$currentTurn - 1];
    if ($spokenAr [$prevTurnNumber] == 1) {
        $currentNumber = 0;
    } else {
        $ar = [];
        $i = $currentTurn - 1;
        while (sizeof($ar) != 2) {
            if ($turnsAr[$i] == $prevTurnNumber) {
                $ar [] = $i;
            }
            $i--;
        }
        $currentNumber = $ar[0] - $ar[1];
    }

    $turnsAr [$currentTurn] = $currentNumber;
    if (!isset($spokenAr[$currentNumber])) {
        $spokenAr [$currentNumber] = 0;
    }
    ++$spokenAr [$currentNumber];

    return $currentNumber;
}
