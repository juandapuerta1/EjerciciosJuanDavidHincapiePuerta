<?php
require_once 'controllers/ReservaController.php';

$controller = new ReservaController();
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

if ($action == 'crear') {
    $controller->crear();
} else {
    $controller->index();
}
?>