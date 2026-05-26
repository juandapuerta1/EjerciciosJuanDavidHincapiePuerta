<?php
class Juego {
    private $conn;
    private $table_name = "puntajes_memoria";
    public $id, $nombre_jugador, $movimientos, $dificultad;

    public function __construct($db) { $this->conn = $db; }

    public function leerTop10() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY movimientos ASC LIMIT 10";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function guardarPuntaje() {
        $query = "INSERT INTO " . $this->table_name . " SET nombre_jugador=:nombre, movimientos=:movimientos, dificultad=:dificultad";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":nombre", htmlspecialchars(strip_tags($this->nombre_jugador)));
        $stmt->bindParam(":movimientos", $this->movimientos);
        $stmt->bindParam(":dificultad", htmlspecialchars(strip_tags($this->dificultad)));

        return $stmt->execute();
    }
}
?>