<?php
require_once 'controllers/RecetaController.php';

$controller = new RecetaController();
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