<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $paciente = $_POST['paciente'];
    $especialista = $_POST['especialista'];
    $fecha_cita = $_POST['fecha_cita'];
    $motivo = $_POST['motivo'];
    $tipo_tratamiento = $_POST['tipo_tratamiento'];

    // Insertar datos en la tabla de citas
    $query = "INSERT INTO citas (id_paciente, id_especialista, fecha, motivo, tipo_tratamiento) 
              VALUES ('$paciente', '$especialista', '$fecha_cita', '$motivo', '$tipo_tratamiento')";
    
    if ($conn->query($query) === TRUE) {
        echo "Cita registrada exitosamente";
        header("Location: index.php");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
