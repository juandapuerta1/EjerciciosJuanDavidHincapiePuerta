<?php
require_once 'controllers/TareaController.php';

$controller = new TareaController();

// Capturar la acción de la URL, por defecto es 'index'
$action = isset($_GET['action']) ? $_GET['action'] : 'index';
$id = isset($_GET['id']) ? $_GET['id'] : null;

// Enrutamiento básico
if ($action == 'crear') {
    $controller->crear();
} elseif ($action == 'eliminar' && $id) {
    $controller->eliminar($id);
} elseif ($action == 'completar' && $id) {
    $controller->completar($id);
} else {
    $controller->index();
}
?>