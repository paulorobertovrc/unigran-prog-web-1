<?php
$arquivo = fopen('numeros.txt', 'r') or die('Não foi possível abrir o arquivo!');

$linhas = [];
while (!feof($arquivo)) {
    $linhas[] = fgets($arquivo);
}

fclose($arquivo);

$soma = 0;
foreach ($linhas as $linha) {
    $soma += $linha;
}

echo "A soma dos valores é $soma";
