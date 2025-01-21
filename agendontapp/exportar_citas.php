<?php
// Incluir conexión a la base de datos
include 'conexion.php';

// Consultar las citas
$query = "SELECT c.id_cita, p.nombre AS paciente, e.nombre AS especialista, c.fecha, c.motivo, c.tipo_tratamiento 
          FROM citas c
          INNER JOIN pacientes p ON c.id_paciente = p.id_paciente
          INNER JOIN especialistas e ON c.id_especialista = e.id_especialista";
$result = $conn->query($query);

// Crear el contenido del archivo CSV
$output = fopen("php://output", "w"); // Abrir flujo de salida
if ($output) {
    // Configuración de cabeceras
    header("Content-Type: text/csv");
    header("Content-Disposition: attachment; filename=citas.csv");

    // Escribir encabezados de columnas en el archivo CSV
    fputcsv($output, ["ID Cita", "Paciente", "Especialista", "Fecha", "Motivo", "Tipo de Tratamiento"]);

    // Escribir los datos en el archivo CSV
    while ($row = $result->fetch_assoc()) {
        fputcsv($output, [$row['id_cita'], $row['paciente'], $row['especialista'], $row['fecha'], $row['motivo'], $row['tipo_tratamiento']]);
    }

    fclose($output); // Cerrar el flujo
    exit();
} else {
    echo "Error al generar el archivo CSV.";
}
?>
