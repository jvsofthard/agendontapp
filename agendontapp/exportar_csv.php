<?php
include 'conexion.php';

// Recibir filtros desde la URL
$filtro_especialista = isset($_GET['especialista']) ? $_GET['especialista'] : '';
$filtro_fecha = isset($_GET['fecha']) ? $_GET['fecha'] : '';

// Generar la consulta SQL con filtros
$query = "
    SELECT 
        citas.id_cita, 
        pacientes.nombre AS nombre_paciente, 
        especialistas.nombre AS nombre_especialista, 
        citas.fecha, 
        citas.motivo,
        citas.tipo_tratamiento 
    FROM citas
    JOIN pacientes ON citas.id_paciente = pacientes.id_paciente
    JOIN especialistas ON citas.id_especialista = especialistas.id_especialista
    WHERE 1=1";

if (!empty($filtro_especialista)) {
    $query .= " AND especialistas.id_especialista = '$filtro_especialista'";
}
if (!empty($filtro_fecha)) {
    $query .= " AND DATE(citas.fecha) = '$filtro_fecha'";
}

$query .= " ORDER BY citas.fecha DESC";
$result = $conn->query($query);

// Configurar encabezados para descargar el archivo
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="reporte_citas.csv"');

// Abrir el buffer de salida
$output = fopen('php://output', 'w');

// Escribir encabezados al CSV
fputcsv($output, ['ID', 'Paciente', 'Especialista', 'Fecha', 'Motivo', 'tipo_tratamiento']);

// Escribir los datos al CSV
while ($row = $result->fetch_assoc()) {
    fputcsv($output, [
        $row['id_cita'],
        $row['nombre_paciente'],
        $row['nombre_especialista'],
        date("d/m/Y H:i", strtotime($row['fecha'])),
        $row['motivo'],
        $row['tipo_tratamiento']
    ]);
}

// Cerrar el buffer de salida
fclose($output);
exit;
?>
