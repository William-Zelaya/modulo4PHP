<?php
require_once 'class/libro.php';


// Crear una instancia de la biblioteca
$biblioteca = new Biblioteca();


// Listar libros
echo "<h1>Listado de Libros</h1>";
foreach ($biblioteca->listarLibros() as $libro) {
    echo "<p>Título: " . $libro->getTitulo() . ", Autor: " . $libro->getAutor() . "</p>";
}
?>
