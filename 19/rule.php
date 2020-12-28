<?php

$data = file('test.txt', FILE_IGNORE_NEW_LINES);

$flag = false;

$ar = [];
$chars = [];
$i = 0;
while (!empty($data [$i])) {
    list($ruleNum, $rules) = explode(':', $data [$i]);
    $ors = explode('|', $rules);

    foreach ($ors as $key => $or) {
        $ruleNumbers = explode(' ', trim($or));
        if (preg_match('"([a-z])"', $or, $matches)) {
            $chars [$i] [] = $matches [1];
        } else {
            $ar [$i] [$key] = $ruleNumbers;
        }
    }
    ++$i;
}

/*var_dump($ar);
var_dump($chars);
die();*/
while (!empty($ar)) {
    foreach ($ar as $key => $ors) {
        $count = 0;
        $cnt = 0;
        $tmp = [];
        foreach ($ors as $o => $or) {
            // $tmp [$o] = '';
            foreach ($or as $num) {
                ++$count;
                if (is_numeric($num) && in_array($num, array_keys($chars))) {
                    ++$cnt;
                    // $tmp [$o] .= $chars [$num];
                }
            }
        }

        if ($cnt == $count) {
            $tmp = [];
            $vars = [];
            $result = [];
            $i = 0;
            foreach ($ors as $o => $or) {
                $vars [$o] = [];
                foreach ($or as $op => $num) {



                    // $vars [$i] = '';
                    foreach ($chars[$num] as $c => $cur) {
                        if (!isset($vars [$o] [$c])) {
                            $vars [$o] [$c] = '';
                        }
                        $vars [$o] [$c] .= $cur;
                    }

                    // ++$i;
                }
            }
            foreach ($vars as $var) {
                $result = array_merge($result, $var);
            }


            $chars [$key] = $result;
            unset($ar [$key]);
        }
    }
}

// var_dump($chars [0]);
var_dump($chars);
die();



foreach ($data as $row) {
    if (!empty($row)) {

    } else {
        $flag = true;
    }

}