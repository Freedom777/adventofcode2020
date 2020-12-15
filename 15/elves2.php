<?php

$data = file('input.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
define('COUNT', 30000000);

// $data[0] = '3,1,2';
$data = explode(',', $data[0]);

array_walk($data, function (&$item) {
    $item = (int) $item;
});

$spokenCntAr = array_flip($data);

$turnsAr = [];
$lastSpokenAr = [];
$currentTurn = 0;
foreach (array_keys($spokenCntAr) as $value) {
    $turnsAr [++$currentTurn] = $value;
    $spokenCntAr [$value] = 1;
    $lastSpokenAr [$value] = $currentTurn;
}

$flag = false;
$cnt = 0;
$prevTurnValue = $data[sizeof($data)-1];
while (!$flag) {
    $prevTurn = $currentTurn++;

    $currentValue = 0;
    if ($spokenCntAr [$prevTurnValue] != 1) {
        $currentValue = $prevTurn - $lastSpokenAr [$prevTurnValue];
    }

    if (!isset($spokenCntAr[$currentValue])) {
        $spokenCntAr [$currentValue] = 0;
    }
    ++$spokenCntAr [$currentValue];

    $lastSpokenAr [$prevTurnValue] = $prevTurn;
    $prevTurnValue = $currentValue;
    if ($currentTurn == COUNT) {
        $flag = true;
    }
}

var_dump($currentValue);