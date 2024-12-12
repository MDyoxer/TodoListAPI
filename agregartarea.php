<?php
require_once 'includes/api-tarea.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);

    if (isset($input['nombre'], $input['descripcion'], $input['fecha'])) {
        $nombre = $input['nombre'];
        $descripcion = $input['descripcion'];  
        $fecha = $input['fecha']; 
        $estado = isset($input['estado']) ? $input['estado'] : 0;

        Tarea::crear_tarea($nombre, $descripcion, $fecha, $estado);
    } else {
        header('HTTP/1.1 400 Solicitud inválida');
        echo json_encode(['message' => 'Datos incompletos']);
        exit;
    }
} else {
    header('HTTP/1.1 405 Método no permitido');
    echo json_encode(['message' => 'Método no permitido']);
    exit;
}
?>