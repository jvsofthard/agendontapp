<?php
include 'conexion.php';

require_once 'funciones.php';
verificarAcceso('admin');

// Si está autenticado, muestra el contenido
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">DentalSys</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="lista_pacientes.php">Pacientes</a></li>
                    <li class="nav-item"><a class="nav-link" href="lista_citas.php">Citas</a></li>
                    <li class="nav-item"><a class="nav-link" href="registrar_paciente.php">Registrar Paciente</a></li>
                    <li class="nav-item"><a class="nav-link" href="registrar_cita.php">Registrar Cita</a></li>
                    <li class="nav-item"><a class="nav-link" href="registrar_especialista.php">Registrar Especialista</a></li>
                    <li class="nav-item"><a class="nav-link" href="reportes.php">Reportes</a></li>
                    <li class="nav-item"><a class="nav-link" href="configuracion.php">Configuracion</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h1 class="text-center">DentalSys</h1>
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="card">
                         <div class="card-body text-center">
                            <h5 class="card-title">BACKUP DB</h5>
                            <p class="card-text">Gestiona de Respaldo de Base de Dato</p>
                            <a href="respaldar_db.php" class="btn btn-primary">Respaldar DB</a>
                         </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                         <div class="card-body text-center">
                            <h5 class="card-title">AUDITORIA</h5>
                            <p class="card-text">Puedes ver la accion de cada usuario/rol</p>
                            <a href="auditoria.php" class="btn btn-primary">Ver Auditoria</a>
                         </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="card">
                         <div class="card-body text-center">
                            <h5 class="card-title">CREAR ROLES</h5>
                            <p class="card-text">Gestiona los usuario y especialista</p>
                            <a href="registro.php" class="btn btn-primary">Registrar Usuario</a>
                         </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                         <div class="card-body text-center">
                            <h5 class="card-title">CAMBIAR CONTRASEÑA</h5>
                            <p class="card-text">Cambiar contraseña de incio de sesion de usuarios</p>
                            <a href="cambiar_contrasena_admin.php" class="btn btn-primary">Hacer Cambio</a>
                         </div>
                    </div>
                </div>
               <div class="row mt-4">
                <div class="col-md-6">
                    <div class="card">
                         <div class="card-body text-center">
                            <h5 class="card-title">MANTENIMIENTO USUARIO</h5>
                            <p class="card-text">Eliminar o inactivar usuario</p>
                            <a href="lista_usuarios.php" class="btn btn-primary">Ver Lista</a>
                         </div>
                    </div>
                </div> 
    </div>

    <div class="logout-card">
        <a href="logout.php" class="logout">Cerrar sesión</a>
    </div>
</body>
</html>
