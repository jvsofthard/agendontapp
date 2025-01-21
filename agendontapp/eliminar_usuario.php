<?php
require_once 'conexion.php';
session_start();

// Verificar si el usuario es administrador
if ($_SESSION['rol'] !== 'admin') {
    header('Location: index.php');
    exit;
}

// Verificar si se recibió el ID del usuario
if (isset($_POST['id_usuario'])) {
    $id_usuario = $_POST['id_usuario'];

    // Preparar y ejecutar la consulta para eliminar al usuario
    $sql = "DELETE FROM usuarios WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_usuario);

    if ($stmt->execute()) {
        // Redirigir a la lista de usuarios con un mensaje de éxito
        $_SESSION['mensaje'] = "Usuario eliminado exitosamente.";
    } else {
        // Redirigir a la lista de usuarios con un mensaje de error
        $_SESSION['mensaje'] = "Error al eliminar el usuario.";
    }

    $stmt->close();
    $conn->close();
    header('Location: lista_usuarios.php');
    exit;
} else {
    // Si no se recibe un ID, redirigir con un mensaje de error
    $_SESSION['mensaje'] = "No se recibió un ID de usuario válido.";
    header('Location: lista_usuarios.php');
    exit;
}
?>
