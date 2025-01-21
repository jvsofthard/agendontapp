<?php
include 'conexion.php';

// Obtener la lista de pacientes
$queryPacientes = "SELECT id_paciente, nombre FROM pacientes";
$resultPacientes = $conn->query($queryPacientes);

// Obtener la lista de especialistas
$queryEspecialistas = "SELECT id_especialista, nombre, especialidad, tanda, hora_inicio, hora_fin FROM especialistas";
$resultEspecialistas = $conn->query($queryEspecialistas);

// Procesar formulario al enviar
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_paciente = $_POST['paciente'];
    $id_especialista = $_POST['especialista'];
    $fecha = $_POST['fecha_cita'];
    $motivo = $_POST['motivo'];
    $tipo_tratamiento = $_POST['tipo_tratamiento'];

    $sql = "INSERT INTO citas (id_paciente, id_especialista, fecha, motivo, tipo_tratamiento) 
            VALUES ('$id_paciente', '$id_especialista', '$fecha', '$motivo', '$tipo_tratamiento')";

    if ($conn->query($sql)) {
        $mensaje = "Cita registrada correctamente.";
    } else {
        $mensaje = "Error al registrar la cita: " . $conn->error;
    }
}

session_start();
if (!isset($_SESSION['rol']) || !in_array($_SESSION['rol'], ['admin', 'recepcionista'])) {
    echo "No tienes permiso para acceder a esta página.";
    exit;
}

// Para la auditoría
require_once 'funciones.php';

$usuario = $_SESSION['username'];
$rol = $_SESSION['rol'];
$accion = "Registró una nueva cita";

registrarAuditoria($usuario, $rol, $accion);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Cita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                    <li class="nav-item"><a class="nav-link" href="lista_citas.php">Citas</a></li>
                    <li class="nav-item"><a class="nav-link active" href="registrar_cita.php">Registrar Cita</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h1 class="text-center">Registrar Nueva Cita</h1>

        <?php if (!empty($mensaje)): ?>
            <div class="alert alert-info text-center" role="alert">
                <?= $mensaje; ?>
            </div>
        <?php endif; ?>

        <form method="POST" id="formRegistroCita">
            <div class="form-group">
                <label for="paciente">Paciente</label>
                <select class="form-control" id="paciente" name="paciente" required>
                    <option value="">Seleccione un paciente</option>
                    <?php while ($row = $resultPacientes->fetch_assoc()): ?>
                        <option value="<?= $row['id_paciente']; ?>"><?= $row['nombre']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="especialista">Especialista</label>
                <select class="form-control" id="especialista" name="especialista" required>
                    <option value="">Seleccione un especialista</option>
                    <?php while ($row = $resultEspecialistas->fetch_assoc()): ?>
                        <option value="<?= $row['id_especialista']; ?>" 
                                data-tanda="<?= $row['tanda']; ?>" 
                                data-hora-inicio="<?= $row['hora_inicio']; ?>" 
                                data-hora-fin="<?= $row['hora_fin']; ?>">
                            <?= $row['nombre'] . " - " . $row['especialidad']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="fecha_cita">Fecha y Hora de la cita</label>
                <input type="datetime-local" class="form-control" id="fecha_cita" name="fecha_cita" required>
                <small id="horarioDisponible" class="form-text text-muted"></small>
            </div>

            <div class="form-group">
                <label for="motivo">Motivo de la cita</label>
                <textarea class="form-control" id="motivo" name="motivo" required></textarea>
            </div>

            <div class="form-group">
                <label for="tipo_tratamiento">Tipo de tratamiento</label>
                <select class="form-control" id="tipo_tratamiento" name="tipo_tratamiento" required>
                    <option value="Consulta general">Consulta general</option>
                    <option value="Tratamiento de conductos">Tratamiento de conductos</option>
                    <option value="Ortodoncia">Ortodoncia</option>
                    <option value="Blanqueamiento">Blanqueamiento</option>
                    <option value="Otros">Otros</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Registrar Cita</button>
        </form>

        <a href="lista_citas.php" class="btn btn-secondary mt-3 w-100">Ver Lista de Citas</a>
    </div>

    <script>
        $(document).ready(function () {
            $('#especialista').change(function () {
                const selected = $(this).find(':selected');
                const tanda = selected.data('tanda');
                const horaInicio = selected.data('hora-inicio');
                const horaFin = selected.data('hora-fin');

                $('#horarioDisponible').text(
                    `Horario disponible: ${tanda} (${horaInicio} - ${horaFin})`
                );

                $('#fecha_cita').attr('min', horaInicio).attr('max', horaFin);
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
