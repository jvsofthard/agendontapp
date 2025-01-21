<?php
require_once 'conexion.php';
session_start();

// Verificar si el usuario es administrador
if ($_SESSION['rol'] !== 'admin') {
    header('Location: index.php');
    exit;
}

// Verificar si se recibió el ID y la acción
if (isset($_POST['id_usuario']) && isset($_POST['accion'])) {
    $id_usuario = $_POST['id_usuario'];
    $accion = $_POST['accion'];

    // Determinar el nuevo estado
    $nuevo_estado = ($accion === 'inactivar') ? 'inactivo' : 'activo';

    // Actualizar el estado del usuario
    $sql = "UPDATE usuarios SET estado = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $nuevo_estado, $id_usuario);

    if ($stmt->execute()) {
        $_SESSION['mensaje'] = "Usuario actualizado exitosamente.";
    } else {
        $_SESSION['mensaje'] = "Error al actualizar el usuario.";
    }

    $stmt->close();
    $conn->close();
    header('Location: lista_usuarios.php');
    exit;
} else {
    $_SESSION['mensaje'] = "Datos insuficientes para realizar la operación.";
    header('Location: lista_usuarios.php');
    exit;
}
?>
