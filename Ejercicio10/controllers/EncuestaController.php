<?php
require_once 'config/database.php';
require_once 'models/Encuesta.php';

class EncuestaController {
    private $encuesta;

    public function __construct() {
        $db = (new Database())->getConnection();
        $this->encuesta = new Encuesta($db);
    }

    public function index() {
        $encuestas = $this->encuesta->leerTodas();
        require_once 'views/inicio.php';
    }

    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['pregunta'])) {
            $this->encuesta->crear($_POST['pregunta'], $_POST['opciones']);
        }
        header("Location: index.php");
    }

    public function ver($id) {
        $encuesta = $this->encuesta->obtenerConOpciones($id);
        require_once 'views/votar.php';
    }

    public function votar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['opcion_id'])) {
            $this->encuesta->votar($_POST['opcion_id']);
            header("Location: index.php?action=resultados&id=" . $_POST['encuesta_id']);
        } else {
            header("Location: index.php");
        }
    }

    public function resultados($id) {
        $encuesta = $this->encuesta->obtenerConOpciones($id);
        $total_votos = 0;
        foreach ($encuesta['opciones'] as $op) {
            $total_votos += $op['votos'];
        }
        require_once 'views/resultados.php';
    }
    public function eliminar($id) {
        $this->encuesta->eliminar($id);
        header("Location: index.php");
    }
}
?>