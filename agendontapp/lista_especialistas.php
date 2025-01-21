<?php
include 'conexion.php';

// Número de especialistas a mostrar por página
$registros_por_pagina = 10;

// Obtener el número total de especialistas
$query_total = "SELECT COUNT(*) AS total FROM especialistas";
$result_total = $conn->query($query_total);
$row_total = $result_total->fetch_assoc();
$total_registros = $row_total['total'];

// Calcular el número total de páginas
$total_paginas = ceil($total_registros / $registros_por_pagina);

// Obtener la página actual (si no existe, por defecto será la página 1)
$pagina_actual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
if ($pagina_actual < 1) $pagina_actual = 1; // Evitar números negativos

// Calcular el punto de inicio para la consulta SQL
$inicio = ($pagina_actual - 1) * $registros_por_pagina;

// Obtener los especialistas con la paginación, incluyendo la tanda y las horas
$query = "SELECT id_especialista, nombre, especialidad, telefono, correo, tanda, hora_inicio, hora_fin FROM especialistas ORDER BY nombre ASC LIMIT $inicio, $registros_por_pagina";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Especialistas</title>
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
                    <li class="nav-item"><a class="nav-link" href="lista_citas.php">Citas</a></li>
                    <li class="nav-item"><a class="nav-link active" href="lista_especialistas.php">Especialistas</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h1 class="text-center">Lista de Especialistas</h1>

        <?php if ($result->num_rows > 0): ?>
            <table class="table table-bordered table-striped mt-4">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Especialidad</th>
                        <th>Teléfono</th>
                        <th>Correo</th>
                        <th>Tanda</th> <!-- Nueva columna para mostrar la tanda -->
                        <th>Hora Inicio</th> <!-- Nueva columna para la hora de inicio -->
                        <th>Hora Fin</th> <!-- Nueva columna para la hora de fin -->
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['id_especialista']; ?></td>
                            <td><?= $row['nombre']; ?></td>
                            <td><?= $row['especialidad']; ?></td>
                            <td><?= $row['telefono']; ?></td>
                            <td><?= $row['correo']; ?></td>
                            <td><?= $row['tanda']; ?></td> <!-- Mostrar tanda -->
                            <td><?= $row['hora_inicio']; ?></td> <!-- Mostrar hora de inicio -->
                            <td><?= $row['hora_fin']; ?></td> <!-- Mostrar hora de fin -->
                            <td>
                                <a href="editar_especialista.php?id=<?= $row['id_especialista']; ?>" class="btn btn-sm btn-warning">Editar</a>
                                <a href="eliminar_especialista.php?id=<?= $row['id_especialista']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar este especialista?')">Eliminar</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert alert-info text-center">No hay especialistas registrados.</div>
        <?php endif; ?>

        <!-- Paginación -->
        <nav>
            <ul class="pagination justify-content-center">
                <?php if ($pagina_actual > 1): ?>
                    <li class="page-item"><a class="page-link" href="lista_especialistas.php?pagina=1">Primera</a></li>
                    <li class="page-item"><a class="page-link" href="lista_especialistas.php?pagina=<?= $pagina_actual - 1; ?>">Anterior</a></li>
                <?php endif; ?>

                <?php
                $rango_paginas = 2;
                $inicio_paginacion = max(1, $pagina_actual - $rango_paginas);
                $fin_paginacion = min($total_paginas, $pagina_actual + $rango_paginas);

                for ($i = $inicio_paginacion; $i <= $fin_paginacion; $i++): ?>
                    <li class="page-item <?= $i == $pagina_actual ? 'active' : ''; ?>">
                        <a class="page-link" href="lista_especialistas.php?pagina=<?= $i; ?>"><?= $i; ?></a>
                    </li>
                <?php endfor; ?>

                <?php if ($pagina_actual < $total_paginas): ?>
                    <li class="page-item"><a class="page-link" href="lista_especialistas.php?pagina=<?= $pagina_actual + 1; ?>">Siguiente</a></li>
                    <li class="page-item"><a class="page-link" href="lista_especialistas.php?pagina=<?= $total_paginas; ?>">Última</a></li>
                <?php endif; ?>
            </ul>
        </nav>

        <a href="registrar_especialista.php" class="btn btn-primary mt-3">Registrar Nuevo Especialista</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
