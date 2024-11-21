<?php
// Función para invertir un array
function invertirArray($array) {
    // Usamos la función array_reverse para invertir el array
    return array_reverse($array);
}

// Ejemplo de uso
$numeros = [1, 2, 3, 4, 5]; // Array de números
$numerosInvertidos = invertirArray($numeros); // Invertimos el array

// Imprimimos el array invertido
echo "Array original: " . implode(", ", $numeros) . "<br>";
echo "Array invertido: " . implode(", ", $numerosInvertidos);
?>
