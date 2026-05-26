<?php
require_once 'config/database.php';
require_once 'models/Evento.php';

class EventoController {
    private $evento;

    public function __construct() {
        $db = (new Database())->getConnection();
        $this->evento = new Evento($db);
    }

    public function index() {
        $stmt = $this->evento->leer();
        $eventos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        require_once 'views/calendario.php';
    }

    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['titulo'])) {
            $this->evento->titulo = $_POST['titulo'];
            $this->evento->descripcion = $_POST['descripcion'];
            $this->evento->fecha = $_POST['fecha'];
            $this->evento->hora = $_POST['hora'];
            $this->evento->crear();
        }
        header("Location: index.php");
    }

    public function eliminar($id) {
        $this->evento->id = $id;
        $this->evento->eliminar();
        header("Location: index.php");
    }
}
?>