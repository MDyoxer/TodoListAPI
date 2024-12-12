<?php 
require_once 'includes/api-tarea.php';

    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        Tarea::MostrarTareas();
    }
?>