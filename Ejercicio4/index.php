<?php
require_once 'controllers/GastoController.php';

$controller = new GastoController();
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

if ($action == 'crear') {
    $controller->crear();
} else {
    $controller->index();
}
?>