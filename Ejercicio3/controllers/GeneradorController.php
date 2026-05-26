<?php
require_once 'models/Generador.php';

class GeneradorController {
    public function index() {
        $passwordGenerada = null;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $generador = new Generador();
            
            // Validamos la longitud mínima y máxima por seguridad
            $longitud = isset($_POST['longitud']) ? (int)$_POST['longitud'] : 12;
            $generador->longitud = max(4, min(128, $longitud)); 
            
            $generador->incluir_mayusculas = isset($_POST['mayusculas']);
            $generador->incluir_minusculas = isset($_POST['minusculas']);
            $generador->incluir_numeros = isset($_POST['numeros']);
            $generador->incluir_simbolos = isset($_POST['simbolos']);

            $passwordGenerada = $generador->generar();
        }

        require_once 'views/generador.php';
    }
}
?>