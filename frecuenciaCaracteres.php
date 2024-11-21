<?php
function frecuenciaCaracteres($cadena) {
    $frecuencia = []; // Array para almacenar la frecuencia de los caracteres

    // Recorrer cada carácter de la cadena
    for ($i = 0; $i < strlen($cadena); $i++) {
        $caracter = $cadena[$i];

        // Verificar si el carácter ya está en el array de frecuencia
        if (isset($frecuencia[$caracter])) {
            // Si ya existe, incrementar el contador
            $frecuencia[$caracter]++;
        } else {
            // Si no existe, agregarlo con un contador inicial de 1
            $frecuencia[$caracter] = 1;
        }
    }

    return $frecuencia; // Devolver el array de frecuencias
}

// Ejemplo de uso
$texto = "programacion"; // Cambia este valor para probar otras cadenas
$resultado = frecuenciaCaracteres($texto);

// Mostrar el resultado
echo "Frecuencia de caracteres en \"$texto\":<br>";
foreach ($resultado as $caracter => $cantidad) {
    echo "Carácter '$caracter': $cantidad<br>";
}
?>
