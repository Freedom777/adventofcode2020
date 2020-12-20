<?php



function array_key_last($array) {
    $lastKey = key(array_slice($array, -1, 1, true));

    return $lastKey;
}
