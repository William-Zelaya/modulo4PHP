<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generador de Números Primos</title>
</head>
<body>
    <h1>Generador de Números Primos</h1>
    <form method="POST">
        <label for="limite">Ingresa el límite máximo:</label>
        <input type="number" id="limite" name="limite" required>
        <button type="submit">Generar</button>
    </form>

    <?php
    function esPrimo($numero) {
        if ($numero < 2) {
            return false;
        }
        for ($i = 2; $i <= sqrt($numero); $i++) {
            if ($numero % $i == 0) {
                return false;
            }
        }
        return true;
    }

    function generarNumerosPrimos($limite) {
        $primos = [];
        for ($i = 2; $i <= $limite; $i++) {
            if (esPrimo($i)) {
                $primos[] = $i; // Agregar el número primo al arreglo
            }
        }
        return $primos;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["limite"])) {
        $limite = intval($_POST["limite"]); // Convertir a entero
        $numerosPrimos = generarNumerosPrimos($limite);

        echo "<h2>Números primos hasta $limite:</h2>";
        echo "<p>" . implode(", ", $numerosPrimos) . "</p>";
    }
    ?>
</body>
</html>
