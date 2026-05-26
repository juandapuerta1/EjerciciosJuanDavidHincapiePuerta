<?php
require_once 'models/Propina.php';

class PropinaController {
    public function index() {
        $resultado = null;

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['monto']) && isset($_POST['porcentaje'])) {
            $propina = new Propina();
            $propina->monto_total = floatval($_POST['monto']);
            $propina->porcentaje = floatval($_POST['porcentaje']);

            $resultado = [
                'monto_original' => $propina->monto_total,
                'porcentaje' => $propina->porcentaje,
                'total_propina' => $propina->calcularPropina(),
                'total_pagar' => $propina->calcularTotalConPropina()
            ];
        }

        require_once 'views/calculadora.php';
    }
}
?>