<?php

$data = file_get_contents('input.txt');
$ar = explode(PHP_EOL . PHP_EOL, $data);
$correct = 0;
$fieldsList = ['byr', 'iyr', 'eyr', 'hgt', 'hcl', 'ecl', 'pid', 'cid'];

foreach ($ar as $passport) {
    $passport = str_replace(PHP_EOL, ' ', $passport);
    $fields = explode(' ', $passport);
    $valid = FALSE;
    $values = [];
    foreach ($fields as $field) {
        if (!empty($field)) {
            $tmp = explode(':', $field);
            $values [trim($tmp[0])] = trim($tmp[1]);
        }
    }

    if (validate($values)) {
        ++$correct;
    }
}
echo PHP_EOL . $correct . '/' . sizeof($ar) . PHP_EOL;

function validate_number($value, $cnt) {
    if (preg_match('#[\d]{'.$cnt.'}#', $value)) {
        return TRUE;
    }
    return FALSE;
}

function validate_eye($value) {
    $eye_colors = ['amb', 'blu', 'brn', 'gry', 'grn', 'hzl', 'oth'];
    if (in_array($value, $eye_colors)) {
        return TRUE;
    }
    return FALSE;
}

function validate_height($value) {
    $type = substr($value, -2);
    $value = substr($value, 0,-2);
    switch ($type) {
        case 'cm':
            if ($value >= 150 && $value <= 193) {
                return TRUE;
            }
            break;
        case 'in':
            if ($value >= 59 && $value <= 76) {
                return TRUE;
            }
            break;
    }
    return FALSE;
}

function validate($values) {
    $valid = 0;
    foreach ($values as $field => $value) {
        switch ($field) {
            case 'byr':
                if (validate_number($value, 4) && $value >= 1920 && $value <= 2002) {
                    ++$valid;
                }
                break;
            case 'iyr':
                if (validate_number($value, 4) && $value >= 2010 && $value <= 2020) {
                    ++$valid;
                }
                break;
            case 'eyr':
                if (validate_number($value, 4) && $value >= 2020 && $value <= 2030) {
                    ++$valid;
                }
                break;
            case 'hgt':
                if (validate_height($value)) {
                    ++$valid;
                }
                break;
            case 'hcl':
                if (preg_match('/#[a-f0-9]{6}/', $value)) {
                ++$valid;
            }
            break;
            case 'ecl':
                if (validate_eye($value)) {
                    ++$valid;
                }
                break;
            case 'pid':
                if (is_numeric($value) && strlen($value) == 9) {
                    ++$valid;
                }
                break;
        }
    }
    if ($valid >= 7) {
        return TRUE;
    }
    return FALSE;
}