<?php
class Generador {
    public $longitud = 12;
    public $incluir_mayusculas = true;
    public $incluir_minusculas = true;
    public $incluir_numeros = true;
    public $incluir_simbolos = true;

    public function generar() {
        $caracteres = '';
        if ($this->incluir_minusculas) $caracteres .= 'abcdefghijklmnopqrstuvwxyz';
        if ($this->incluir_mayusculas) $caracteres .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        if ($this->incluir_numeros) $caracteres .= '0123456789';
        if ($this->incluir_simbolos) $caracteres .= '!@#$%^&*()_+-=[]{}|;:,.<>?';

        if (empty($caracteres)) {
            return "Debes seleccionar al menos un tipo de carácter.";
        }

        $password = '';
        $max = strlen($caracteres) - 1;
        for ($i = 0; $i < $this->longitud; $i++) {
            $password .= $caracteres[random_int(0, $max)];
        }
        
        return $password;
    }
}
?>