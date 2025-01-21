<?php
include 'conexion.php';
require 'fpdf/fpdf.php';

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

// Crear PDF
$pdf = new FPDF('l');
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 10, 'Reporte de Citas', 0, 1, 'C');
$pdf->Ln(10);

// Encabezados de la tabla
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(10, 10, 'ID', 1);
$pdf->Cell(50, 10, 'Paciente', 1);
$pdf->Cell(50, 10, 'Especialista', 1);
$pdf->Cell(30, 10, 'Fecha', 1);
$pdf->Cell(50, 10, 'Motivo', 1);
$pdf->Cell(50, 10, 'tipo_tratamiento', 1);
$pdf->Ln();

// Datos de la tabla
$pdf->SetFont('Arial', '', 10);
while ($row = $result->fetch_assoc()) {
    $pdf->Cell(10, 10, $row['id_cita'], 1);
    $pdf->Cell(50, 10, $row['nombre_paciente'], 1);
    $pdf->Cell(50, 10, $row['nombre_especialista'], 1);
    $pdf->Cell(30, 10, date("d/m/Y H:i", strtotime($row['fecha'])), 1);
    $pdf->Cell(50, 10, $row['motivo'], 1);
    $pdf->Cell(50, 10, $row['tipo_tratamiento'], 1);
    $pdf->Ln();
}

// Salida del PDF
$pdf->Output('D', 'reporte_citas.pdf');
exit;
?>
