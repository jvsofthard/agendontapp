<?php
require_once 'conexion.php';

// acceso admin, recepcionista
session_start();
if (!isset($_SESSION['rol']) || !in_array($_SESSION['rol'], ['admin', 'recepcionista'])) {
    echo "No tienes permiso para acceder a esta página.";
    exit;
}

// Inicializar variables
$especialistaSeleccionado = null;
$citasEspecialista = [];
$citasPorMes = [];

// Manejar selección de especialista
if (isset($_POST['id_especialista'])) {
    $id_especialista = $_POST['id_especialista'];

    // Obtener datos del especialista seleccionado
    $sqlEspecialista = "SELECT * FROM especialistas WHERE id_especialista = ?";
    $stmt = $conn->prepare($sqlEspecialista);
    $stmt->bind_param("i", $id_especialista);
    $stmt->execute();
    $especialistaSeleccionado = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    // Obtener citas asignadas al especialista
    $sqlCitas = "SELECT c.id_cita, p.nombre AS paciente, c.fecha, c.hora, c.motivo 
                 FROM citas c 
                 INNER JOIN pacientes p ON c.id_paciente = p.id_paciente
                 WHERE c.id_especialista = ?
                 ORDER BY c.fecha, c.hora";
    $stmt = $conn->prepare($sqlCitas);
    $stmt->bind_param("i", $id_especialista);
    $stmt->execute();
    $resultCitas = $stmt->get_result();
    while ($cita = $resultCitas->fetch_assoc()) {
        $citasEspecialista[] = $cita;
    }
    $stmt->close();

    // Obtener estadísticas de citas por mes
    $sqlEstadisticas = "SELECT MONTH(fecha) AS mes, COUNT(*) AS total
                        FROM citas
                        WHERE id_especialista = ?
                        GROUP BY MONTH(fecha)
                        ORDER BY mes";
    $stmt = $conn->prepare($sqlEstadisticas);
    $stmt->bind_param("i", $id_especialista);
    $stmt->execute();
    $resultEstadisticas = $stmt->get_result();
    while ($fila = $resultEstadisticas->fetch_assoc()) {
        $citasPorMes[(int)$fila['mes']] = (int)$fila['total'];
    }
    $stmt->close();
}

// Rellenar meses sin citas con 0
for ($mes = 1; $mes <= 12; $mes++) {
    if (!isset($citasPorMes[$mes])) {
        $citasPorMes[$mes] = 0;
    }
}
ksort($citasPorMes);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil del Especialista</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                    <li class="nav-item"><a class="nav-link" href="lista_especialistas.php">Especialistas</a></li>
                    <li class="nav-item"><a class="nav-link" href="lista_citas.php">Citas</a></li>
                    <li class="nav-item"><a class="nav-link" href="perfil_paciente.php">Pacientes</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h1 class="text-center">Perfil del Especialista</h1>

        <!-- Formulario de selección de especialista -->
        <form method="POST" action="perfil_especialista.php" class="mb-4">
            <label for="id_especialista" class="form-label">Seleccione un especialista:</label>
            <select name="id_especialista" id="id_especialista" required>
                <option value="">--Seleccione--</option>
                <?php
                $sqlEspecialistas = "SELECT * FROM especialistas";
                $resultEspecialistas = $conn->query($sqlEspecialistas);
                while ($especialista = $resultEspecialistas->fetch_assoc()) {
                    $selected = ($especialistaSeleccionado && $especialista['id_especialista'] == $especialistaSeleccionado['id_especialista']) ? 'selected' : '';
                    echo "<option value='{$especialista['id_especialista']}' $selected>{$especialista['nombre']}</option>";
                }
                ?>
            </select>
            <button type="submit" class="btn btn-primary mt-3">Ver Perfil</button>
        </form>

        <!-- Información del especialista seleccionado -->
        <?php if ($especialistaSeleccionado): ?>
            <h2>Información del Especialista</h2>
            <p><strong>Nombre:</strong> <?= htmlspecialchars($especialistaSeleccionado['nombre']) ?></p>
            <p><strong>Especialidad:</strong> <?= htmlspecialchars($especialistaSeleccionado['especialidad']) ?></p>
            <p><strong>Teléfono:</strong> <?= htmlspecialchars($especialistaSeleccionado['telefono']) ?></p>
            <p><strong>Correo:</strong> <?= htmlspecialchars($especialistaSeleccionado['correo']) ?></p>
            
            <!-- Tanda y Horas Disponibles -->
            <h3>Rango de Horas Disponibles:</h3>
            <p><strong>Tanda:</strong> <?= htmlspecialchars($especialistaSeleccionado['tanda']) ?></p>
            <p><strong>Hora de Inicio:</strong> <?= htmlspecialchars($especialistaSeleccionado['hora_inicio']) ?></p>
            <p><strong>Hora de Fin:</strong> <?= htmlspecialchars($especialistaSeleccionado['hora_fin']) ?></p>

            <!-- Citas asignadas -->
            <h2 class="mt-4">Citas Asignadas</h2>
            <?php if (count($citasEspecialista) > 0): ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID Cita</th>
                            <th>Paciente</th>
                            <th>Fecha</th>
                            <th>Descripción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($citasEspecialista as $cita): ?>
                            <tr>
                                <td><?= htmlspecialchars($cita['id_cita']) ?></td>
                                <td><?= htmlspecialchars($cita['paciente']) ?></td>
                                <td><?= htmlspecialchars($cita['fecha']) ?></td>
                                <td><?= htmlspecialchars($cita['motivo']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="text-muted">Este especialista no tiene citas asignadas.</p>
            <?php endif; ?>

            <!-- Gráfico de citas por mes -->
            <h2 class="mt-4">Estadísticas de Citas por Mes</h2>
            <canvas id="chartCitasPorMes" width="400" height="200"></canvas>
            <script>
                const ctx = document.getElementById('chartCitasPorMes').getContext('2d');
                const chartCitasPorMes = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                        datasets: [{
                            label: 'Citas por Mes',
                            data: <?= json_encode(array_values($citasPorMes)) ?>,
                            borderColor: 'rgba(75, 192, 192, 1)',
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            tension: 0.4
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                display: true,
                                position: 'top'
                            }
                        }
                    }
                });
            </script>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
