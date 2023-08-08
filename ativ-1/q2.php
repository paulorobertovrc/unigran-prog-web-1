<?php

// Crie um código em PHP que definido um array $arr de n números inteiros, determinar a soma dos números pares.
//Ex: $arr = array(1,2,3,4,5,6,7,8,9,10);

echo "Informe o tamanho do array: ";
$tamanho = readline();

$array = array();
for ($i = 0; $i < $tamanho; $i++) {
    $array[$i] = $i + 1;
}

$soma = 0;
for ($i = 0; $i < $tamanho; $i++) {
    if ($array[$i] % 2 == 0) {
        $soma += $array[$i];
    }
}

echo "A soma dos números pares é: $soma";
?>
