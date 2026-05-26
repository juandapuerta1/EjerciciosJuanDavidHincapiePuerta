<?php
require_once 'controllers/EncuestaController.php';

$controller = new EncuestaController();
$action = isset($_GET['action']) ? $_GET['action'] : 'index';
$id = isset($_GET['id']) ? $_GET['id'] : null;

if ($action == 'crear') {
    $controller->crear();
} elseif ($action == 'ver' && $id) {
    $controller->ver($id);
} elseif ($action == 'votar') {
    $controller->votar();
} elseif ($action == 'resultados' && $id) {
    $controller->resultados($id);
} elseif ($action == 'eliminar' && $id) {
    $controller->eliminar($id);
} else {
    $controller->index();
}
?>