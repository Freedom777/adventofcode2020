<?php

$data = file('input.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

array_walk($data, function (&$item) {
    $item = (int)$item;
});

sort($data);
$builtin = max($data) + 3;
array_unshift($data, 0);
$data [] = $builtin;
$data = array_combine($data, $data);

$graph = array_fill_keys($data, []);
$graphSum = array_fill_keys($data, 0);

$table = [];
for ($i = 0; $i < $builtin;$i++) {
    foreach ($data as $key => $value) {
        if ($value - 3 <= $i && $value > $i && isset($data[$i])) {
            $table [$value] [] = $i;
        }
    }
}

$table = array_reverse(array_intersect_key($table, $data), true);

$curGraphValue = 1;
foreach ($table as $i => $values) {
    $curGraphValue = array_sum($graph [$value]);
    if (empty($curGraphValue)) {
        $curGraphValue = 1;
    }

    foreach ($table [$i] as $value) {
        $graph [$value] [] = $curGraphValue;
    }
}

var_dump(array_sum($graph[0]));

