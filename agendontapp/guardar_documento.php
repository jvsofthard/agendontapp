<?php
// Conexión a la base de datos
include('conexion.php');

// Verificar si se ha enviado el formulario
if (isset($_POST['id_paciente'], $_POST['tipo_documento'], $_FILES['documento'])) {
    $id_paciente = $_POST['id_paciente'];
    $tipo_documento = $_POST['tipo_documento'];
    $documento = $_FILES['documento'];

    // Obtener nombre del archivo y tipo
    $nombre_documento = $documento['name'];
    $ruta_documento = 'uploads/' . $nombre_documento;  // La carpeta donde se almacenará el archivo

    // Mover el archivo a la carpeta de uploads
    if (move_uploaded_file($documento['tmp_name'], $ruta_documento)) {
        // Insertar en la base de datos
        $fecha_subida = date('Y-m-d H:i:s');
        $query = "INSERT INTO documentos (id_paciente, nombre_documento, tipo_documento, ruta_documento, fecha_subida)
                  VALUES ('$id_paciente', '$nombre_documento', '$tipo_documento', '$ruta_documento', '$fecha_subida')";
        
        if ($conn->query($query)) {
            echo "Documento subido y registrado con éxito.";
        } else {
            echo "Error al registrar el documento en la base de datos.";
        }
    } else {
        echo "Error al subir el archivo.";
    }
} else {
    echo "Por favor, complete todos los campos.";
}
?>
