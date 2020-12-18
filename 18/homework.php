<?php

$data = '5 * 9 * (7 * 3 * 3 + 9 * 3 + (8 + 6 * 4))'; // 12240

$parts = str_replace(' ', '', $data);
$parts = str_split($data);
$max = analyze($parts);

var_dump(calc($parts, $max));
die();



die();
var_dump($parts);
die();
// $last_operator = '';
$prev_operator = '';
$total = 0;
$sum = 0;
foreach ($parts as $part) {
    $part = str_replace([' ', ')'], '', $part);

    $values = str_split($part);
    $last_operator = $prev_operator;
    foreach ($values as $value) {
        if (is_numeric($value)) {
            if (empty($prev_operator)) {
                $sum = $value;
            } else {
                if ($prev_operator == '*') {
                    $sum *= $value;
                } else {
                    $sum += $value;
                }
            }
        } else {
            $prev_operator = $value;
        }
    }
    if (!empty($last_operator)) {
        if ($last_operator == '*') {
            $total *= $sum;
        } else {
            $total += $sum;
        }
    } else {
        $total = $sum;
    }
}

function calc($expression, $max) {
    $i = 0;
    foreach ($expression as $key => $value) {
        if ('(' == $value) {
            ++$i;
            if ($i == $max) {
                $expr = [];
                for($j = $key + 1; $j < sizeof($expression) && ')' != $expression[$j];$j++) {
                    $expr[] = $expression [$j];
                }

                return calculate_parenthesis($expr);
            }
        } elseif (')' == $value) {
            --$i;
        }
    }

    return 0;
}

function analyze($expression) {
    $i = 0;
    $max = 0;
    foreach ($expression as $value) {
        if ('(' == $value) {
            ++$i;
            if ($i > $max) {
                $max = $i;
            }
        } elseif (')' == $value) {
            --$i;
        }
    }
    return $max;
}

function calculate_parenthesis($expression) {
    $sum = 0;

    $prev_operator = '';
    foreach ($expression as $value) {
        if (is_numeric($value)) {
            if (empty($prev_operator)) {
                $sum = $value;
            } else {
                if ($prev_operator == '*') {
                    $sum *= $value;
                } else {
                    $sum += $value;
                }
            }
        } else {
            $prev_operator = $value;
        }
    }

    return $sum;
}

var_dump($total);