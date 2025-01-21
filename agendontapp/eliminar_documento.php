<?php
require_once 'conexion.php';

session_start();
require_once 'funciones.php';

$usuario = $_SESSION['username'];
$rol = $_SESSION['rol'];
$accion = "Eliminó Documento del usuario ID " . $_GET['id'];

registrarAuditoria($usuario, $rol, $accion);

// Código para eliminar la cita
echo "Documento eliminada.";


// Verificar si se recibió el parámetro id y id_paciente
if (isset($_GET['id']) && isset($_GET['id_paciente'])) {
    $id_documento = $_GET['id'];
    $id_paciente = $_GET['id_paciente'];

    // Obtener la ruta del archivo para eliminarlo físicamente
    $sql = "SELECT ruta FROM documentos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_documento);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Obtener la ruta del archivo
        $documento = $result->fetch_assoc();
        $rutaArchivo = $documento['ruta'];

        // Intentar eliminar el archivo físicamente
        if (file_exists($rutaArchivo)) {
            unlink($rutaArchivo);  // Eliminar el archivo
        }

        // Eliminar el registro del documento en la base de datos
        $sqlDelete = "DELETE FROM documentos WHERE id = ?";
        $stmtDelete = $conn->prepare($sqlDelete);
        $stmtDelete->bind_param("i", $id_documento);
        if ($stmtDelete->execute()) {
            // Mostrar mensaje y mantener en la misma página
            echo "<script>alert('Documento eliminado exitosamente.');</script>";
            echo "<script>window.location.href = 'perfil_paciente.php?id_paciente=$id_paciente';</script>";
        } else {
            echo "<script>alert('Error al eliminar el documento de la base de datos.');</script>";
        }
    } else {
        echo "<script>alert('No se encontró el documento.');</script>";
    }

    $stmt->close();
} else {
    echo "<script>alert('Faltan parámetros para eliminar el documento.');</script>";
}

?>
