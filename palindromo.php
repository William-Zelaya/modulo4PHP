<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificador de Palíndromos</title>
</head>
<body>
    <h1>¿Es un palíndromo?</h1>
    <form method="POST">
        <label for="cadena">Ingresa una palabra o frase:</label>
        <input type="text" id="cadena" name="cadena" required>
        <button type="submit">Verificar</button>
    </form>

    <?php
    function esPalindromo($cadena) {
        // Eliminar espacios y convertir a minúsculas para asegurar uniformidad
        $cadena = strtolower(str_replace(' ', '', $cadena));
        
        // Invertir la cadena
        $cadenaInvertida = strrev($cadena);
        
        // Comparar la cadena original con la invertida
        return $cadena === $cadenaInvertida;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["cadena"])) {
        $texto = $_POST["cadena"];
        if (esPalindromo($texto)) {
            echo "<p>\"$texto\" es un palíndromo.</p>";
        } else {
            echo "<p>\"$texto\" no es un palíndromo.</p>";
        }
    }
    ?>
</body>
</html>
