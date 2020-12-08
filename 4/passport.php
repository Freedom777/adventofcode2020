<?php

$data = file_get_contents('input.txt');
$ar = explode(PHP_EOL . PHP_EOL, $data);
$correct = 0;
foreach ($ar as $passport) {
    $passport = str_replace(PHP_EOL, ' ', $passport);
    $fields = explode(' ', $passport);
    $valid = FALSE;
    if (sizeof($fields) == 8){
        $valid = TRUE;
    } elseif(sizeof($fields) == 7) {
        foreach ($fields as $field) {
            if (substr(trim($field), 0,3) == 'cid') {
                $valid = FALSE;
                break;
            }
            $valid = TRUE;
        }
    }
    if ($valid) {
        ++$correct;
    }
}
var_dump($ar[sizeof($ar)-1]);
echo PHP_EOL . $correct . '/' . sizeof($ar) . PHP_EOL;