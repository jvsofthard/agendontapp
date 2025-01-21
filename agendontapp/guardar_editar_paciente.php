<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_paciente = $_POST['id_paciente'];
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $direccion = $_POST['direccion'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $sexo = $_POST['sexo'];
    $seguro_medico = $_POST['seguro_medico'];

    // Actualizar la información del paciente
    $query = "UPDATE pacientes 
              SET nombre = '$nombre', telefono = '$telefono', correo = '$correo', 
                  direccion = '$direccion', fecha_nacimiento = '$fecha_nacimiento', 
                  sexo = '$sexo', seguro_medico = '$seguro_medico' 
              WHERE id_paciente = $id_paciente";

    if ($conn->query($query) === TRUE) {
        echo "Paciente actualizado correctamente";
        header("Location: index.php");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
