<?php
class Reserva {
    private $conn;
    private $table_name = "reservas";

    public $id;
    public $nombre_cliente;
    public $fecha;
    public $hora;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function leer() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY fecha ASC, hora ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function verificarDisponibilidad() {
        $query = "SELECT id FROM " . $this->table_name . " WHERE fecha = ? AND hora = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->fecha);
        $stmt->bindParam(2, $this->hora);
        $stmt->execute();
        return $stmt->rowCount() == 0; // Retorna true si está disponible (0 filas encontradas)
    }

    public function crear() {
        $query = "INSERT INTO " . $this->table_name . " SET nombre_cliente=:nombre_cliente, fecha=:fecha, hora=:hora";
        $stmt = $this->conn->prepare($query);

        $this->nombre_cliente = htmlspecialchars(strip_tags($this->nombre_cliente));

        $stmt->bindParam(":nombre_cliente", $this->nombre_cliente);
        $stmt->bindParam(":fecha", $this->fecha);
        $stmt->bindParam(":hora", $this->hora);

        return $stmt->execute();
    }
}
?>