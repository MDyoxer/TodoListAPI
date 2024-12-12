<?php 
require_once 'includes/api-tarea.php';
parse_str(file_get_contents("php://input"), $_PUT);

if($_SERVER['REQUEST_METHOD'] === 'PUT' && isset($_GET['id']) && isset($_PUT['nombre']) && isset($_PUT['descripcion']) && isset($_PUT['fecha']) && isset($_PUT['estado'])){
    $id = $_GET['id'];
    $nombre = $_PUT['nombre'];
    $descripcion = $_PUT['descripcion'];
    $fecha = $_PUT['fecha'];
    $estado = $_PUT['estado'];

    Tarea::EditarTareas($id,$nombre,$descripcion,$fecha,$estado);


}else{
    header('HTTP/1.1 400 Bad Request');
    echo json_encode(['message' => 'datos no proporcionados o método no válido']);
}
?>