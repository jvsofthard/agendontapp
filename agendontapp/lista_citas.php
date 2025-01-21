<?php
include 'conexion.php';


// acceso especialista
session_start();
if (!isset($_SESSION['rol']) || !in_array($_SESSION['rol'], ['admin', 'recepcionista'])) {
    echo "No tienes permiso para acceder a esta página.";
    exit;
}



// Número de citas por página
$registros_por_pagina = 10;

// Obtener el número total de citas
$query_total = "SELECT COUNT(*) AS total FROM citas";
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

// Obtener las citas con paginación
$query = "
    SELECT 
        citas.id_cita, 
        pacientes.nombre AS nombre_paciente, 
        citas.fecha, 
        citas.motivo, 
        citas.tipo_tratamiento,
        especialistas.nombre AS nombre_especialista
    FROM citas
    JOIN pacientes ON citas.id_paciente = pacientes.id_paciente
    JOIN especialistas ON citas.id_especialista = especialistas.id_especialista
    ORDER BY citas.fecha DESC
    LIMIT $inicio, $registros_por_pagina";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Citas</title>
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
                    <li class="nav-item"><a class="nav-link" href="lista_pacientes.php">Pacientes</a></li>
                    <li class="nav-item"><a class="nav-link active" href="lista_citas.php">Citas</a></li>
                    <li class="nav-item"><a class="nav-link" href="lista_especialistas.php">Especialistas</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h1 class="text-center">Lista de Citas</h1>


        <!-- Botón de Exportar -->
        <form method="POST" action="exportar_citas.php">
            <button type="submit" class="btn btn-success">Exportar a CSV</button>
        </form>
    <!--         -->


        <?php if ($result->num_rows > 0): ?>
            <table class="table table-bordered table-striped mt-4">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Paciente</th>
                        <th>Fecha</th>
                        <th>Especialista</th>
                        <th>Motivo</th>
                        <th>Tipo de tratamiento</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['id_cita']; ?></td>
                            <td><?= $row['nombre_paciente']; ?></td>
                            <td><?= date("d/m/Y H:i", strtotime($row['fecha'])); ?></td>
                            <td><?= $row['nombre_especialista']; ?></td>
                            <td><?= $row['motivo']; ?></td>
                            <td><?= $row['tipo_tratamiento']; ?></td>
                            <td>
                                <a href="editar_cita.php?id=<?= $row['id_cita']; ?>" class="btn btn-sm btn-warning">Editar</a>
                                <a href="eliminar_cita.php?id=<?= $row['id_cita']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar esta cita?')">Eliminar</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert alert-info text-center">No hay citas registradas.</div>
        <?php endif; ?>

        <!-- Paginación -->
        <nav>
            <ul class="pagination justify-content-center">
                <!-- Botón para ir a la primera página -->
                <?php if ($pagina_actual > 1): ?>
                    <li class="page-item"><a class="page-link" href="lista_citas.php?pagina=1">Primera</a></li>
                    <li class="page-item"><a class="page-link" href="lista_citas.php?pagina=<?= $pagina_actual - 1; ?>">Anterior</a></li>
                <?php endif; ?>

                <!-- Números de página -->
                <?php
                $rango_paginas = 2; // Páginas visibles a la izquierda y derecha de la actual
                $inicio_paginacion = max(1, $pagina_actual - $rango_paginas);
                $fin_paginacion = min($total_paginas, $pagina_actual + $rango_paginas);

                for ($i = $inicio_paginacion; $i <= $fin_paginacion; $i++): ?>
                    <li class="page-item <?= $i == $pagina_actual ? 'active' : ''; ?>">
                        <a class="page-link" href="lista_citas.php?pagina=<?= $i; ?>"><?= $i; ?></a>
                    </li>
                <?php endfor; ?>

                <!-- Botón para ir a la última página -->
                <?php if ($pagina_actual < $total_paginas): ?>
                    <li class="page-item"><a class="page-link" href="lista_citas.php?pagina=<?= $pagina_actual + 1; ?>">Siguiente</a></li>
                    <li class="page-item"><a class="page-link" href="lista_citas.php?pagina=<?= $total_paginas; ?>">Última</a></li>
                <?php endif; ?>
            </ul>
        </nav>

        <a href="registrar_cita.php" class="btn btn-primary mt-3">Registrar Nueva Cita</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
