<?php
// Crie um código em PHP que dado um array $arr contendo um número na base binária, transformá-lo para a
// base decimal. Ex: $arr = array(1,1,1,0,0,0,1)

echo "Informe um número binário: ";
$binario = readline();

$decimal = 0;
$expoente = 0;

for ($i = strlen($binario) - 1; $i >= 0; $i--) {
    $resultado = $binario[$i] * pow(2, $expoente);
    $decimal += $resultado;
    $expoente++;
}

echo "BINÁRIO: $binario\n";
echo "DECIMAL: $decimal";
?>
