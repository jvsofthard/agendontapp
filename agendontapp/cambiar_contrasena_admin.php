<?php
session_start();
require_once 'conexion.php';

// Verificar que el usuario sea un administrador
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'admin') {
    // Redirigir al inicio si no es admin
    header("Location: login.php");
    exit;
}

$message = '';
$show_modal = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $new_password = $_POST['new_password'];

    // Buscar usuario por nombre de usuario
    $sql = "SELECT id FROM usuarios WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Encriptar la nueva contraseña
        $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

        // Actualizar la contraseña del usuario
        $sql = "UPDATE usuarios SET password = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $hashed_password, $user['id']);
        if ($stmt->execute()) {
            $message = 'La contraseña del usuario ha sido cambiada exitosamente.';
            $show_modal = true;
        } else {
            $message = 'Hubo un error al cambiar la contraseña.';
            $show_modal = true;
        }
    } else {
        $message = 'Usuario no encontrado.';
        $show_modal = true;
    }
    $stmt->close();
}

// Obtener todos los usuarios para el select
$sql = "SELECT username FROM usuarios";
$result = $conn->query($sql);
$users = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row['username'];
}
}
//para la auditoria
require_once 'funciones.php';

$usuario = $_SESSION['username'];
$rol = $_SESSION['rol'];
$accion = "Cambio contraseña a usuario";

registrarAuditoria($usuario, $rol, $accion);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cambiar Contraseña de Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">DentalSys</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="configuracion.php">Volver a Configuracion</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <h1>Cambiar Contraseña de Usuario</h1>
    <form method="POST" action="cambiar_contrasena_admin.php">
        <label for="username">Seleccionar usuario:</label>
        <select name="username" id="username" required>
            <option value="">Selecciona un usuario</option>
            <?php foreach ($users as $user): ?>
                <option value="<?php echo $user; ?>"><?php echo $user; ?></option>
            <?php endforeach; ?>
        </select><br><br>
        
        <label for="new_password">Nueva contraseña:</label>
        <input type="password" name="new_password" id="new_password" required><br><br>
        
        <button type="submit" class="btn btn-primary">Cambiar contraseña</button>
    </form>

    <!-- Modal -->
    <?php if ($show_modal): ?>
    <div class="modal fade show" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="messageModalLabel">Resultado de la acción</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php echo $message; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
