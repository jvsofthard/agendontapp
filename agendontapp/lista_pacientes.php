<?php
include 'conexion.php';

// Número de pacientes por página
$registros_por_pagina = 10;

// Obtener el número total de pacientes
$query_total = "SELECT COUNT(*) AS total FROM pacientes";
$result_total = $conn->query($query_total);
$row_total = $result_total->fetch_assoc();
$total_registros = $row_total['total'];

// Calcular el número total de páginas
$total_paginas = ceil($total_registros / $registros_por_pagina);

// Obtener la página actual (si no existe, por defecto será la página 1)
$pagina_actual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
if ($pagina_actual < 1) $pagina_actual = 1;

// Calcular el punto de inicio para la consulta SQL
$inicio = ($pagina_actual - 1) * $registros_por_pagina;

// Obtener los pacientes con paginación
$query = "SELECT * FROM pacientes ORDER BY nombre ASC LIMIT $inicio, $registros_por_pagina";
$result = $conn->query($query);




// Consulta para obtener pacientes con la edad calculada
$query = "
    SELECT id_paciente, nombre, telefono, correo, fecha_nacimiento, sexo, seguro_medico,
           TIMESTAMPDIFF(YEAR, fecha_nacimiento, CURDATE()) AS edad
    FROM pacientes
";

$result = $conn->query($query);

//acceso admin, recepcionista
session_start();
if (!isset($_SESSION['rol']) || !in_array($_SESSION['rol'], ['admin', 'recepcionista'])) {
    echo "No tienes permiso para acceder a esta página.";
    exit;
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Pacientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">DentalSys</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link active" href="lista_pacientes.php">Pacientes</a></li>
                    <li class="nav-item"><a class="nav-link" href="lista_citas.php">Citas</a></li>
                    <li class="nav-item"><a class="nav-link" href="lista_especialistas.php">Especialistas</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h1 class="text-center">Lista de Pacientes</h1>


    <!-- Botón de Exportar -->
        <form method="POST" action="exportar_pacientes.php">
            <button type="submit" class="btn btn-success">Exportar a CSV</button>
        </form>
    <!--         -->



        <?php if ($result->num_rows > 0): ?>
            <table class="table table-bordered table-striped mt-4">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Teléfono</th>
                        <th>Correo</th>
                     <!--   <th>Dirección</th> -->
                        <th>Fecha de Nacimiento</th>
                        <th>Edad</th>
                        <th>Sexo</th>
                        <th>No. Seguro Médico</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['id_paciente']; ?></td>
                            <td><?= $row['nombre']; ?></td>
                            <td><?= $row['telefono']; ?></td>
                            <td><?= $row['correo']; ?></td>
                      <!--   <td><?= $row['direccion']; ?></td> -->
                            <td><?= $row['fecha_nacimiento']; ?></td>
                            <td><?= $row['edad']; ?></td>
                            <td><?= $row['sexo']; ?></td>
                            <td><?= $row['seguro_medico']; ?></td>
                            <td>
                                <a href="editar_paciente.php?id=<?= $row['id_paciente']; ?>" class="btn btn-sm btn-warning">Editar</a>
                                <a href="eliminar_paciente.php?id=<?= $row['id_paciente']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar este paciente?')">Eliminar</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert alert-info text-center">No hay pacientes registrados.</div>
        <?php endif; ?>

        <!-- Paginación -->
        <nav>
            <ul class="pagination justify-content-center">
                <!-- Botón para ir a la primera página -->
                <?php if ($pagina_actual > 1): ?>
                    <li class="page-item"><a class="page-link" href="lista_pacientes.php?pagina=1">Primera</a></li>
                    <li class="page-item"><a class="page-link" href="lista_pacientes.php?pagina=<?= $pagina_actual - 1; ?>">Anterior</a></li>
                <?php endif; ?>

                <!-- Números de página -->
                <?php
                $rango_paginas = 2; // Páginas visibles a la izquierda y derecha de la actual
                $inicio_paginacion = max(1, $pagina_actual - $rango_paginas);
                $fin_paginacion = min($total_paginas, $pagina_actual + $rango_paginas);

                for ($i = $inicio_paginacion; $i <= $fin_paginacion; $i++): ?>
                    <li class="page-item <?= $i == $pagina_actual ? 'active' : ''; ?>">
                        <a class="page-link" href="lista_pacientes.php?pagina=<?= $i; ?>"><?= $i; ?></a>
                    </li>
                <?php endfor; ?>

                <!-- Botón para ir a la última página -->
                <?php if ($pagina_actual < $total_paginas): ?>
                    <li class="page-item"><a class="page-link" href="lista_pacientes.php?pagina=<?= $pagina_actual + 1; ?>">Siguiente</a></li>
                    <li class="page-item"><a class="page-link" href="lista_pacientes.php?pagina=<?= $total_paginas; ?>">Última</a></li>
                <?php endif; ?>
            </ul>
        </nav>

        <a href="registrar_paciente.php" class="btn btn-primary mt-3">Registrar Nuevo Paciente</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>



</html>
