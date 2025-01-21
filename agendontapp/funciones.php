<?php
function verificarAcceso($rolRequerido) {
    session_start();

    // Verificar si el usuario está autenticado
    if (!isset($_SESSION['rol'])) {
        header("Location: login.php");
        exit;
    }

    // Verificar si el usuario tiene el rol necesario
    if ($_SESSION['rol'] !== $rolRequerido) {
        echo "No tienes permiso para acceder a esta página.";
        exit;
    }
}


//FUNCION AUDITORIA
function registrarAuditoria($usuario, $rol, $accion) {
    $conn = new mysqli("localhost", "root", "", "clinica_dental");

    if ($conn->connect_error) {
        die("Error en la conexión: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO auditoria (usuario, rol, accion) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $usuario, $rol, $accion);

    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
    } else {
        echo "Error al registrar auditoría: " . $stmt->error;
    }
}

?>
