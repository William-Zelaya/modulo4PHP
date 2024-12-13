<?php

// Clase Libro
class Libro {
    private $id;
    private $titulo;
    private $autor;
    private $categoria;
    private $estado;

    public function __construct($id, $titulo, $autor, $categoria, $estado = 'disponible') {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->categoria = $categoria;
        $this->estado = $estado;
    }

    public function getId() {
        return $this->id;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function getAutor() {
        return $this->autor;
    }

    public function getCategoria() {
        return $this->categoria;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function setAutor($autor) {
        $this->autor = $autor;
    }

    public function setCategoria($categoria) {
        $this->categoria = $categoria;
    }
}

// Clase Biblioteca
class Biblioteca {
    private $libros = [];

    public function agregarLibro(Libro $libro) {
        $this->libros[$libro->getId()] = $libro;
    }

    public function buscarLibro($valor) {
        $resultados = [];
        foreach ($this->libros as $libro) {
            if (stripos($libro->getTitulo(), $valor) !== false) {
                $resultados[] = $libro;
            }
        }
        return $resultados;
    }

    public function editarLibro($id, $nuevoTitulo = null, $nuevoAutor = null, $nuevaCategoria = null) {
        if (isset($this->libros[$id])) {
            $libro = $this->libros[$id];
            if ($nuevoTitulo) $libro->setTitulo($nuevoTitulo);
            if ($nuevoAutor) $libro->setAutor($nuevoAutor);
            if ($nuevaCategoria) $libro->setCategoria($nuevaCategoria);
        }
    }

    public function eliminarLibro($id) {
        unset($this->libros[$id]);
    }

    public function prestarLibro($id) {
        if (isset($this->libros[$id]) && $this->libros[$id]->getEstado() === 'disponible') {
            $this->libros[$id]->setEstado('prestado');
            return true;
        }
        return false;
    }

    public function devolverLibro($id) {
        if (isset($this->libros[$id]) && $this->libros[$id]->getEstado() === 'prestado') {
            $this->libros[$id]->setEstado('disponible');
            return true;
        }
        return false;
    }

    public function listarLibros() {
        return $this->libros;
    }
}

// Ejemplo de uso
$biblioteca = new Biblioteca();

// Manejo de libros predefinidos
$biblioteca->agregarLibro(new Libro(1, "El Quijote", "Miguel de Cervantes", "Novela"));
$biblioteca->agregarLibro(new Libro(2, "Cien Años de Soledad", "Gabriel García Márquez", "Realismo Mágico"));

// Procesar formularios
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['agregar'])) {
        $id = count($biblioteca->listarLibros()) + 1;
        $titulo = $_POST['titulo'];
        $autor = $_POST['autor'];
        $categoria = $_POST['categoria'];
        $biblioteca->agregarLibro(new Libro($id, $titulo, $autor, $categoria));
    }

    if (isset($_POST['eliminar'])) {
        $id = $_POST['id'];
        $biblioteca->eliminarLibro($id);
    }

    if (isset($_POST['actualizar'])) {
        $id = $_POST['id'];
        $titulo = $_POST['titulo'];
        $autor = $_POST['autor'];
        $categoria = $_POST['categoria'];
        $biblioteca->editarLibro($id, $titulo, $autor, $categoria);
    }
}

$librosAMostrar = $biblioteca->listarLibros();
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['buscar'])) {
    $busqueda = $_GET['buscar'];
    $librosAMostrar = $biblioteca->buscarLibro($busqueda);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Biblioteca</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <h1 class="text-center">Gestión de Biblioteca</h1>

        <!-- Formulario para agregar libros -->
        <form method="POST" class="my-4">
            <div class="row">
                <div class="col-md-3">
                    <input type="text" name="titulo" class="form-control" placeholder="Título" required>
                </div>
                <div class="col-md-3">
                    <input type="text" name="autor" class="form-control" placeholder="Autor" required>
                </div>
                <div class="col-md-3">
                    <input type="text" name="categoria" class="form-control" placeholder="Categoría" required>
                </div>
                <div class="col-md-3">
                    <button type="submit" name="agregar" class="btn btn-primary w-100">Agregar Libro</button>
                </div>
            </div>
        </form>

        <!-- Buscador de libros -->
        <form method="GET" class="my-4">
            <div class="row">
                <div class="col-md-10">
                    <input type="text" name="buscar" class="form-control" placeholder="Buscar por título" required>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-success w-100">Buscar</button>
                </div>
            </div>
        </form>

        <!-- Listado de libros -->
        <h2 class="my-4">Listado de Libros</h2>
        <table class="table table-striped" id="librosTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Categoría</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($librosAMostrar as $libro): ?>
                    <tr>
                        <td><?= $libro->getId(); ?></td>
                        <td><?= $libro->getTitulo(); ?></td>
                        <td><?= $libro->getAutor(); ?></td>
                        <td><?= $libro->getCategoria(); ?></td>
                        <td><?= $libro->getEstado(); ?></td>
                        <td>
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="id" value="<?= $libro->getId(); ?>">
                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#updateModal" onclick="setUpdateForm(<?= $libro->getId(); ?>, '<?= $libro->getTitulo(); ?>', '<?= $libro->getAutor(); ?>', '<?= $libro->getCategoria(); ?>')">Actualizar</button>
                                <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete(<?= $libro->getId(); ?>)">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Modal para Actualizar -->
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Actualizar Libro</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="id" id="updateId">
                        <div class="mb-3">
                            <label for="updateTitulo" class="form-label">Título</label>
                            <input type="text" class="form-control" id="updateTitulo" name="titulo" required>
                        </div>
                        <div class="mb-3">
                            <label for="updateAutor" class="form-label">Autor</label>
                            <input type="text" class="form-control" id="updateAutor" name="autor" required>
                        </div>
                        <div class="mb-3">
                            <label for="updateCategoria" class="form-label">Categoría</label>
                            <input type="text" class="form-control" id="updateCategoria" name="categoria" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" name="actualizar" class="btn btn-primary">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Confirmación de Eliminación -->
    <script>
        function confirmDelete(id) {
            if (confirm('¿Estás seguro de que deseas eliminar este libro?')) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.style.display = 'none';

                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'id';
                input.value = id;

                const deleteInput = document.createElement('input');
                deleteInput.type = 'hidden';
                deleteInput.name = 'eliminar';
                deleteInput.value = true;

                form.appendChild(input);
                form.appendChild(deleteInput);
                document.body.appendChild(form);
                form.submit();
            }
        }

        function setUpdateForm(id, titulo, autor, categoria) {
            document.getElementById('updateId').value = id;
            document.getElementById('updateTitulo').value = titulo;
            document.getElementById('updateAutor').value = autor;
            document.getElementById('updateCategoria').value = categoria;
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#librosTable').DataTable();
        });
    </script>
</body>
</html>
