<?php
class Gasto {
    private $conn;
    private $table_name = "gastos";

    public $id;
    public $descripcion;
    public $categoria;
    public $monto;
    public $fecha;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function leer() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY fecha DESC, id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function crear() {
        $query = "INSERT INTO " . $this->table_name . " SET descripcion=:descripcion, categoria=:categoria, monto=:monto, fecha=:fecha";
        $stmt = $this->conn->prepare($query);

        $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));
        $this->categoria = htmlspecialchars(strip_tags($this->categoria));

        $stmt->bindParam(":descripcion", $this->descripcion);
        $stmt->bindParam(":categoria", $this->categoria);
        $stmt->bindParam(":monto", $this->monto);
        $stmt->bindParam(":fecha", $this->fecha);

        return $stmt->execute();
    }

    public function obtenerTotalMes($mes, $anio) {
        $query = "SELECT SUM(monto) as total FROM " . $this->table_name . " WHERE MONTH(fecha) = ? AND YEAR(fecha) = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $mes);
        $stmt->bindParam(2, $anio);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'] ? $row['total'] : 0;
    }
}
?>