<?php
require_once 'config/database.php';
require_once 'models/Juego.php';

class JuegoController {
    private $juego;

    public function __construct() {
        $db = (new Database())->getConnection();
        $this->juego = new Juego($db);
    }

    public function index() {
        $stmt = $this->juego->leerTop10();
        $puntajes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        require_once 'views/juego.php';
    }

    public function guardar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['nombre_jugador'])) {
            $this->juego->nombre_jugador = $_POST['nombre_jugador'];
            $this->juego->movimientos = (int)$_POST['movimientos'];
            $this->juego->dificultad = $_POST['dificultad'];
            $this->juego->guardarPuntaje();
        }
        header("Location: index.php");
    }
}
?>