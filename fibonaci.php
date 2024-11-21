<?php
// Función para generar la serie Fibonacci
function generarFibonacci($n) {
    // Validar que el parámetro $n sea un número entero positivo
    if ($n <= 0) {
        return "El número de términos debe ser mayor a 0.";
    }

    // Crear un array para almacenar los términos de la serie
    $fibonacci = [];

    // Caso especial para el primer término
    if ($n >= 1) {
        $fibonacci[] = 0; // Primer término
    }

    // Caso especial para el segundo término
    if ($n >= 2) {
        $fibonacci[] = 1; // Segundo término
    }

    // Calcular el resto de los términos si $n > 2
    for ($i = 2; $i < $n; $i++) {
        $fibonacci[] = $fibonacci[$i - 1] + $fibonacci[$i - 2];
    }

    // Retornar la serie como una cadena de texto
    return implode(", ", $fibonacci);
}

// Ejemplo de uso
$n = 10; // Número de términos deseados
echo "Los primeros $n términos de la serie Fibonacci son: " . generarFibonacci($n);
?>
