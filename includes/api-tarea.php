
<?php
require_once __DIR__ . '/../conn/conn.php';

class Tarea {
    // Método para crear una nueva tarea
    public static function crear_tarea($nombre, $descripcion, $fecha, $estado) {
        $database = new Database();
        $pdo = $database->getConnection();

        try {
            $stmt = $pdo->prepare('INSERT INTO tareas (nombre, descripcion, fecha, estado) VALUES (:nombre, :descripcion, :fecha, :estado)');
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':fecha', $fecha);
            $stmt->bindParam(':estado', $estado);

            // Ejecutamos la consulta
            if ($stmt->execute()) {
                header('HTTP/1.1 201 Tarea enviada correctamente');
                echo json_encode(['message' => 'Tarea enviada correctamente']);
            } else {
                header('HTTP/1.1 400 Tarea no enviada correctamente');
                echo json_encode(['message' => 'Tarea no enviada correctamente']);
            }
        } catch (PDOException $e) {
            header('HTTP/1.1 500 Error del servidor');
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    // Mostrar todas las tareas
    public static function MostrarTareas() {
        $database = new Database();
        $pdo = $database->getConnection();

        try {
            $stmt = $pdo->prepare('SELECT * FROM tareas');
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            header('Content-Type: application/json');
            header('HTTP/1.1 200 OK');
            echo json_encode($result);
        } catch (PDOException $e) {
            header('HTTP/1.1 500 Error interno del servidor');
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    // Editar tarea
    public static function EditarTareas($id, $nombre, $descripcion, $fecha, $estado) {
        $database = new Database();  
        $pdo = $database->getConnection();

        try {
            $stmt = $pdo->prepare('UPDATE tareas SET nombre=:nombre, descripcion=:descripcion, fecha=:fecha, estado=:estado WHERE id = :id');
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':fecha', $fecha);
            $stmt->bindParam(':estado', $estado);

            if ($stmt->execute()) {
                header('HTTP/1.1 200 OK');
                echo json_encode(['message' => 'Tarea actualizada correctamente']);
            } else {
                header('HTTP/1.1 400 Bad Request');
                echo json_encode(['message' => 'Tarea no actualizada correctamente']);
            }
        } catch (PDOException $e) {
            header('HTTP/1 .1 500 Error interno del servidor');
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    //ELIMINAR TAREA

    public static function EliminarTarea($id){
        $database = new Database();
        $pdo = $database->getConnection();

        try{
            $stmt = $pdo->prepare('DELETE FROM tareas WHERE id = :id');
            $stmt->bindParam(':id',$id,PDO::PARAM_INT);

       if ($stmt->execute()) {
                header('HTTP/1.1 200 Tarea eliminado correctamente');
                echo json_encode(['message' => 'Tarea borrado correctamente']);
            } else {
                header('HTTP/1.1 400 Tarea no se ha borrado correctamente');
                echo json_encode(['message' => 'Tarea no se ha borrado correctamente']);
            }
        } catch (PDOException $e) {
            header('HTTP/1.1 500 Error interno del servidor');
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
}
?>
