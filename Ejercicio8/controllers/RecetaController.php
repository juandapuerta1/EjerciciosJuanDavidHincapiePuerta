<?php
require_once 'config/database.php';
require_once 'models/Receta.php';

class RecetaController {
    private $receta;

    public function __construct() {
        $db = (new Database())->getConnection();
        $this->receta = new Receta($db);
    }

    public function index() {
        $tipo_filtro = isset($_GET['tipo']) ? $_GET['tipo'] : '';
        $stmt = $this->receta->leer($tipo_filtro);
        $recetas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        require_once 'views/recetas.php';
    }

    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['titulo'])) {
            $this->receta->titulo = $_POST['titulo'];
            $this->receta->ingredientes = $_POST['ingredientes'];
            $this->receta->instrucciones = $_POST['instrucciones'];
            $this->receta->tipo_comida = $_POST['tipo_comida'];
            $this->receta->crear();
        }
        header("Location: index.php");
    }

    public function eliminar($id) {
        $this->receta->id = $id;
        $this->receta->eliminar();
        header("Location: index.php");
    }
}
?>