<?php

$sum = 2020;
$numbers = file('input.txt');
foreach ($numbers as $key => &$number) {
    $number = (int)$number;
}

for ($i=0, $cnti = sizeof($numbers);$i<$cnti;$i++) {
    for ($j=0, $cntj = sizeof($numbers);$j<$cntj;$j++) {
        for ($k=0, $cntk = sizeof($numbers);$k<$cntk;$k++) {
            if ($numbers[$i]+$numbers[$j]+$numbers[$k] == $sum) {
                echo $numbers[$i]*$numbers[$j]*$numbers[$k] . PHP_EOL;
            }
        }
    }
}
