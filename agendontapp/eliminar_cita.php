<?php
include 'conexion.php';

session_start();
require_once 'funciones.php';

$usuario = $_SESSION['username'];
$rol = $_SESSION['rol'];
$accion = "Eliminó la cita con ID " . $_GET['id'];

registrarAuditoria($usuario, $rol, $accion);

// Código para eliminar la cita
echo "Cita eliminada.";


if (isset($_GET['id'])) {
    $id_cita = $_GET['id'];

    // Eliminar la cita
    $query = "DELETE FROM citas WHERE id_cita = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_cita);

    if ($stmt->execute()) {
        header("Location: lista_citas.php");
        exit();
    } else {
        echo "Error al eliminar la cita.";
    }
} else {
    header("Location: lista_citas.php");
    exit();
}


?>
