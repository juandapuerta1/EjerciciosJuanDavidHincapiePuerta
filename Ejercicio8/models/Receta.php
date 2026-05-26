<?php
class Receta {
    private $conn;
    private $table_name = "recetas";
    public $id, $titulo, $ingredientes, $instrucciones, $tipo_comida;

    public function __construct($db) { $this->conn = $db; }

    public function leer($tipo_filtro = '') {
        $query = "SELECT * FROM " . $this->table_name;
        // Si hay un filtro, lo añadimos a la consulta
        if ($tipo_filtro) {
            $query .= " WHERE tipo_comida = :tipo";
        }
        $query .= " ORDER BY id DESC";

        $stmt = $this->conn->prepare($query);
        if ($tipo_filtro) {
            $stmt->bindParam(":tipo", $tipo_filtro);
        }
        $stmt->execute();
        return $stmt;
    }

    public function crear() {
        $query = "INSERT INTO " . $this->table_name . " SET titulo=:titulo, ingredientes=:ingredientes, instrucciones=:instrucciones, tipo_comida=:tipo_comida";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":titulo", htmlspecialchars(strip_tags($this->titulo)));
        $stmt->bindParam(":ingredientes", htmlspecialchars(strip_tags($this->ingredientes)));
        $stmt->bindParam(":instrucciones", htmlspecialchars(strip_tags($this->instrucciones)));
        $stmt->bindParam(":tipo_comida", htmlspecialchars(strip_tags($this->tipo_comida)));

        return $stmt->execute();
    }

    public function eliminar() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        return $stmt->execute();
    }
}
?>