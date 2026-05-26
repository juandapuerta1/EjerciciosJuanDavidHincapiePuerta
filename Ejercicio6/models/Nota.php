<?php
class Nota {
    private $conn;
    private $table_name = "notas";
    public $id, $titulo, $contenido, $categoria;

    public function __construct($db) { $this->conn = $db; }

    public function leer($busqueda = '') {
        $query = "SELECT * FROM " . $this->table_name;
        if ($busqueda) {
            $query .= " WHERE titulo LIKE :busqueda OR categoria LIKE :busqueda";
        }
        $query .= " ORDER BY fecha DESC";
        
        $stmt = $this->conn->prepare($query);
        if ($busqueda) {
            $termino = "%{$busqueda}%";
            $stmt->bindParam(":busqueda", $termino);
        }
        $stmt->execute();
        return $stmt;
    }

    public function crear() {
        $query = "INSERT INTO " . $this->table_name . " SET titulo=:titulo, contenido=:contenido, categoria=:categoria";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":titulo", htmlspecialchars(strip_tags($this->titulo)));
        $stmt->bindParam(":contenido", htmlspecialchars(strip_tags($this->contenido)));
        $stmt->bindParam(":categoria", htmlspecialchars(strip_tags($this->categoria)));
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