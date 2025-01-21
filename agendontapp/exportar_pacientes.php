<?php
include 'conexion.php';

// Establecer el encabezado para que el navegador reconozca que es un archivo CSV
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="pacientes.csv"');

// Abrir el flujo de salida estándar para generar el archivo CSV
$output = fopen('php://output', 'w');

// Escribir el encabezado del archivo CSV
fputcsv($output, ['ID', 'Nombre', 'Teléfono', 'Correo', 'Fecha de Nacimiento', 'Sexo', 'No. Seguro Médico']);

// Obtener los pacientes de la base de datos
$query = "SELECT * FROM pacientes ORDER BY nombre ASC";
$result = $conn->query($query);

// Escribir los datos de los pacientes en el archivo CSV
while ($row = $result->fetch_assoc()) {
    fputcsv($output, [
        $row['id_paciente'],
        $row['nombre'],
        $row['telefono'],
        $row['correo'],
        $row['fecha_nacimiento'],
        $row['sexo'],
        $row['seguro_medico']
    ]);
}

// Cerrar el flujo de salida
fclose($output);
?>
