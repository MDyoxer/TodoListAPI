<?php 
    require_once 'includes/api-tarea.php';

    if($_SERVER['REQUEST_METHOD'] === 'DELETE' && isset($_GET['id'])){
        $id = $_GET['id'];
        Tarea::EliminarTarea($id);

    } else {
    header('HTTP/1.1 400 Solicitud inválida');
    echo json_encode(['message' => 'ID no proporcionado o método no válido']);
}
?>