<?php
require_once 'conexion.php';

// Inicializar variables
$pacienteSeleccionado = null;

// Manejar selección de paciente
if (isset($_POST['id_paciente'])) {
    $id_paciente = $_POST['id_paciente'];

    // Obtener datos del paciente seleccionado
    $sqlPaciente = "SELECT * FROM pacientes WHERE id_paciente = ?";
    $stmt = $conn->prepare($sqlPaciente);
    $stmt->bind_param("i", $id_paciente);
    $stmt->execute();
    $pacienteSeleccionado = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    // Calcular la edad si la fecha de nacimiento está disponible
    if ($pacienteSeleccionado && !empty($pacienteSeleccionado['fecha_nacimiento'])) {
        $fechaNacimiento = new DateTime($pacienteSeleccionado['fecha_nacimiento']);
        $hoy = new DateTime();
        $edad = $hoy->diff($fechaNacimiento)->y;
        $pacienteSeleccionado['edad'] = $edad;
    } else {
        $pacienteSeleccionado['edad'] = 'No disponible';
    }
}

// Manejar la carga de documentos
if (isset($_POST['upload'])) {
    if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] == UPLOAD_ERR_OK) {
        $id_paciente = $_POST['id_paciente'];
        $nombreArchivo = basename($_FILES['archivo']['name']);
        $rutaArchivo = "uploads/" . $nombreArchivo;

        if (move_uploaded_file($_FILES['archivo']['tmp_name'], $rutaArchivo)) {
            // Guardar el archivo en la base de datos
            $sqlDocumento = "INSERT INTO documentos (id_paciente, nombre_archivo, ruta) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sqlDocumento);
            $stmt->bind_param("iss", $id_paciente, $nombreArchivo, $rutaArchivo);
            $stmt->execute();
            $stmt->close();
            echo "<script>alert('Documento cargado exitosamente');</script>";
        } else {
            echo "<script>alert('Error al subir el archivo.');</script>";
        }
    } else {
        echo "<script>alert('Debe seleccionar un archivo para subir.');</script>";
    }
}

// Obtener documentos del paciente seleccionado
$documentos = [];
if ($pacienteSeleccionado) {
    $sqlDocumentos = "SELECT * FROM documentos WHERE id_paciente = ?";
    $stmt = $conn->prepare($sqlDocumentos);
    $stmt->bind_param("i", $pacienteSeleccionado['id_paciente']);
    $stmt->execute();
    $resultDocumentos = $stmt->get_result();
    while ($doc = $resultDocumentos->fetch_assoc()) {
        $documentos[] = $doc;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil del Paciente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="perfil_paciente.css">
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

    <div class="container">
        <h1 class="text-center">Perfil del Paciente</h1>

        <!-- Formulario de selección de paciente -->
        <form method="POST" action="perfil_paciente.php">
            <label for="id_paciente">Seleccione un paciente:</label>
            <select name="id_paciente" id="id_paciente" required>
                <option value="">--Seleccione--</option>
                <?php
                $sqlPacientes = "SELECT * FROM pacientes";
                $resultPacientes = $conn->query($sqlPacientes);
                while ($paciente = $resultPacientes->fetch_assoc()) {
                    $selected = ($pacienteSeleccionado && $paciente['id_paciente'] == $pacienteSeleccionado['id_paciente']) ? 'selected' : '';
                    echo "<option value='{$paciente['id_paciente']}' $selected>{$paciente['nombre']}</option>";
                }
                ?>
            </select>
            <button type="submit" class="btn btn-info btn-sm">Ver Perfil</button>
        </form>

        <!-- Información del paciente seleccionado -->
        <?php if ($pacienteSeleccionado): ?>
            <h2>Información del Paciente</h2>
            <p><strong>Nombre:</strong> <?= htmlspecialchars($pacienteSeleccionado['nombre']) ?></p>
            <p><strong>Edad:</strong> <?= htmlspecialchars($pacienteSeleccionado['edad']) ?></p>
            <p><strong>Sexo:</strong> <?= htmlspecialchars($pacienteSeleccionado['sexo']) ?></p>
            <p><strong>Teléfono:</strong> <?= htmlspecialchars($pacienteSeleccionado['telefono']) ?></p>
            <p><strong>Correo:</strong> <?= htmlspecialchars($pacienteSeleccionado['correo']) ?></p>
            <p><strong>Dirección:</strong> <?= htmlspecialchars($pacienteSeleccionado['direccion']) ?></p>
            <p><strong>No. Afiliado:</strong> <?= htmlspecialchars($pacienteSeleccionado['seguro_medico']) ?></p>

            <!-- Formulario para subir documentos -->
            <h3>Subir Documento</h3>
            <form method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id_paciente" value="<?= $pacienteSeleccionado['id_paciente'] ?>">
                <label for="archivo">Seleccione un archivo:</label>
                <input type="file" name="archivo" id="archivo" required>
                <button type="submit" name="upload" class="btn btn-info btn-sm">Subir Documento</button>
            </form>

            <!-- Listado de documentos -->
            <h3>Documentos del Paciente</h3>
            <?php if (!empty($documentos)): ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nombre del Archivo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($documentos as $doc): ?>
                            <tr>
                                <td><?= htmlspecialchars($doc['nombre_archivo']) ?></td>
                                <td>
                                    <a href="<?= htmlspecialchars($doc['ruta']) ?>" target="_blank" class="btn btn-info btn-sm">Ver</a>
                                    <a href="eliminar_documento.php?id=<?= $doc['id'] ?>&id_paciente=<?= $pacienteSeleccionado['id_paciente'] ?>" 
                                       class="btn btn-danger btn-sm" 
                                       onclick="return confirm('¿Está seguro de eliminar este documento?');">Eliminar</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No hay documentos cargados para este paciente.</p>
            <?php endif; ?>
        <?php endif; ?>
    </div>

</body>
</html>
