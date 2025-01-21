<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $direccion = $_POST['direccion'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $sexo = $_POST['sexo'];
    $seguro_medico = $_POST['seguro_medico'];

    // Insertar datos en la tabla de pacientes
    $query = "INSERT INTO pacientes (nombre, telefono, correo, direccion, fecha_nacimiento, sexo, seguro_medico) 
              VALUES ('$nombre', '$telefono', '$correo', '$direccion', '$fecha_nacimiento', '$sexo', '$seguro_medico')";
    
    if ($conn->query($query) === TRUE) {
        echo "Paciente registrado exitosamente";
        header("Location: index.php");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
