<?php


$data = file('input.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

define('GROUND', 0);
define('BUSY', 1);
define('FREE', 2);

define('BUSY_CNT', 5);

array_walk($data, function (&$item) {
    $item = str_split(trim($item));
    foreach ($item as &$char) {
        if ($char == 'L') {
            $char = FREE;
        } else {
            $char = GROUND;
        }
    }
});

define('ROWS', sizeof($data));
define('COLUMNS', sizeof($data[0]));
define('CHECK', [
    [-1, -1],
    [0, -1],
    [1, -1],
    [-1, 0],
    [1, 0],
    [-1, 1],
    [0, 1],
    [1, 1]
]);

$state = [];
for ($row = 0; $row < ROWS; $row++) {
    $state [$row] = array_fill(0, COLUMNS, GROUND);
}

// var_dump($data);
$flag = true;
while ($flag) {
    $flag = false;
    for ($row = 0; $row < ROWS; $row++) {
        for ($column = 0; $column < COLUMNS; $column++) {
            switch ($data [$row] [$column]) {
                case FREE:
                    if (analyzeFree($data, $row, $column)) {
                        $flag = true;
                        $state [$row] [$column] = BUSY;
                    }
                    break;
                case BUSY:
                    if (analyzeBusy($data, $row, $column)) {
                        $flag = true;
                        $state [$row] [$column] = FREE;
                    }
                    break;
            }
        }
    }
    $data = $state;
}

$cnt = 0;
for ($row = 0; $row < ROWS; $row++) {
    for ($column = 0; $column < COLUMNS; $column++) {
        if ($data [$row] [$column] == BUSY) {
            ++$cnt;
        }
    }
}
var_dump($cnt);

function analyzeFree($data, $row, $column)
{
    $x = $column;
    $place = GROUND;
    while (--$x >= 0 && $place == GROUND) {
        if ($data [$row] [$x] != GROUND) {
            if ($data [$row] [$x] == BUSY) {
                return false;
            }
            $place = $data [$row] [$x];
        }
    }

    $x = $column;
    $place = GROUND;
    while (++$x < COLUMNS && $place == GROUND) {
        if ($data [$row] [$x] != GROUND) {
            if ($data [$row] [$x] == BUSY) {
                return false;
            }
            $place = $data [$row] [$x];
        }
    }

    $y = $row;
    $place = GROUND;
    while (--$y >= 0 && $place == GROUND) {
        if ($data [$y] [$column] != GROUND) {
            if ($data [$y] [$column] == BUSY) {
                return false;
            }
            $place = $data [$y] [$column];
        }
    }

    $y = $row;
    $place = GROUND;
    while (++$y < ROWS && $place == GROUND) {
        if ($data [$y] [$column] != GROUND) {
            if ($data [$y] [$column] == BUSY) {
                return false;
            }
            $place = $data [$y] [$column];
        }
    }

    $x = $column;
    $y = $row;
    $place = GROUND;
    while (--$x >= 0 && --$y >= 0 && $place == GROUND) {
        if ($data [$y] [$x] != GROUND) {
            if ($data [$y] [$x] == BUSY) {
                return false;
            }
            $place = $data [$y] [$x];
        }
    }

    $x = $column;
    $y = $row;
    $place = GROUND;
    while (--$x >= 0 && ++$y < ROWS && $place == GROUND) {
        if ($data [$y] [$x] != GROUND) {
            if ($data [$y] [$x] == BUSY) {
                return false;
            }
            $place = $data [$y] [$x];
        }
    }

    $x = $column;
    $y = $row;
    $place = GROUND;
    while (++$x < COLUMNS && ++$y < ROWS && $place == GROUND) {
        if ($data [$y] [$x] != GROUND) {
            if ($data [$y] [$x] == BUSY) {
                return false;
            }
            $place = $data [$y] [$x];
        }
    }

    $x = $column;
    $y = $row;
    $place = GROUND;
    while (++$x < COLUMNS && --$y >= 0 && $place == GROUND) {
        if ($data [$y] [$x] != GROUND) {
            if ($data [$y] [$x] == BUSY) {
                return false;
            }
            $place = $data [$y] [$x];
        }
    }

    return true;
}

function analyzeBusy($data, $row, $column)
{
    $cnt = 0;

    $x = $column;
    $place = GROUND;
    while (--$x >= 0 && $place == GROUND) {
        if ($data [$row] [$x] != GROUND) {
            if ($data [$row] [$x] == BUSY) {
                ++$cnt;
            }
            $place = $data [$row] [$x];
        }
    }

    $x = $column;
    $place = GROUND;
    while (++$x < COLUMNS && $place == GROUND) {
        if ($data [$row] [$x] != GROUND) {
            if ($data [$row] [$x] == BUSY) {
                ++$cnt;
            }
            $place = $data [$row] [$x];
        }
    }

    $y = $row;
    $place = GROUND;
    while (--$y >= 0 && $place == GROUND) {
        if ($data [$y] [$column] != GROUND) {
            if ($data [$y] [$column] == BUSY) {
                ++$cnt;
            }
            $place = $data [$y] [$column];
        }
    }

    $y = $row;
    $place = GROUND;
    while (++$y < ROWS && $place == GROUND) {
        if ($data [$y] [$column] != GROUND) {
            if ($data [$y] [$column] == BUSY) {
                ++$cnt;
            }
            $place = $data [$y] [$column];
        }
    }

    $x = $column;
    $y = $row;
    $place = GROUND;
    while (--$x >= 0 && --$y >= 0 && $place == GROUND) {
        if ($data [$y] [$x] != GROUND) {
            if ($data [$y] [$x] == BUSY) {
                ++$cnt;
            }
            $place = $data [$y] [$x];
        }
    }
    if ($cnt == BUSY_CNT) {
        return true;
    }

    $x = $column;
    $y = $row;
    $place = GROUND;
    while (--$x >= 0 && ++$y < ROWS && $place == GROUND) {
        if ($data [$y] [$x] != GROUND) {
            if ($data [$y] [$x] == BUSY) {
                ++$cnt;
            }
            $place = $data [$y] [$x];
        }
    }
    if ($cnt == BUSY_CNT) {
        return true;
    }

    $x = $column;
    $y = $row;
    $place = GROUND;
    while (++$x < COLUMNS && ++$y < ROWS && $place == GROUND) {
        if ($data [$y] [$x] != GROUND) {
            if ($data [$y] [$x] == BUSY) {
                ++$cnt;
            }
            $place = $data [$y] [$x];
        }
    }
    if ($cnt == BUSY_CNT) {
        return true;
    }

    $x = $column;
    $y = $row;
    $place = GROUND;
    while (++$x < COLUMNS && --$y >= 0 && $place == GROUND) {
        if ($data [$y] [$x] != GROUND) {
            if ($data [$y] [$x] == BUSY) {
                ++$cnt;
            }
            $place = $data [$y] [$x];
        }
    }
    if ($cnt == BUSY_CNT) {
        return true;
    }

    return false;
}