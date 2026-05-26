<?php
require_once 'config/database.php';
require_once 'models/Nota.php';

class NotaController {
    private $nota;

    public function __construct() {
        $db = (new Database())->getConnection();
        $this->nota = new Nota($db);
    }

    public function index() {
        $busqueda = isset($_GET['buscar']) ? $_GET['buscar'] : '';
        $stmt = $this->nota->leer($busqueda);
        $notas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        require_once 'views/notas.php';
    }

    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['titulo'])) {
            $this->nota->titulo = $_POST['titulo'];
            $this->nota->contenido = $_POST['contenido'];
            $this->nota->categoria = $_POST['categoria'];
            $this->nota->crear();
        }
        header("Location: index.php");
    }

    public function eliminar($id) {
        $this->nota->id = $id;
        $this->nota->eliminar();
        header("Location: index.php");
    }
}
?>