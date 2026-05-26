<?php
class Tarea {
    private $conn;
    private $table_name = "tareas";

    public $id;
    public $descripcion;
    public $completada;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Obtener todas las tareas
    public function leer() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Crear una nueva tarea
    public function crear() {
        $query = "INSERT INTO " . $this->table_name . " SET descripcion=:descripcion";
        $stmt = $this->conn->prepare($query);
        
        $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));
        $stmt->bindParam(":descripcion", $this->descripcion);
        
        return $stmt->execute();
    }

    // Eliminar una tarea
    public function eliminar() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        return $stmt->execute();
    }

    // Marcar tarea como completada
    public function completar() {
        $query = "UPDATE " . $this->table_name . " SET completada = 1 WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        return $stmt->execute();
    }
}
?>