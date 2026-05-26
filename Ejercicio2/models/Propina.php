<?php
class Propina {
    public $monto_total;
    public $porcentaje;

    public function calcularPropina() {
        return ($this->monto_total * $this->porcentaje) / 100;
    }

    public function calcularTotalConPropina() {
        return $this->monto_total + $this->calcularPropina();
    }
}
?>