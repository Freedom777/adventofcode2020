<?php

$data = file('input.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$correct = 0;
$line = 0;
foreach ($data as $row) {
    ++$line;
    if (!preg_match('#(\d+)\-(\d+) ([a-z])\: ([a-z]+)#', $row, $matches)) {
        echo $row;
        die();
    }
    $min = (int) $matches[1];
    $max = (int) $matches [2];
    $sourceChar = $matches[3];
    $strAr = str_split($matches[4]);


    $cnt = 0;
    foreach ($strAr as $char) {
        if ($char == $sourceChar) {
            ++$cnt;
        }
    }
    if ($cnt >= $min && $cnt <= $max) {
        ++$correct;
    }
}
echo PHP_EOL . $correct . ' / ' . $line . PHP_EOL;
