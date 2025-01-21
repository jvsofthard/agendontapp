<?php
include 'conexion.php';

session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Opcional: Verificar roles
if ($_SESSION['rol'] !== 'admin') {
    echo "No tienes permiso para acceder a esta página.";
    exit;
}

// Inicializamos las variables de filtro
$filtro_especialista = isset($_GET['especialista']) ? $_GET['especialista'] : '';
$filtro_fecha_desde = isset($_GET['fecha_desde']) ? $_GET['fecha_desde'] : '';
$filtro_fecha_hasta = isset($_GET['fecha_hasta']) ? $_GET['fecha_hasta'] : '';

// Consulta base para reportes
$query = "
    SELECT 
        citas.id_cita, 
        pacientes.nombre AS nombre_paciente, 
        especialistas.nombre AS nombre_especialista, 
        citas.fecha, 
        citas.motivo,
        citas.tipo_tratamiento
    FROM citas
    JOIN pacientes ON citas.id_paciente = pacientes.id_paciente
    JOIN especialistas ON citas.id_especialista = especialistas.id_especialista
    WHERE 1=1";

// Agregamos filtros si existen
if (!empty($filtro_especialista)) {
    $query .= " AND especialistas.id_especialista = '$filtro_especialista'";
}
if (!empty($filtro_fecha_desde) && !empty($filtro_fecha_hasta)) {
    $query .= " AND DATE(citas.fecha) BETWEEN '$filtro_fecha_desde' AND '$filtro_fecha_hasta'";
}

$query .= " ORDER BY citas.fecha DESC";
$result = $conn->query($query);

// Obtener la lista de especialistas para el filtro
$query_especialistas = "SELECT id_especialista, nombre FROM especialistas";
$result_especialistas = $conn->query($query_especialistas);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes</title>
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
                    <li class="nav-item"><a class="nav-link" href="lista_especialistas.php">Especialistas</a></li>
                    <li class="nav-item"><a class="nav-link active" href="reportes.php">Reportes</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h1 class="text-center">Reportes de Citas</h1>

        <!-- Filtros -->
        <form class="row g-3 mb-4" method="GET" action="reportes.php">
            <div class="col-md-3">
                <label for="especialista" class="form-label">Filtrar por Especialista</label>
                <select class="form-select" name="especialista" id="especialista">
                    <option value="">Todos</option>
                    <?php while ($row_especialista = $result_especialistas->fetch_assoc()): ?>
                        <option value="<?= $row_especialista['id_especialista']; ?>" <?= $row_especialista['id_especialista'] == $filtro_especialista ? 'selected' : ''; ?>>
                            <?= $row_especialista['nombre']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="col-md-3">
                <label for="fecha_desde" class="form-label">Desde</label>
                <input type="date" class="form-control" name="fecha_desde" id="fecha_desde" value="<?= $filtro_fecha_desde; ?>">
            </div>
            <div class="col-md-3">
                <label for="fecha_hasta" class="form-label">Hasta</label>
                <input type="date" class="form-control" name="fecha_hasta" id="fecha_hasta" value="<?= $filtro_fecha_hasta; ?>">
            </div>
            <div class="col-md-3 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">Filtrar</button>
            </div>
        </form>

        <!-- Botones de Exportación -->
        <div class="d-flex justify-content-end mb-3">
            <a href="exportar_csv.php?especialista=<?= $filtro_especialista; ?>&fecha_desde=<?= $filtro_fecha_desde; ?>&fecha_hasta=<?= $filtro_fecha_hasta; ?>" class="btn btn-success me-2">Exportar a CSV</a>
            <a href="exportar_pdf.php?especialista=<?= $filtro_especialista; ?>&fecha_desde=<?= $filtro_fecha_desde; ?>&fecha_hasta=<?= $filtro_fecha_hasta; ?>" class="btn btn-danger">Exportar a PDF</a>
        </div>

        <!-- Tabla de resultados -->
        <?php if ($result->num_rows > 0): ?>
            <table class="table table-bordered table-striped">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Paciente</th>
                        <th>Especialista</th>
                        <th>Fecha</th>
                        <th>Motivo</th>
                        <th>Tratamiento</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['id_cita']; ?></td>
                            <td><?= $row['nombre_paciente']; ?></td>
                            <td><?= $row['nombre_especialista']; ?></td>
                            <td><?= date("d/m/Y H:i", strtotime($row['fecha'])); ?></td>
                            <td><?= $row['motivo']; ?></td>
                            <td><?= $row['tipo_tratamiento']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert alert-info text-center">No se encontraron citas con los filtros aplicados.</div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
