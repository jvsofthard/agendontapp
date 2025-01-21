<?php
// Datos de conexión
$servidor = "localhost";
$usuario = "root";
$password = "";
$base_datos = "clinica_dental";

// Crear conexión
$conn = new mysqli($servidor, $usuario, $password, $base_datos);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Si todo está OK, podemos usar esta conexión
?>
