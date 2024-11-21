<?php
// Función para sumar los números pares en un array
function sumaNumerosPares($array) {
    $suma = 0;
    foreach ($array as $numero) {
        if ($numero % 2 == 0) {
            $suma += $numero; // Sumar el número si es par
        }
    }
    return $suma;
}

// Ejemplo de uso
$numeros = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]; // Array de números
$sumaPares = sumaNumerosPares($numeros); // Sumar los números pares

// Imprimir el resultado
echo "La suma de los números pares en el array es: " . $sumaPares;
?>
