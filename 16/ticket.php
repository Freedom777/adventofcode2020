<?php

$data = file('input.txt', FILE_IGNORE_NEW_LINES/* | FILE_SKIP_EMPTY_LINES*/);

$source = [];
$i = -1;
while ($data[++$i] != '') {
    $tmp = explode(': ', $data[$i]);
    $cur = explode(' or ', $tmp[1]);
    list($min, $max) = explode('-', $cur [0]);
    $source [] = [(int) $min, (int) $max];
    list($min, $max) = explode('-', $cur [1]);
    $source [] = [(int) $min, (int) $max];
}

$my_ticket = $data[$i+2];

$tickets = [];
for ($j = $i+5; $j < sizeof($data);$j++) {
    $tmp = explode(',', $data[$j]);
    array_walk($tmp, function (&$item) {
        $item = (int) $item;
    });
    $tickets = array_merge($tmp, $tickets);
}

$sum = 0;
foreach ($tickets as $ticket) {
    $flag = false;
    foreach ($source as $valid) {
        if ($ticket >= $valid [0] && $ticket <= $valid [1]) {
            $flag = true;
            break;
        }
    }
    if (!$flag) {
        $sum += $ticket;
    }
}


var_dump($sum);
die();