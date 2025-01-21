<?php
require_once 'funciones.php';
verificarAcceso('admin');

// Configuración de la conexión a la base de datos
$conn = new mysqli("localhost", "root", "", "clinica_dental");
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

// Variables de filtro
$filtro_usuario = isset($_GET['usuario']) ? $_GET['usuario'] : '';

// Configuración para la paginación
$registros_por_pagina = 10;
$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$inicio = ($pagina > 1) ? ($pagina * $registros_por_pagina) - $registros_por_pagina : 0;

// Consulta principal con filtro
$sql_filtro = $filtro_usuario ? "WHERE usuario LIKE '%$filtro_usuario%'" : '';
$sql = "SELECT SQL_CALC_FOUND_ROWS * FROM auditoria $sql_filtro ORDER BY fecha DESC LIMIT $inicio, $registros_por_pagina";
$result = $conn->query($sql);

// Total de registros y cálculo de páginas
$total_resultados = $conn->query("SELECT FOUND_ROWS() AS total")->fetch_assoc()['total'];
$total_paginas = ceil($total_resultados / $registros_por_pagina);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auditoría</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">DentalSys</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="auditoria.php">Auditoría</a>
                    </li>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Cerrar Sesión</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="configuracion.php">Volver a Configuracion</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h1 class="text-center my-4">Auditoría de Acciones</h1>

        <!-- Formulario de filtro -->
        <form method="GET" class="mb-3">
            <div class="row">
                <div class="col-md-4">
                    <input type="text" name="usuario" class="form-control" placeholder="Buscar por usuario" value="<?= htmlspecialchars($filtro_usuario) ?>">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">Filtrar</button>
                </div>
            </div>
        </form>

        <!-- Tabla de auditoría -->
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Usuario</th>
                    <th>Rol</th>
                    <th>Acción</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['usuario'] ?></td>
                    <td><?= $row['rol'] ?></td>
                    <td><?= $row['accion'] ?></td>
                    <td><?= $row['fecha'] ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <!-- Paginación -->
        <nav>
            <ul class="pagination justify-content-center">
                <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
                <li class="page-item <?= $pagina === $i ? 'active' : '' ?>">
                    <a class="page-link" href="auditoria.php?pagina=<?= $i ?>&usuario=<?= urlencode($filtro_usuario) ?>"><?= $i ?></a>
                </li>
                <?php endfor; ?>
            </ul>
        </nav>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
