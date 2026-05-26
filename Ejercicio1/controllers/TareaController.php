<?php
require_once 'config/database.php';
require_once 'models/Tarea.php';

class TareaController {
    private $db;
    private $tarea;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->tarea = new Tarea($this->db);
    }

    // Mostrar la lista de tareas
    public function index() {
        $stmt = $this->tarea->leer();
        $tareas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // Aquí llamaremos a la vista en el siguiente paso
        require_once 'views/tareas.php';
    }

    // Procesar la creación
    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['descripcion'])) {
            $this->tarea->descripcion = $_POST['descripcion'];
            $this->tarea->crear();
        }
        header("Location: index.php");
    }

    // Procesar la eliminación
    public function eliminar($id) {
        $this->tarea->id = $id;
        $this->tarea->eliminar();
        header("Location: index.php");
    }

    // Procesar actualización a completada
    public function completar($id) {
        $this->tarea->id = $id;
        $this->tarea->completar();
        header("Location: index.php");
    }
}
?>