<?php
require_once 'config/database.php';
require_once 'models/Reserva.php';

class ReservaController {
    private $db;
    private $reserva;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->reserva = new Reserva($this->db);
    }

    public function index() {
        $mensaje = '';
        if (isset($_GET['msg'])) {
            if ($_GET['msg'] == 'ok') $mensaje = "Reserva confirmada con éxito.";
            if ($_GET['msg'] == 'error') $mensaje = "Lo sentimos, ese horario ya está reservado. Elige otro.";
        }

        $stmt = $this->reserva->leer();
        $reservas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        require_once 'views/reservas.php';
    }

    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['nombre_cliente'])) {
            $this->reserva->nombre_cliente = $_POST['nombre_cliente'];
            $this->reserva->fecha = $_POST['fecha'];
            $this->reserva->hora = $_POST['hora'];
            
            // Validamos disponibilidad antes de guardar
            if ($this->reserva->verificarDisponibilidad()) {
                $this->reserva->crear();
                header("Location: index.php?msg=ok");
            } else {
                header("Location: index.php?msg=error");
            }
        } else {
            header("Location: index.php");
        }
    }
}
?>