<?php
include("conexion.php");

if (isset($_GET['id_documento'])) {
    $id_documento = $_GET['id_documento'];

    // Obtener los datos del documento
    $sql = "SELECT * FROM documentos WHERE id_documento = $id_documento";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    $ruta_archivo = $row['ruta_archivo'];
    $nombre_archivo = $row['nombre_archivo'];

    // Verificar si se ha subido un nuevo archivo
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['nuevo_documento'])) {
        // Verificar si el archivo es válido
        $nuevo_documento = $_FILES['nuevo_documento'];
        if ($nuevo_documento['error'] == 0) {
            $ext = pathinfo($nuevo_documento['name'], PATHINFO_EXTENSION);
            $nuevo_nombre = "archivos/" . uniqid() . "." . $ext;
            
            // Mover el nuevo archivo
            if (move_uploaded_file($nuevo_documento['tmp_name'], $nuevo_nombre)) {
                // Eliminar el archivo anterior
                if (file_exists($ruta_archivo)) {
                    unlink($ruta_archivo);
                }

                // Actualizar la base de datos con el nuevo archivo
                $sql_update = "UPDATE documentos SET nombre_archivo = '{$nuevo_documento['name']}', ruta_archivo = '$nuevo_nombre' WHERE id_documento = $id_documento";
                if ($conn->query($sql_update) === TRUE) {
                    echo "<p>Documento reemplazado con éxito.</p>";
                    header("Location: perfil_paciente.php?id_paciente={$row['id_paciente']}");
                } else {
                    echo "<p>Error al actualizar la base de datos: " . $conn->error . "</p>";
                }
            } else {
                echo "<p>Error al mover el archivo.</p>";
            }
        } else {
            echo "<p>Error al subir el archivo.</p>";
        }
    }
} else {
    echo "<p>Error: No se ha proporcionado el ID del documento.</p>";
}
?>

<!-- Formulario de reemplazo -->
<form method="post" enctype="multipart/form-data">
    <label for="nuevo_documento">Seleccionar nuevo documento:</label>
    <input type="file" name="nuevo_documento" required>
    <button type="submit">Reemplazar</button>
</form>
