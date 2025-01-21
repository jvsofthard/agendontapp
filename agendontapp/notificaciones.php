<?php
include 'conexion.php';

$fecha_actual = date('Y-m-d');

// Consulta para obtener citas del día
$query_citas_hoy = "
    SELECT 
        citas.id_cita, 
        pacientes.nombre AS nombre_paciente, 
        citas.fecha, 
        especialistas.nombre AS nombre_especialista 
    FROM citas
    JOIN pacientes ON citas.id_paciente = pacientes.id_paciente
    JOIN especialistas ON citas.id_especialista = especialistas.id_especialista
    WHERE DATE(citas.fecha) = '$fecha_actual'
    ORDER BY citas.fecha ASC";
$result = $conn->query($query_citas_hoy);

$citas_hoy = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $citas_hoy[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($citas_hoy);
