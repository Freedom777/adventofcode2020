<?php

$data = file('input.txt', FILE_IGNORE_NEW_LINES/* | FILE_SKIP_EMPTY_LINES*/);

// Conditions parse
$i = -1;
$source = [];
$fullSource = [];
while ($data[++$i] != '') {
    $tmp = explode(': ', $data[$i]);

    $cur = explode(' or ', $tmp[1]);
    list($min, $max) = explode('-', $cur [0]);
    $source [$tmp [0]] [] = [(int) $min, (int) $max];
    $fullSource [] = [(int) $min, (int) $max];
    list($min, $max) = explode('-', $cur [1]);
    $source [$tmp [0]] [] = [(int) $min, (int) $max];
    $fullSource [] = [(int) $min, (int) $max];
}

// My Ticket parse
$my_ticket = explode(',', $data[$i+2]);
array_walk($my_ticket, function (&$item) {
    $item = (int) $item;
});

// Other Tickets parse
$tickets = [];
for ($j = $i+5; $j < sizeof($data);$j++) {
    $tmp = explode(',', $data[$j]);
    array_walk($tmp, function (&$item) {
        $item = (int) $item;
    });
    $tickets[] = $tmp;
}

// Remove invalid tickets
foreach ($tickets as $key => $ticket) {
    foreach ($ticket as $number) {
        $flag = false;
        foreach ($fullSource as $valid) {
            if ($number >= $valid [0] && $number <= $valid [1]) {
                $flag = true;
                break;
            }
        }
        if (!$flag) {
            unset($tickets [$key]);
            break;
        }
    }
}
unset($fullSource);

// Get other Tickets counts if corresponds condition
$cnts = array_fill_keys(array_keys($source), []);
foreach ($tickets as $key => $ticket) {
    foreach ($ticket as $place => $number) {
        foreach ($source as $name => $conditions) {
            if (
                $number >= $conditions [0] [0] && $number <= $conditions [0] [1] ||
                $number >= $conditions [1] [0] && $number <= $conditions [1] [1]
            ) {
                if (!isset($cnts [$name] [$place])) {
                    $cnts [$name] [$place] = 0;
                }
                ++$cnts [$name] [$place];
            }
        }
    }
}

// Get sums of condition corresponds counts
$sums = [];
foreach ($cnts as $cntName => $dataAr) {
    $sums [$cntName] = array_sum($dataAr);
}
asort($sums);

// Get keys for every name of type, i.e. ['class' => 1, 'departure time' => 19, ...]
$fullSum = sizeof($tickets);
$foundAr = [];
foreach ($sums as $cntName => $sumValue) {
    $key = array_search($fullSum, $cnts [$cntName]);
    $foundAr [$cntName] = $key;
    foreach ($cnts as $name => $data) {
        unset($cnts[$name][$key]);
    }
}

// Get task purpose multiply
$departure = array_filter($foundAr, function ($key) {
    return substr($key, 0, 9)  == 'departure';
}, ARRAY_FILTER_USE_KEY);

$multiply = 1;
foreach ($departure as $key) {
    $multiply *= $my_ticket[$key];
}


var_dump($multiply);
