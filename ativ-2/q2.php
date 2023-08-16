<?php

$primos = array();
$num = 2; // Por definição, um número é primo se for maior do que 1 e divisível apenas por 1 e por ele mesmo.

while (count($primos) <= 20) { // Limita aos 20 primeiros números primos.

    $divisores = 0;

    for ($i = 1; $i <= $num; $i++) {
        if ($num % $i == 0) {
            $divisores++;
        }
    }

    if ($divisores == 2) {
        $primos[] = $num;
    }

    $num++;
}

$arquivo = fopen("numeros.txt", "w");
foreach ($primos as $primo) {
    fwrite($arquivo, $primo . "\n");
}

fclose($arquivo);
