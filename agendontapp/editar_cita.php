<?php
include 'conexion.php';
session_start();
require_once 'funciones.php';

// Validar que se haya recibido el ID de la cita
if (!isset($_GET['id'])) {
    header("Location: lista_citas.php");
    exit();
}

$id_cita = $_GET['id'];

// Registrar auditoría
$usuario = $_SESSION['username'];
$rol = $_SESSION['rol'];
$accion = "Editó la cita ID $id_cita";
registrarAuditoria($usuario, $rol, $accion);

// Obtener datos de la cita actual
$query = "SELECT * FROM citas WHERE id_cita = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id_cita);
$stmt->execute();
$result = $stmt->get_result();
$cita = $result->fetch_assoc();

if (!$cita) {
    echo "Cita no encontrada.";
    exit();
}

// Obtener listas de pacientes y especialistas
$pacientes = $conn->query("SELECT * FROM pacientes");
$especialistas = $conn->query("SELECT * FROM especialistas");

// Procesar el formulario al enviar
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_paciente = $_POST['paciente'];
    $id_especialista = $_POST['especialista'];
    $fecha_cita = $_POST['fecha_cita'];
    $motivo = $_POST['motivo'];
    $tipo_tratamiento = $_POST['tipo_tratamiento'];

    // Actualizar la cita
    $update_query = "UPDATE citas 
                     SET id_paciente = ?, id_especialista = ?, fecha = ?, motivo = ?, tipo_tratamiento = ? 
                     WHERE id_cita = ?";
    $update_stmt = $conn->prepare($update_query);
    $update_stmt->bind_param("iisssi", $id_paciente, $id_especialista, $fecha_cita, $motivo, $tipo_tratamiento, $id_cita);

    if ($update_stmt->execute()) {
        header("Location: lista_citas.php?mensaje=Cita actualizada correctamente");
        exit();
    } else {
        echo "Error al actualizar la cita: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Editar Cita</h1>
        <form method="POST">
            <input type="hidden" name="id_cita" value="<?= $cita['id_cita']; ?>">

            <div class="form-group">
                <label for="paciente">Paciente</label>
                <select class="form-control" id="paciente" name="paciente" required>
                    <option value="">Seleccione un paciente</option>
                    <?php while ($row = $pacientes->fetch_assoc()): ?>
                        <option value="<?= $row['id_paciente']; ?>" <?= ($row['id_paciente'] == $cita['id_paciente']) ? 'selected' : ''; ?>>
                            <?= $row['nombre']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="especialista">Especialista</label>
                <select class="form-control" id="especialista" name="especialista" required>
                    <option value="">Seleccione un especialista</option>
                    <?php while ($row = $especialistas->fetch_assoc()): ?>
                        <option value="<?= $row['id_especialista']; ?>" <?= ($row['id_especialista'] == $cita['id_especialista']) ? 'selected' : ''; ?>>
                            <?= $row['nombre']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="fecha_cita">Fecha de la cita</label>
                <input type="datetime-local" class="form-control" id="fecha_cita" name="fecha_cita" 
                       value="<?= date('Y-m-d\TH:i', strtotime($cita['fecha'])); ?>" required>
            </div>

            <div class="form-group">
                <label for="motivo">Motivo de la cita</label>
                <textarea class="form-control" id="motivo" name="motivo" required><?= $cita['motivo']; ?></textarea>
            </div>

            <div class="form-group">
                <label for="tipo_tratamiento">Tipo de tratamiento</label>
                <select class="form-control" id="tipo_tratamiento" name="tipo_tratamiento" required>
                    <option value="Consulta general" <?= ($cita['tipo_tratamiento'] == 'Consulta general') ? 'selected' : ''; ?>>Consulta general</option>
                    <option value="Tratamiento de conductos" <?= ($cita['tipo_tratamiento'] == 'Tratamiento de conductos') ? 'selected' : ''; ?>>Tratamiento de conductos</option>
                    <option value="Ortodoncia" <?= ($cita['tipo_tratamiento'] == 'Ortodoncia') ? 'selected' : ''; ?>>Ortodoncia</option>
                    <option value="Blanqueamiento" <?= ($cita['tipo_tratamiento'] == 'Blanqueamiento') ? 'selected' : ''; ?>>Blanqueamiento</option>
                    <option value="Otros" <?= ($cita['tipo_tratamiento'] == 'Otros') ? 'selected' : ''; ?>>Otros</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Actualizar Cita</button>
        </form>
    </div>
</body>
</html>
