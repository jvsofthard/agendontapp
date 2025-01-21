<?php
// Configuración de la base de datos
$host = 'localhost';
$usuario = 'root';
$password = '';
$base_datos = 'clinica_dental';

// Archivo temporal para el respaldo
$nombre_respaldo = 'respaldo_' . date('Y-m-d_') . '.sql';

// Comando para respaldar
$comando = "C:\xampp\mysql\bin\mysqldump.exe\ --user=$usuario --password=$password --host=$host $base_datos > $nombre_respaldo";

// Ejecutar el comando
system($comando, $resultado);

// Descargar el archivo
if ($resultado === 0) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename=' . basename($nombre_respaldo));
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($nombre_respaldo));
    readfile($nombre_respaldo);

    // Eliminar el archivo temporal
    unlink($nombre_respaldo);
    exit;
} else {
    echo "Error al crear el respaldo de la base de datos.";
}
?>
