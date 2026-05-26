<?php
require_once 'controllers/EventoController.php';

$controller = new EventoController();
$action = isset($_GET['action']) ? $_GET['action'] : 'index';
$id = isset($_GET['id']) ? $_GET['id'] : null;

if ($action == 'crear') {
    $controller->crear();
} elseif ($action == 'eliminar' && $id) {
    $controller->eliminar($id);
} else {
    $controller->index();
}
?>