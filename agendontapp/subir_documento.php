<?php
include 'conexion.php';

session_start();
require_once 'funciones.php';

$usuario = $_SESSION['username'];
$rol = $_SESSION['rol'];
$accion = "Documento subido al usuario ID " . $_GET['id'];

registrarAuditoria($usuario, $rol, $accion);

// Código para eliminar la cita
echo "Documento Subido.";


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['documento'])) {
    $id_paciente = $_GET['id_paciente'];

    // Validar si se ha subido un archivo
    if ($_FILES['documento']['error'] == 0) {
        $nombre_archivo = $_FILES['documento']['name'];
        $ruta_temporal = $_FILES['documento']['tmp_name'];
        $ruta_destino = "uploads/" . $nombre_archivo;

        // Mover el archivo a la carpeta de documentos
        if (move_uploaded_file($ruta_temporal, $ruta_destino)) {
            // Guardar la ruta del documento en la base de datos
            $query = "INSERT INTO documentos (id_paciente, nombre_archivo, ruta) VALUES ($id_paciente, '$nombre_archivo', '$ruta_destino')";
            if ($conn->query($query)) {
                echo "Documento cargado exitosamente.";
            } else {
                echo "Error al guardar el documento en la base de datos.";
            }
        } else {
            echo "Error al mover el archivo.";
        }
    } else {
        echo "Error al subir el archivo.";
    }
}
?>
