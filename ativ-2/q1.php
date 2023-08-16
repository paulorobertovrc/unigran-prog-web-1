<?php

// MATRIZES QUADRADAS
//$a = array(
//    array(1, 2, 3),
//    array(4, 5, 6),
//    array(7, 8, 9)
//);
//
//$b = array(
//    array(1, 2, 3),
//    array(4, 5, 6),
//    array(7, 8, 9)
//);


// MATRIZES NÃO QUADRADAS
$a = array(
    array(2, 0, 1),
    array(5, 3, 2),
    array(1, 1, 1),
    array(7, 11, 5)
);

$b = array(
    array(4, 3, 8, 17),
    array(1, 2, 0, 1),
    array(0, 6, 3, 2)
);

$ab = array();

if (count($a[0]) != count($b)) {
    echo "Não é possível multiplicar as matrizes!";
    exit;
}

for ($i = 0; $i < count($a); $i++) {
    for ($j = 0; $j < count($a); $j++) {
        $ab[$i][$j] = 0;
        for ($k = 0; $k < count($a[0]); $k++) {
            $ab[$i][$j] += $a[$i][$k] * $b[$k][$j];
        }
    }
}

print_r($ab);
