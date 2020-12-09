<?php

$data = file('input.txt', FILE_IGNORE_NEW_LINES/* | FILE_SKIP_EMPTY_LINES*/);

$groupIdx = 0;
$arr = array_combine(range('a', 'z'), array_fill(0, 26, 0));
$groupSums = [];
$group = $arr;
$cnt = 0;

foreach ($data as $row) {
    if (empty($row)) {
        $sum = 0;
        foreach ($group as $let => $num) {
            if ($num == $cnt) {
                ++$sum;
            }
        }
        $groupSums[$groupIdx] = $sum;
        ++$groupIdx;
        $cnt = 0;
        $group = $arr;
    } else {
        ++$cnt;
        $rowAr = str_split($row);
        foreach ($rowAr as $letter) {
            ++$group[$letter];
        }
    }
}
// Last group
$sum = 0;
foreach ($group as $let => $num) {
    if ($num == $cnt) {
        ++$sum;
    }
}
$groupSums[$groupIdx] = $sum;


var_dump($groupSums);

var_dump(array_sum($groupSums));
die();
// $group = $arr;

