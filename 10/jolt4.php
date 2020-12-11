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

$table = [];
for ($i = 0; $i < $builtin;$i++) {
    foreach ($data as $key => $value) {
        if ($value - 3 <= $i && $value > $i && isset($data[$i])) {
            $table [$value] [] = $i;
        }
    }
}

$table = array_reverse(array_intersect_key($table, $data), true);
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