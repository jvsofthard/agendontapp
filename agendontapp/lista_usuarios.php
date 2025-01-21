<?php
require_once 'conexion.php';
session_start();

// Verificar si el usuario es administrador
if ($_SESSION['rol'] !== 'admin') {
    header('Location: index.php');
    exit;
}

// Obtener usuarios, incluyendo el estado
$sql = "SELECT id, username, rol, estado FROM usuarios"; 
$result = $conn->query($sql);

// Mostrar mensajes de sesión
if (isset($_SESSION['mensaje'])): ?>
    <div class="alert alert-info text-center">
        <?= htmlspecialchars($_SESSION['mensaje']) ?>
    </div>
    <?php unset($_SESSION['mensaje']); ?>
<?php endif; 

// CODIGO PARA AUDITORIA
require_once 'funciones.php';

$usuario = $_SESSION['username'];
$rol = $_SESSION['rol'];
$accion = "Cambio Status usuario";

registrarAuditoria($usuario, $rol, $accion);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
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
    <div class="container mt-4">
        <h1 class="text-center">Lista de Usuarios</h1>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Rol</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($usuario = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($usuario['id']) ?></td>
                        <td><?= htmlspecialchars($usuario['username']) ?></td>
                        <td><?= htmlspecialchars($usuario['rol']) ?></td>
                        <td>
                            <span class="badge bg-<?= $usuario['estado'] === 'activo' ? 'success' : 'secondary' ?>">
                                <?= ucfirst($usuario['estado']) ?>
                            </span>
                        </td>
                        <td>
                            <!-- Botón para eliminar -->
                            <form action="eliminar_usuario.php" method="POST" style="display: inline;">
                                <input type="hidden" name="id_usuario" value="<?= $usuario['id'] ?>">
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>

                            <!-- Botón para cambiar estado -->
                            <form action="cambiar_estado_usuario.php" method="POST" style="display: inline;">
                                <input type="hidden" name="id_usuario" value="<?= $usuario['id'] ?>">
                                <?php if ($usuario['estado'] === 'activo'): ?>
                                    <button type="submit" name="accion" value="inactivar" class="btn btn-warning btn-sm">Inactivar</button>
                                <?php else: ?>
                                    <button type="submit" name="accion" value="activar" class="btn btn-success btn-sm">Activar</button>
                                <?php endif; ?>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    
</body>
</html>
