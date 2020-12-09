<?php

$data = file('input.txt', FILE_IGNORE_NEW_LINES/* | FILE_SKIP_EMPTY_LINES*/);

$groupIdx = 0;
$arr = array_combine(range('a', 'z'), array_fill(0, 26, 0));
$groupSums = [];
$group = $arr;

foreach ($data as $row) {
    if (empty($row)) {
        $groupSums[$groupIdx++] = array_sum($group);
        $group = $arr;
    } else {
        $rowAr = str_split($row);
        foreach ($rowAr as $letter) {
            $group[$letter] = 1;
        }
    }
}
// Last group
$groupSums[$groupIdx] = array_sum($group);

var_dump(array_sum($groupSums));
die();
// $group = $arr;

