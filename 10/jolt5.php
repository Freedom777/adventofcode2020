<?php

$data = file('test.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

array_walk($data, function (&$item) {
    $item = (int)$item;
});

sort($data);
$builtin = max($data) + 3;
array_unshift($data, 0);
$data [] = $builtin;
$data = array_combine($data, $data);

$table = [];
for ($i = 0; $i < $builtin;$i++) {
    foreach ($data as $key => $value) {
        if ($value - 3 <= $i && $value > $i && isset($data[$i])) {
            $table [$value] [] = $i;
        }
    }
}

$table = array_reverse(array_intersect_key($table, $data), true);

$sum = 0;
foreach ($table as $values) {
    $m = recurseF($values, $table);
    if ($m > 1) {
        $sum += $m;
    }
}

var_dump($sum);
die();

function recurseF($values, $data, $m = 1) : int {
    $s = sizeof($values);
    if ($s > 1) {
        $m *= $s;
        foreach ($values as $value) {
            $m = recurseF($data[$value], $data, $m);
        }
    }

    return $m;
}



// var_dump($table);
var_dump($sum / 2);
die();

$cnt = recurse(current($table), $table);
echo $cnt;
file_put_contents('log.txt', date('Y-m-d H:i:s') . ' : ' . $cnt . PHP_EOL, FILE_APPEND);

function recurse($values, $data) {
    static $cnt = 0;

    foreach ($values as $value) {
        if (empty($value)) {
            ++$cnt;
        } else {
            recurse($data [$value], $data);
        }
    }

    return $cnt;
}

function factorial($n)
{
    if ($n == 0) {
        return 1;
    } else {
        return $n * factorial($n - 1);
    }
}