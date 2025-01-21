<?php
session_start();
require_once 'conexion.php';
require_once 'funciones.php';

$usuario = $_SESSION['username'];
$rol = $_SESSION['rol'];
$accion = "Edito Especialista con ID " . $_GET['id'];

registrarAuditoria($usuario, $rol, $accion);

// Verificar si se recibió el ID del especialista
if (!isset($_GET['id'])) {
    echo "ID de especialista no proporcionado.";
    exit();
}

$id_especialista = $_GET['id'];

// Obtener los datos actuales del especialista
$query = $conn->prepare("SELECT * FROM especialistas WHERE id_especialista = ?");
$query->bind_param("i", $id_especialista);
$query->execute();
$result = $query->get_result();
$especialista = $result->fetch_assoc();

if (!$especialista) {
    echo "Especialista no encontrado.";
    exit();
}

// Procesar formulario de edición
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $correo = $_POST['correo'] ?? '';
    $especialidad = $_POST['especialidad'] ?? '';
    $horario = $_POST['horario'] ?? '';
    $tanda = $_POST['tanda'] ?? '';
    $hora_inicio = $_POST['hora_inicio'] ?? '';
    $hora_fin = $_POST['hora_fin'] ?? '';

    // Validar datos
    if (empty($nombre) || empty($telefono) || empty($correo) || empty($especialidad) || empty($horario) || empty($tanda) || empty($hora_inicio) || empty($hora_fin)) {
        $error = "Todos los campos son obligatorios.";
    } else {
        // Actualizar datos del especialista
        $update_query = $conn->prepare("UPDATE especialistas SET nombre = ?, telefono = ?, correo = ?, especialidad = ?, horario = ?, tanda = ?, hora_inicio = ?, hora_fin = ? WHERE id_especialista = ?");
        $update_query->bind_param("ssssssssi", $nombre, $telefono, $correo, $especialidad, $horario, $tanda, $hora_inicio, $hora_fin, $id_especialista);

        if ($update_query->execute()) {
            header("Location: lista_especialistas.php?mensaje=Especialista actualizado correctamente");
            exit();
        } else {
            $error = "Error al actualizar el especialista. Intenta de nuevo.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Especialista</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Editar Especialista</h1>

        <?php if (isset($error)) echo "<p style='color: red;'>$error</p>"; ?>

        <form action="" method="POST">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo htmlspecialchars($especialista['nombre']); ?>" required>
            </div>

            <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input type="text" name="telefono" id="telefono" class="form-control" value="<?php echo htmlspecialchars($especialista['telefono']); ?>" required>
            </div>

            <div class="form-group">
                <label for="correo">Correo:</label>
                <input type="email" name="correo" id="correo" class="form-control" value="<?php echo htmlspecialchars($especialista['correo']); ?>" required>
            </div>

            <div class="form-group">
                <label for="especialidad">Especialidad:</label>
                <select id="especialidad" name="especialidad" class="form-control" required>
                    <option value="Ortodoncia" <?php echo ($especialista['especialidad'] == 'Ortodoncia') ? 'selected' : ''; ?>>Ortodoncia</option>
                    <option value="Endodoncia" <?php echo ($especialista['especialidad'] == 'Endodoncia') ? 'selected' : ''; ?>>Endodoncia</option>
                    <option value="Odontopediatría" <?php echo ($especialista['especialidad'] == 'Odontopediatría') ? 'selected' : ''; ?>>Odontopediatría</option>
                    <option value="Periodoncia" <?php echo ($especialista['especialidad'] == 'Periodoncia') ? 'selected' : ''; ?>>Periodoncia</option>
                    <option value="Cirugía Maxilofacial" <?php echo ($especialista['especialidad'] == 'Cirugía Maxilofacial') ? 'selected' : ''; ?>>Cirugía Maxilofacial</option>
                    <option value="Estética Dental" <?php echo ($especialista['especialidad'] == 'Estética Dental') ? 'selected' : ''; ?>>Estética Dental</option>
                    <option value="Prostodoncia" <?php echo ($especialista['especialidad'] == 'Prostodoncia') ? 'selected' : ''; ?>>Prostodoncia</option>
                </select>
            </div>

            <div class="form-group">
                <label for="horario">Horario:</label>
                <textarea name="horario" id="horario" class="form-control" rows="3" required><?php echo htmlspecialchars($especialista['horario']); ?></textarea>
            </div>

            <div class="form-group">
                <label for="tanda">Tanda:</label>
                <select name="tanda" id="tanda" class="form-control" required>
                    <option value="Completo" <?php echo ($especialista['tanda'] == 'Completo') ? 'selected' : ''; ?>>Completo</option>
                    <option value="Mañana" <?php echo ($especialista['tanda'] == 'Mañana') ? 'selected' : ''; ?>>Mañana</option>
                    <option value="Tarde" <?php echo ($especialista['tanda'] == 'Tarde') ? 'selected' : ''; ?>>Tarde</option>
                    <option value="Noche" <?php echo ($especialista['tanda'] == 'Noche') ? 'selected' : ''; ?>>Noche</option>
                </select>
            </div>

            <!-- Campos de hora de inicio y hora de fin -->
            <div class="form-group">
                <label for="hora_inicio">Hora de Inicio:</label>
                <input type="time" name="hora_inicio" id="hora_inicio" class="form-control" value="<?php echo htmlspecialchars($especialista['hora_inicio']); ?>" required>
            </div>

            <div class="form-group">
                <label for="hora_fin">Hora de Fin:</label>
                <input type="time" name="hora_fin" id="hora_fin" class="form-control" value="<?php echo htmlspecialchars($especialista['hora_fin']); ?>" required>
            </div>

            <div class="form-group mt-3">
                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                <a href="lista_especialistas.php" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>
