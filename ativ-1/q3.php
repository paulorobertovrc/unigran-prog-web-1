<?php
// Crie um código em PHP que dados dois números inteiros $x e $y positivos, retornar o máximo divisor comum
// entre eles usando o algoritmo de Euclides.

echo "Informe o primeiro número: ";
$x = readline();
$x_inicial = $x;

echo "Informe o segundo número: ";
$y = readline();
$y_inicial = $y;

while ($y != 0) {
    $resto = $x % $y;
    $x = $y;
    $y = $resto;
}

echo "O máximo divisor comum dos números ($x_inicial, $y_inicial) é $x";
?>
