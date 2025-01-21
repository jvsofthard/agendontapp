<?php
include 'conexion.php'; // Conexión a la base de datos

session_start();
require_once 'funciones.php';

$usuario = $_SESSION['username'];
$rol = $_SESSION['rol'];
$accion = "Eliminó la paciente con ID " . $_GET['id'];

registrarAuditoria($usuario, $rol, $accion);

// Código para eliminar la cita
echo "Cita eliminada.";


// Obtener ID del paciente
$id = $_GET['id'] ?? null;

// Eliminar el paciente
if ($id) {
    $sql = "DELETE FROM pacientes WHERE id_paciente = $id";
    if ($conn->query($sql)) {
        header('Location: lista_pacientes.php'); // Redirigir al listado de pacientes
        exit;
    } else {
        echo "Error al eliminar: " . $conn->error;
    }
}
?>
