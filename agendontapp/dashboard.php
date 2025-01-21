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
        echo "<p>Eres administrador. Puedes gestionar usuarios, citas, y reportes.</p>";
        echo "<a href='gestionar_usuarios.php'>Gestionar Usuarios</a>";
        echo "<a href='reportes.php'>Ver Reportes</a>";
        break;

    case 'recepcionista':
        echo "<p>Eres recepcionista. Puedes gestionar citas y reportes básicos.</p>";
        echo "<a href='citas.php'>Gestionar Citas</a>";
        echo "<a href='reportes.php'>Ver Reportes</a>";
        break;

    case 'especialista':
        echo "<p>Eres especialista. Aquí están tus citas.</p>";
        echo "<a href='mis_citas.php'>Ver Mis Citas</a>";
        break;

    default:
        echo "Rol no reconocido.";
}
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Clínica Dental</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<div class="container">
    <h1>Dashboard Clínica Dental</h1>
    <!-- Filtro de Fecha -->
    <form class="filter-form">
        <label for="fecha_inicio">Fecha Inicio:</label>
        <input type="date" name="fecha_inicio" id="fecha_inicio">
        <label for="fecha_fin">Fecha Fin:</label>
        <input type="date" name="fecha_fin" id="fecha_fin">
        <button type="submit">Filtrar</button>
    </form>

    <!-- Alertas -->
    <div id="alerts"></div>

    <!-- Tarjetas de estadísticas -->
    <div class="stats">
        <div class="card">Pacientes Totales: 150</div>
        <div class="card">Ingresos Mensuales: $5000</div>
        <div class="card">Citas del Día: 5</div>
    </div>

    <!-- Gráficos -->
    <div class="charts">
        <div class="chart-container">
            <h3>Total de Citas por Día</h3>
            <canvas id="citasChart"></canvas>
        </div>
        <div class="chart-container">
            <h3>Total de Pacientes por Edad</h3>
            <canvas id="pacientesChart"></canvas>
        </div>
    </div>
</div>

<script src="js/dashboard.js"></script>
</body>
</html>
