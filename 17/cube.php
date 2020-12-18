<?php

const MIN_X = -1;
const MAX_X = 1;
const MIN_Y = -1;
const MAX_Y = 1;
const MIN_Z = 0;
const MAX_Z = 0;


$data = [];
$data[-1] = '.#.';
$data[0] = '..#';
$data[1] = '###';
// 24

$checks = [];
for ($z = -1; $z <= 1; $z++) {
    for ($y = -1; $y <= 1; $y++) {
        for ($x = -1; $x <= 1; $x++) {
            $checks [] = [$z, $y, $x];
        }
    }
}
unset($checks[13]);

$matrix = [];
for ($z = MIN_Z; $z <= MAX_Z; $z++) {
    for ($y = MIN_Y; $y <= MAX_Y; $y++) {
        for ($x = MIN_X; $x <= MAX_X; $x++) {
            $matrix[$z][$y][$x] = 0;
        }
    }
}
$sum = 0;
foreach ($data as $y => $str) {
    $tmp = str_split($str);
    $str = [];
    foreach ($tmp as $x => $char) {
        if ($char == '#') {
            $matrix [0] [$y] [$x - 1] = 1;
        }
    }
}

$minX = MIN_X;
$maxX = MAX_X;
$minY = MIN_Y;
$maxY = MAX_Y;
$minZ = MIN_Z;
$maxZ = MAX_Z;


$matrix = analyze($matrix, $checks, $minZ, $maxZ, $minY, $maxY, $minX, $maxX);
/*var_dump($matrix);
die();*/
var_dump(calc_sum($matrix, $minZ, $maxZ, $minY, $maxY));
die();

// 11
for ($i = 1;$i <= 1;$i++) {
    $matrix = analyze($matrix, $checks);
    var_dump(calc_sum($matrix));
}
// var_dump($matrix);

// var_dump($sum);


function calc_sum($matrix, $minZ, $maxZ, $minY, $maxY) {
    $sum = 0;
    for ($z = $minZ; $z <= $maxZ; $z++) {
        for ($y = $minY; $y <= $maxY; $y++) {
            $sum += array_sum($matrix[$z][$y]);
        }
    }
    return $sum;
}

function analyze($matrix, $checks, $minZ, $maxZ, $minY, $maxY, $minX, $maxX) {
    $result = [];
    for ($z = $minZ - 1; $z <= $maxZ + 1; $z++) {
        for ($y = $minY; $y <= $maxY; $y++) {
            for ($x = $minX; $x <= $maxX; $x++) {
                $cnt = 0;
                $a = [];
                /*var_dump($checks);
                die();*/
                foreach ($checks as $check) {
                    $b = 'x='.$x.','.'y='.$y.','.'z='.$z;
                    if (!empty($matrix [$z + $check[0]] [$y + $check [1]] [$x + $check[2]])) {
                        $a [] =
                            $matrix [$z + $check[0]] [$y + $check [1]] [$x + $check[2]].
                            'x='.($x + $check[2]).','.'y='.($y + $check [1]).','.'z='.($z + $check[0])
                        ;
                        ++$cnt;
                    }
                }

                $result [$z] [$y] [$x] = 0;
                if (empty($matrix [$z] [$y] [$x])) {
                    if (in_array($cnt, [2,3])) {
                        var_dump($b . ':' . $cnt . PHP_EOL . implode(PHP_EOL, $a));
                        $result [$z] [$y] [$x] = 1;
                    }
                } elseif ($cnt == 3) {
                    var_dump($b . ':' . $cnt . PHP_EOL . implode(PHP_EOL, $a));
                    $result [$z] [$y] [$x] = 1;
                }
            }
        }
    }

    return $result;
}