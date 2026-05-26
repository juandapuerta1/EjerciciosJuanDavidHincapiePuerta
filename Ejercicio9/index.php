<?php
require_once 'controllers/JuegoController.php';

$controller = new JuegoController();
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

if ($action == 'guardar') {
    $controller->guardar();
} else {
    $controller->index();
}
?>