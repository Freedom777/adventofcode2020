<?php


$data = file('input.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
/*$data = [
    'mask = 000000000000000000000000000000X1001X',
    'mem[42] = 100',
    'mask = 00000000000000000000000000000000X0XX',
    'mem[26] = 1',
];*/
$mem = [];


foreach ($data as $item) {
    list($operation, $value) = explode(' = ', $item);

    switch (substr($operation, 0, 4)) {
        case 'mask':
            $curMask = array_reverse(str_split($item));
            break;
        case 'mem[':
            $unmaskedIdx = (int)substr($operation, 4, -1);
            $maskedIdx = [];

            $value = (int)$value;
            for ($i = 0, $cnt = sizeof($curMask); $i < $cnt; $i++) {
                $curMultiplier = pow(2, $i);

                switch ($curMask[$i]) {
                    case '0':
                        if ($curMultiplier & $unmaskedIdx) {
                            $maskedIdx [$i] = '1';
                        } else {
                            $maskedIdx [$i] = '0';
                        }
                        break;
                    case '1':
                        $maskedIdx [$i] = '1';
                        break;
                    case 'X':
                        $maskedIdx [$i] = 'X';
                    break;
                }
            }

            $maskedDigits = array_count_values($maskedIdx)['X'];
            $addresses = [];
            if (empty($maskedDigits)) {
                $maskedStr = implode('', array_reverse($maskedIdx));
                $addresses = [intval($maskedStr, 2)];
            } else {
                $xpos = [];
                $i = 0;
                foreach ($maskedIdx as $key => $val) {
                    if ($val == 'X') {
                        $xpos [] = $key;
                    }
                }

                for ($i = 0, $cnt = pow(2, $maskedDigits);$i < $cnt;$i++) {
                    $address = [];
                    $multiplierIdx = 0;
                    for($j = 0, $cntj = sizeof($maskedIdx); $j < $cntj;$j++) {
                        if ($maskedIdx[$j] != 'X') {
                            $address [] = $maskedIdx[$j];
                        } else {
                            $curMultiplier = pow(2, $multiplierIdx++);
                            $address [] = ($i & $curMultiplier) ? '1' : '0';
                        }
                    }

                    $addresses [] = intval(implode('', array_reverse($address)), 2);
                }
            }

            foreach ($addresses as $address) {
                if (!isset($mem [$address])) {
                    $mem [$address] = 0;
                }
                $mem [$address] = $value;
            }

            break;
    }

}

var_dump(array_sum($mem));
die();


function addPV($array){
    $sum = 0;
    foreach($array as $key => $a){
        if (is_array($a)){
            $sum += addPV($a);
        }else {
            $sum += $a;
        }
    }
    return $sum;
}