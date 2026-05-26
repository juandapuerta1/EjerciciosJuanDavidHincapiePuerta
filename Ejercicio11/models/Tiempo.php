<?php
class Tiempo {
    private $conn;
    private $table_name = "tiempos";
    public $id, $actividad, $tiempo_guardado;

    public function __construct($db) { $this->conn = $db; }

    public function leer() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY id DESC";
        return $this->conn->query($query);
    }

    public function crear() {
        $query = "INSERT INTO " . $this->table_name . " SET actividad=:actividad, tiempo_guardado=:tiempo_guardado";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":actividad", htmlspecialchars(strip_tags($this->actividad)));
        $stmt->bindParam(":tiempo_guardado", htmlspecialchars(strip_tags($this->tiempo_guardado)));

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