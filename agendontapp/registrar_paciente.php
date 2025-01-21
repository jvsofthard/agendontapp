<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $edad = $_POST['edad']; // Se capturará desde el formulario, aunque se calcula en JavaScript

    $sql = "INSERT INTO pacientes (nombre, telefono, correo, fecha_nacimiento, edad) 
            VALUES ('$nombre', '$telefono', '$correo', '$fecha_nacimiento', '$edad')";
    if ($conn->query($sql)) {
        $mensaje = "Paciente registrado correctamente.";
    } else {
        $mensaje = "Error al registrar: " . $conn->error;
    }
}

//acceso admin, recepcionista
session_start();
if (!isset($_SESSION['rol']) || !in_array($_SESSION['rol'], ['admin', 'recepcionista'])) {
    echo "No tienes permiso para acceder a esta página.";
    exit;
}

// CODIGO PARA AUDITORIA
require_once 'funciones.php';

$usuario = $_SESSION['username'];
$rol = $_SESSION['rol'];
$accion = "Registró un nuevo usuario";

registrarAuditoria($usuario, $rol, $accion);

// Aquí va el resto del código para registrar usuarios


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Paciente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <script>
        // Función para calcular la edad a partir de la fecha de nacimiento
        function calcularEdad() {
            const fechaNacimiento = document.getElementById('fecha_nacimiento').value;
            const fechaNacimientoDate = new Date(fechaNacimiento);
            const hoy = new Date();
            let edad = hoy.getFullYear() - fechaNacimientoDate.getFullYear();
            const mes = hoy.getMonth();
            const dia = hoy.getDate();
            if (mes < fechaNacimientoDate.getMonth() || (mes === fechaNacimientoDate.getMonth() && dia < fechaNacimientoDate.getDate())) {
                edad--;
            }
            document.getElementById('edad').value = edad; // Establecer el valor de la edad en el campo oculto
        }
    </script>
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
                    <li class="nav-item"><a class="nav-link active" href="registrar_paciente.php">Registrar Paciente</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h1 class="text-center">Registrar Nuevo Paciente</h1>

        <?php if (!empty($mensaje)): ?>
            <div class="alert alert-info text-center" role="alert">
                <?= $mensaje; ?>
            </div>
        <?php endif; ?>

        <form action="procesar_paciente.php" method="POST">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>

            <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input type="text" class="form-control" id="telefono" name="telefono" required>
            </div>

            <div class="form-group">
                <label for="correo">Correo</label>
                <input type="email" class="form-control" id="correo" name="correo" required>
            </div>

            <div class="form-group">
                <label for="direccion">Dirección</label>
                <textarea class="form-control" id="direccion" name="direccion" required></textarea>
            </div>

            <div class="form-group">
                <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required onchange="calcularEdad()">
            </div>

            <div class="form-group">
                <label for="edad">Edad</label>
                <input type="number" class="form-control" id="edad" name="edad" readonly>
            </div>

            <div class="form-group">
                <label for="sexo">Sexo</label>
                <select class="form-control" id="sexo" name="sexo" required>
                    <option value="Masculino">Masculino</option>
                    <option value="Femenino">Femenino</option>
                    <option value="Otro">Otro</option>
                </select>
            </div>

            <div class="form-group">
                <label for="seguro_medico">Número de Seguro Médico</label>
                <input type="text" class="form-control" id="seguro_medico" name="seguro_medico">
            </div>

            <button type="submit" class="btn btn-primary">Registrar Paciente</button>
        </form>

        <a href="lista_pacientes.php" class="btn btn-secondary mt-3 w-100">Ver Lista de Pacientes</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
