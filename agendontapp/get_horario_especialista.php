<?php
include 'conexion.php';

if (isset($_GET['id_especialista'])) {
    $id_especialista = $_GET['id_especialista'];

    $query = "SELECT tanda, hora_inicio, hora_fin FROM especialistas WHERE id_especialista = $id_especialista";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        echo json_encode($data);
    } else {
        echo json_encode(['error' => 'Especialista no encontrado']);
    }
} else {
    echo json_encode(['error' => 'ID de especialista no proporcionado']);
}
?>
