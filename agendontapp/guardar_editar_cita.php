<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_cita = $_POST['id_cita'];
    $paciente = $_POST['paciente'];
    $especialista = $_POST['especialista'];
    $fecha_cita = $_POST['fecha_cita'];
    $motivo = $_POST['motivo'];
    $tipo_tratamiento = $_POST['tipo_tratamiento'];

    // Actualizar la información de la cita
    $query = "UPDATE citas 
              SET id_paciente = '$paciente', id_especialista = '$especialista', fecha = '$fecha_cita', 
                  motivo = '$motivo', tipo_tratamiento = '$tipo_tratamiento' 
              WHERE id_cita = $id_cita";

    if ($conn->query($query) === TRUE) {
        echo "Cita actualizada correctamente";
        header("Location: index.php");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
