<?php


/*define('DATA', [
0 => 0,
1 => 1,
2 => 2,
3 => 3,
4 => 4,
7 => 7,
10 => 10,
11 => 11,
12 => 12,
13 => 13,
16 => 16,
19 => 19,
20 => 20,
21 => 21,
22 => 22,
25 => 25,
26 => 26,
27 => 27,
30 => 30,
33 => 33,
34 => 34,
35 => 35,
38 => 38,
41 => 41,
44 => 44,
45 => 45,
46 => 46,
47 => 47,
48 => 48,
51 => 51,
52 => 52,
55 => 55,
58 => 58,
59 => 59,
60 => 60,
61 => 61,
64 => 64,
67 => 67,
68 => 68,
71 => 71,
72 => 72,
73 => 73,
74 => 74,
77 => 77,
78 => 78,
79 => 79,
80 => 80,
83 => 83,
86 => 86,
87 => 87,
88 => 88,
89 => 89,
90 => 90,
93 => 93,
94 => 94,
95 => 95,
98 => 98,
99 => 99,
100 => 100,
101 => 101,
102 => 102,
105 => 105,
108 => 108,
109 => 109,
110 => 110,
113 => 113,
114 => 114,
115 => 115,
118 => 118,
119 => 119,
120 => 120,
121 => 121,
122 => 122,
125 => 125,
128 => 128,
129 => 129,
130 => 130,
131 => 131,
132 => 132,
135 => 135,
136 => 136,
137 => 137,
138 => 138,
139 => 139,
142 => 142,
143 => 143,
144 => 144,
145 => 145,
148 => 148,
151 => 151,
152 => 152,
153 => 153,
154 => 154,
157 => 157,
160 => 160,
161 => 161,
162 => 162,
163 => 163,
166 => 166,
167 => 167,
168 => 168,
169 => 169,
172 => 172,
173 => 173,
174 => 174,
177 => 177,
178 => 178,
179 => 179,
180 => 180,
181 => 181,
184 => 184,
187 => 187,
190 => 190,
191 => 191,
192 => 192,
195 => 195,
]);*/

define('DATA', [
    1 => 1,
    2 => 1,
    3 => 1,
    4 => 1,
    5 => 1,
    6 => 1,
    7 => 1,
    8 => 1,
    9 => 1,
    10 => 1,
    11 => 1,
    12 => 1,
    /*
    15 => 1,
    16 => 1,
    19 => 1,
    22 => 22,*/
]);
$paths = [0 => 0];
$cool = 0;
define('DATALEN', sizeof(DATA));
define('BUILTIN', max(array_keys(DATA)));

define('MULTIPLIER', (int)(BUILTIN / 3));


foreach (DATA as $value) {
    $newIter = [];
    foreach ($paths as $sum) {
        $successAr = [];
        for ($step = 1; $step <= 3; ++$step) {
            $curSum = $sum + $step;
            if (isset(DATA[$curSum])) {
                if ($curSum != BUILTIN) {
                    $successAr [] = $curSum;
                } else {
                    ++$cool;
                }
            }
        }
        $newIter = array_merge($newIter, $successAr);
    }
    $paths = $newIter;
}
$availCombs = pow(3, round(sizeof(DATA) / 2)) + sizeof(DATA) * 3 + 1;
var_dump($availCombs);
var_dump($cool);
die();


$availCombs = pow(3, floor(sizeof(DATA) / 2)) + sizeof(DATA) * 3 + 1;
var_dump($availCombs);
die();
define('DATALEN', sizeof(DATA));
define('BUILTIN', max(array_keys(DATA)));

$paths = [0 => 0];
$cool = 0;
// 4

foreach (DATA as $value) {
    $newIter = [];
    foreach ($paths as $sum) {
        $successAr = [];
        for ($step = 1; $step <= 3; ++$step) {
            $curSum = $sum + $step;
            if (isset(DATA[$curSum])) {
                if ($curSum != BUILTIN) {
                    $successAr [] = $curSum;
                } else {
                    ++$cool;
                }
            }
        }
        $newIter = array_merge($newIter, $successAr);
    }
    $paths = $newIter;
}

var_dump($cool);
die();

$cnt = 0;
foreach (DATA as $key => $value) {
    switch ($key % 3) {
        case 0:
            $cnt += 1;
            break;
        case 1:
            $cnt += 2;
            break;
        case 2:
            $cnt += 3;
            break;
    }
}
var_dump($cnt);
die();


$i = 1;
$cnt = 0;
$maxValue = max(array_keys(DATA));
for ($i = 1; $i <= $maxValue; $i++) {
    if (!isset(DATA[$i])) {
        ++$cnt;
    }
}
var_dump($cnt . '/' . $maxValue);
die();

define('BUILTIN', max(array_keys(DATA)));

$paths = [0 => 0];
$cool = 0;

foreach (DATA as $value) {
    $newIter = [];
    foreach ($paths as $sum) {
        $successAr = [];

        for ($curSum = $sum + 1; $curSum <= $sum + 3; ++$curSum) {
            if (isset(DATA[$curSum])) {
                if ($curSum != BUILTIN) {
                    $successAr [] = $curSum;
                } else {
                    ++$cool;
                }
            }
        }
        $newIter = array_merge($newIter, $successAr);
    }
    $paths = $newIter;
}

var_dump($cool);