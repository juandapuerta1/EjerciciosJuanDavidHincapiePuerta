<?php
require_once 'config/database.php';
require_once 'models/Gasto.php';

class GastoController {
    private $db;
    private $gasto;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->gasto = new Gasto($this->db);
    }

    public function index() {
        // Obtener la lista de gastos
        $stmt = $this->gasto->leer();
        $gastos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Obtener el resumen del mes actual
        $mesActual = date('m');
        $anioActual = date('Y');
        $totalMes = $this->gasto->obtenerTotalMes($mesActual, $anioActual);

        require_once 'views/gastos.php';
    }

    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['descripcion'])) {
            $this->gasto->descripcion = $_POST['descripcion'];
            $this->gasto->categoria = $_POST['categoria'];
            $this->gasto->monto = floatval($_POST['monto']);
            $this->gasto->fecha = $_POST['fecha'];
            
            $this->gasto->crear();
        }
        header("Location: index.php");
    }
}
?>