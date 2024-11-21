<?php
// Función para imprimir una pirámide de asteriscos
function imprimirPiramide($altura) {
    // Bucle para las filas (altura de la pirámide)
    for ($i = 1; $i <= $altura; $i++) {
        // Bucle para los espacios en blanco antes de los asteriscos
        for ($j = 1; $j <= $altura - $i; $j++) {
            echo " "; // Imprime un espacio
        }
        
        // Bucle para imprimir los asteriscos
        for ($k = 1; $k <= (2 * $i - 1); $k++) {
            echo "*"; // Imprime un asterisco
        }
        
        // Salto de línea después de cada fila
        echo "<br>";
    }
}

// Ejemplo de uso
$altura = 5; // Define la altura de la pirámide
imprimirPiramide($altura); // Llama a la función para imprimir la pirámide
?>
