<?php
class Evento {
    private $conn;
    private $table_name = "eventos";
    
    public $id, $titulo, $descripcion, $fecha, $hora;

    public function __construct($db) { $this->conn = $db; }

    public function leer() {
        // Ordenamos para ver los más próximos primero
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY fecha ASC, hora ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function crear() {
        $query = "INSERT INTO " . $this->table_name . " SET titulo=:titulo, descripcion=:descripcion, fecha=:fecha, hora=:hora";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(":titulo", htmlspecialchars(strip_tags($this->titulo)));
        $stmt->bindParam(":descripcion", htmlspecialchars(strip_tags($this->descripcion)));
        $stmt->bindParam(":fecha", $this->fecha);
        $stmt->bindParam(":hora", $this->hora);
        
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