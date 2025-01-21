<!-- CITAS -->

<?php
// Conexión a la base de datos
$conexion = new mysqli('localhost', 'root', '', 'clinica_dental');

// Verificar la conexión
if ($conexion->connect_error) {
    die('Error de conexión: ' . $conexion->connect_error);
}

// Variables para el rango de fechas
$fecha_inicio = $_POST['fecha_inicio'] ?? '';
$fecha_fin = $_POST['fecha_fin'] ?? '';

// Consultar las citas agrupadas por día, con filtro de fechas si se especifica
if (!empty($fecha_inicio) && !empty($fecha_fin)) {
    $query = "SELECT DATE(fecha) AS dia, COUNT(*) AS total 
              FROM citas 
              WHERE DATE(fecha) BETWEEN '$fecha_inicio' AND '$fecha_fin'
              GROUP BY DATE(fecha)";
} else {
    $query = "SELECT DATE(fecha) AS dia, COUNT(*) AS total 
              FROM citas 
              GROUP BY DATE(fecha)";
}

$resultado = $conexion->query($query);

// Preparar los datos para el gráfico
$dias = [];
$totales = [];

while ($fila = $resultado->fetch_assoc()) {
    $dias[] = $fila['dia'];
    $totales[] = $fila['total'];
}

// Convertir los datos a formato JSON para JavaScript
$dias_json = json_encode($dias);
$totales_json = json_encode($totales);

$conexion->close();



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
            <a class="navbar-brand" href="#">DentalSys</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="lista_pacientes.php">Pacientes</a></li>
                    <li class="nav-item"><a class="nav-link" href="lista_citas.php">Citas</a></li>
                    <li class="nav-item"><a class="nav-link" href="lista_especialistas.php">Especialistas</a></li>
                    <li class="nav-item"><a class="nav-link" href="registrar_paciente.php">Registrar Paciente</a></li>
                    <li class="nav-item"><a class="nav-link" href="registrar_cita.php">Registrar Cita</a></li>
                    <li class="nav-item"><a class="nav-link" href="registrar_especialista.php">Registrar Especialista</a></li>
                    <li class="nav-item"><a class="nav-link" href="reportes.php">Reportes</a></li>
                    <li class="nav-item"><a class="nav-link" href="configuracion.php">Configuracion</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php" style="color: #fff; font-weight: bold;">Cerrar Sesion</a></li>
                </ul>
            </div>
        </div>
    </nav>

<?php 
session_start();
if (!isset($_SESSION['rol'])) {
    header("Location: login.php");
    exit;
}

$rol = $_SESSION['rol'];

echo "<h1>Bienvenido, " . $_SESSION['username'] . "!</h1>";

switch ($rol) {
    case 'admin':
    echo "<a href='cambiar_contrasena.php' class='boton'> Cambiar Contraseña </a>";
        break;

    case 'recepcionista':
     echo "<a href='cambiar_contrasena.php' class='boton'> Cambiar Contraseña </a>";
        break;

    case 'especialista':
     echo "<a href='cambiar_contrasena.php' class='boton'> Cambiar Contraseña </a>";
        break;

    default:
        echo "Rol no reconocido.";
}
 ?>

    <div class="container mt-5">
        <h1 class="text-center">Bienvenido a DentalSys</h1>

       <!-- Slider de Notificaciones -->

        <div id="notificaciones" class="slider-container">
            <p>Recordatorio hoy!</p>
            <div class="slider-content"></div>
        </div>


        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">Perfil Pacientes</h5>
                        <p class="card-text">Ver completo la informacion de tus pacientes.</p>
                        <a href="perfil_paciente.php" class="btn btn-primary">Ver Pacientes</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">Citas</h5>
                        <p class="card-text">Administra y programa citas odontológicas.</p>
                        <a href="lista_citas.php" class="btn btn-primary">Ver Citas</a>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="col-md-6">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">Perfil Especialista</h5>
                        <p class="card-text">Ver completo la informacion de los especialista.</p>
                        <a href="perfil_especialista.php" class="btn btn-primary">Ver Citas</a>
                    </div>
                </div>
            </div>


<div style="width: 40%; margin: auto; padding: 20px;">
    <form method="POST" action="">
        <div style="display: flex; justify-content: center; gap: 10px; margin-bottom: 20px;">
            <input type="date" name="fecha_inicio" value="<?php echo $fecha_inicio; ?>" required>
            <input type="date" name="fecha_fin" value="<?php echo $fecha_fin; ?>" required>
            <button type="submit" style="padding: 10px 20px; background-color: #007BFF; color: white; border: none; border-radius: 5px; cursor: pointer;">
                Filtrar
            </button>
        </div>
    </form>
</div>

    <!-- GRACIFO -->
    <div style="width: 50%; margin: auto; padding: 20px;">
    <h2 class="text-center">Citas por Día</h2>
    <canvas id="graficoCitas"></canvas>
</div>

<script>
    // Obtener los datos desde PHP
    const dias = <?php echo $dias_json; ?>;
    const totales = <?php echo $totales_json; ?>;

    // Configurar el gráfico
    const ctx = document.getElementById('graficoCitas').getContext('2d');
    const graficoCitas = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: dias,
            datasets: [{
                label: 'Número de Citas',
                data: totales,
                backgroundColor: 'rgba(0, 123, 255, 0.7)',
                borderColor: 'rgba(0, 123, 255, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                }
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Días'
                    }
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Cantidad de Citas'
                    }
                }
            }
        }
    });


        //NOTIFICACION DE CITAS

       let notificacionesPrevias = [];
        let indiceActual = 0;

        function reproducirSonido() {
            const audio = new Audio('audio/notificacion.mp3');
            audio.play();
        }

        function actualizarSlider(citas) {
            const sliderContent = document.querySelector('.slider-content');
            sliderContent.innerHTML = ''; // Limpiar contenido

            citas.forEach(cita => {
                const notificacion = document.createElement('div');
                notificacion.className = 'slider-item alert alert-info';
                notificacion.innerHTML = `
                    <strong>${cita.nombre_paciente}</strong> tiene una cita con 
                    <strong>${cita.nombre_especialista}</strong> a las 
                    ${new Date(cita.fecha).toLocaleTimeString()}.
                `;
                sliderContent.appendChild(notificacion);
            });
            
            // Reiniciar el índice para evitar desbordamientos
            indiceActual = 0;
            mostrarNotificacionActual();
        }
        
        function mostrarNotificacionActual() {
            const sliderContent = document.querySelector('.slider-content');
            const items = document.querySelectorAll('.slider-item');
            if (items.length > 0) {
                sliderContent.style.transform = `translateX(-${indiceActual * 100}%)`;
                indiceActual = (indiceActual + 1) % items.length;
            }
        }

        function obtenerNotificaciones() {
            fetch('notificaciones.php')
                .then(response => response.json())
                .then(citas => {
                    if (JSON.stringify(notificacionesPrevias) !== JSON.stringify(citas)) {
                        reproducirSonido(); // Suena si hay cambios
                        notificacionesPrevias = citas; // Actualizar estado
                        actualizarSlider(citas); // Actualizar slider
                    }
                })
                .catch(error => console.error('Error al obtener notificaciones:', error));
        }

        // Actualizar el slider cada X segundos
        setInterval(mostrarNotificacionActual, 5000); // Cambiar cada 5 segundos
        // Obtener las notificaciones cada 5 minutos
        setInterval(obtenerNotificaciones, 300000); // Cada 5 minutos
        obtenerNotificaciones(); // Llamada inicial
</script>



</body>
</html>
