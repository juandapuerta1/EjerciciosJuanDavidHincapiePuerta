<?php
require_once 'config/database.php';
require_once 'models/Tiempo.php';

class TiempoController {
    private $tiempo;

    public function __construct() {
        $db = (new Database())->getConnection();
        $this->tiempo = new Tiempo($db);
    }

    public function index() {
        $stmt = $this->tiempo->leer();
        $tiempos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        require_once 'views/cronometro.php';
    }

    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['actividad']) && !empty($_POST['tiempo_guardado'])) {
            $this->tiempo->actividad = $_POST['actividad'];
            $this->tiempo->tiempo_guardado = $_POST['tiempo_guardado'];
            $this->tiempo->crear();
        }
        header("Location: index.php");
    }

    public function eliminar($id) {
        $this->tiempo->id = $id;
        $this->tiempo->eliminar();
        header("Location: index.php");
    }
}
?>