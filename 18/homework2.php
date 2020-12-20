<?php

$data = file('input.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
// $data = ['1 + 2 * 3 + 4 * 5 + 6'];
//          45  *   272   =    216         +           56
// $data = '5 * 9 * (7 * 3 * 3 + 9 * 3 + (8 + 6 * 4))'; // 12240

$sum = 0;
foreach ($data as $row) {
    $search = str_replace(' ', '', $row);
    while (preg_match_all('#\(([\d\+\*]+)\)#', $search, $matches)) {
        $sums = [];
        foreach ($matches [1] as $key => $match) {
            $result = split($match);

            $search = str_replace($matches[0] [$key], calculate_parenthesis($result), $search);

            // var_dump($search);
        }
    }

    $sum += calculate_parenthesis(split($search));
}


var_dump($sum);


function array_key_last($array) {
    $lastKey = key(array_slice($array, -1, 1, true));

    return $lastKey;
}

function split($match) {
    $result = [];
    $mults = explode('*', $match);
    $pluses = explode('+', $match);
    if (sizeof($mults) > 1) { // Only * in string
        foreach ($mults as $mult) {
            $pluses = explode('+', $mult);
            $sum = array_sum($pluses);
            $result [] = $sum;
            $result [] = '*';
        }
        unset($result[array_key_last($result)]);
    } elseif (sizeof($pluses) > 1) { // No * operators
        $result [] = array_sum($pluses);
    } else {
        $result [] = $match;
    }

    return $result;
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