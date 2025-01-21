<?php
include 'conexion.php'; // Conexión a la base de datos

session_start();
require_once 'funciones.php';

$usuario = $_SESSION['username'];
$rol = $_SESSION['rol'];
$accion = "Edito el paciente con ID " . $_GET['id'];

registrarAuditoria($usuario, $rol, $accion);

// Código para eliminar la cita
echo "Paciente Editado.";


// Obtener ID del paciente
$id = $_GET['id'] ?? null;

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $direccion = $_POST['direccion'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $seguro_medico = $_POST['seguro_medico'];

    // Actualizar datos del paciente
    $sql = "UPDATE pacientes SET nombre='$nombre', telefono='$telefono', correo='$correo', direccion='$direccion', fecha_nacimiento = '$fecha_nacimiento', seguro_medico='$seguro_medico' WHERE id_paciente=$id";
    if ($conn->query($sql)) {
        header('Location: lista_pacientes.php'); // Redirigir al listado de pacientes
        exit;
    } else {
        echo "Error al actualizar: " . $conn->error;
    }
}

// Obtener datos del paciente actual
$sql = "SELECT * FROM pacientes WHERE id_paciente = $id";
$resultado = $conn->query($sql);
$paciente = $resultado->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Paciente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <header>
        <h1>Editar Paciente</h1>
        <a href="lista_pacientes.php">Volver</a>
    </header>
    <form action="editar_paciente.php?id=<?= $id ?>" method="POST">
    <input type="hidden" name="id_paciente" value="<?php echo $paciente['id_paciente']; ?>">

    <div class="form-group">
        <label for="nombre">Nombre</label>
        <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $paciente['nombre']; ?>" required>
    </div>

    <div class="form-group">
        <label for="telefono">Teléfono</label>
        <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo $paciente['telefono']; ?>" required>
    </div>

    <div class="form-group">
        <label for="correo">Correo</label>
        <input type="email" class="form-control" id="correo" name="correo" value="<?php echo $paciente['correo']; ?>" required>
    </div>

    <div class="form-group">
        <label for="direccion">Dirección</label>
        <textarea class="form-control" id="direccion" name="direccion" required><?php echo $paciente['direccion']; ?></textarea>
    </div>

    <!-- Nuevos campos -->
    <div class="form-group">
        <label for="fecha_nacimiento">Fecha de nacimiento</label>
        <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="<?php echo $paciente['fecha_nacimiento']; ?>" required>
    </div>

    <div class="form-group">
        <label for="sexo">Sexo</label>
        <select class="form-control" id="sexo" name="sexo" required>
            <option value="Masculino" <?php echo ($paciente['sexo'] == 'Masculino') ? 'selected' : ''; ?>>Masculino</option>
            <option value="Femenino" <?php echo ($paciente['sexo'] == 'Femenino') ? 'selected' : ''; ?>>Femenino</option>
            <option value="Otro" <?php echo ($paciente['sexo'] == 'Otro') ? 'selected' : ''; ?>>Otro</option>
        </select>
    </div>

    <div class="form-group">
        <label for="seguro_medico">Número de seguro médico</label>
        <input type="text" class="form-control" id="seguro_medico" name="seguro_medico" value="<?php echo $paciente['seguro_medico']; ?>" required>
    </div>

    <button type="submit" class="btn btn-primary">Actualizar Paciente</button>
</form>
</body>
</html>
