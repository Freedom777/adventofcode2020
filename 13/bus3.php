<?php

// $data = file('input.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$data [1] = '67,7,59,61';
$intervals = explode(',', $data [1]);
foreach ($intervals as $key => $interval) {
    if ($interval == 'x') {
        unset($intervals [$key]);
    }
}

$sum = 1;
foreach ($intervals as $key => $interval) {
    var_dump($interval + $key);
    $sum *= ($interval + $key);
    var_dump($sum);
}
var_dump($sum);
var_dump($sum / 754018);

/*for ($i = 2; $i < 10;$i++) {

}*/

// var_dump($curValue);