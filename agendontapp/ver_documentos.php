<?php
include 'conexion.php';

// Obtener documentos
$sql_documentos = "SELECT * FROM documentos INNER JOIN pacientes ON documentos.id_paciente = pacientes.id_paciente";
$resultado_documentos = $conn->query($sql_documentos);
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Documentos</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

</head>
<body>

<h1 class="text-center">Lista de Documentos Subidos</h1>

<table class="info-documentos">
    <thead>
        <tr>
            <th>Paciente</th>
            <th>Tipo de Documento</th>
            <th>Nombre del Archivo</th>
            <th>Ver Archivo</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($documento = $resultado_documentos->fetch_assoc()): ?>
            <tr>
                <td><?php echo $documento['nombre']; ?></td>
                <td><?php echo $documento['tipo_documento']; ?></td>
                <td><?php echo $documento['nombre_archivo']; ?></td>
                <td><a href="<?php echo $documento['ruta_archivo']; ?>" target="_blank">Ver</a></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>
<footer></footer>
</body>
</html>
