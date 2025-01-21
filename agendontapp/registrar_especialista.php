<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $especialidad = $_POST['especialidad'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $tanda = $_POST['tanda']; // Nuevo campo
    $hora_inicio = $_POST['hora_inicio']; // Nuevo campo
    $hora_fin = $_POST['hora_fin']; // Nuevo campo

    // Ahora inserta los nuevos datos en la base de datos
    $sql = "INSERT INTO especialistas (nombre, especialidad, telefono, correo, tanda, hora_inicio, hora_fin) 
            VALUES ('$nombre', '$especialidad', '$telefono', '$correo', '$tanda', '$hora_inicio', '$hora_fin')";

    if ($conn->query($sql)) {
        $mensaje = "Especialista registrado correctamente.";
    } else {
        $mensaje = "Error al registrar: " . $conn->error;
    }
}

// acceso solo admin
require_once 'funciones.php';
verificarAcceso('admin');

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Especialista</title>
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
                    <li class="nav-item"><a class="nav-link" href="lista_especialistas.php">Especialistas</a></li>
                    <li class="nav-item"><a class="nav-link active" href="registrar_especialista.php">Registrar Especialista</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h1 class="text-center">Registrar Nuevo Especialista</h1>

        <?php if (!empty($mensaje)): ?>
            <div class="alert alert-info text-center" role="alert">
                <?= $mensaje; ?>
            </div>
        <?php endif; ?>

        <form method="POST" class="mt-4" id="formRegistroEspecialista">
    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" name="nombre" id="nombre" class="form-control" required>
    </div>
    <div class="mb-3">
        <div class="form-group">
            <label for="especialidad">Especialidad:</label>
            <select id="especialidad" name="especialidad" required>
                <option value="" disabled selected>Seleccione una especialidad</option>
                <option value="Ortodoncia">Ortodoncia</option>
                <option value="Endodoncia">Endodoncia</option>
                <option value="Odontopediatría">Odontopediatría</option>
                <option value="Periodoncia">Periodoncia</option>
                <option value="Cirugía Maxilofacial">Cirugía Maxilofacial</option>
                <option value="Estética Dental">Estética Dental</option>
                <option value="Prostodoncia">Prostodoncia</option>
            </select>
        </div>
    </div>
    <div class="mb-3">
        <label for="telefono" class="form-label">Teléfono</label>
        <input type="text" name="telefono" id="telefono" class="form-control">
    </div>
    <div class="mb-3">
        <label for="correo" class="form-label">Correo</label>
        <input type="email" name="correo" id="correo" class="form-control">
    </div>

    <!-- Nuevo campo para seleccionar tanda -->
    <div class="mb-3">
        <label for="tanda" class="form-label">Tanda Disponible</label>
        <select name="tanda" id="tanda" class="form-control" required>
            <option value="" disabled selected>Seleccione una tanda</option>
            <option value="Completo">Completo</option>
            <option value="Mañana">Mañana</option>
            <option value="Tarde">Tarde</option>
            <option value="Noche">Noche</option>
        </select>
    </div>

    <!-- Nuevos campos para horario disponible -->
    <div class="mb-3">
        <label for="hora_inicio" class="form-label">Hora de inicio</label>
        <input type="time" name="hora_inicio" id="hora_inicio" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="hora_fin" class="form-label">Hora de fin</label>
        <input type="time" name="hora_fin" id="hora_fin" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary w-100">Registrar Especialista</button>
</form>

        <a href="lista_especialistas.php" class="btn btn-secondary mt-3 w-100">Ver Lista de Especialistas</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
