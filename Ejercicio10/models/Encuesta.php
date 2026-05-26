<?php
class Encuesta {
    private $conn;

    public function __construct($db) { $this->conn = $db; }

    public function leerTodas() {
        $query = "SELECT * FROM encuestas ORDER BY id DESC";
        return $this->conn->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function crear($pregunta, $opciones) {
        $query = "INSERT INTO encuestas (pregunta) VALUES (:pregunta)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":pregunta", htmlspecialchars(strip_tags($pregunta)));
        
        if ($stmt->execute()) {
            $encuesta_id = $this->conn->lastInsertId();
            $queryOpcion = "INSERT INTO opciones (encuesta_id, texto_opcion) VALUES (:encuesta_id, :texto_opcion)";
            $stmtOpcion = $this->conn->prepare($queryOpcion);
            
            foreach ($opciones as $opcion) {
                if (!empty(trim($opcion))) {
                    $texto = htmlspecialchars(strip_tags($opcion));
                    $stmtOpcion->bindParam(":encuesta_id", $encuesta_id);
                    $stmtOpcion->bindParam(":texto_opcion", $texto);
                    $stmtOpcion->execute();
                }
            }
            return true;
        }
        return false;
    }

    public function obtenerConOpciones($id) {
        $query = "SELECT * FROM encuestas WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $encuesta = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($encuesta) {
            $queryOpciones = "SELECT * FROM opciones WHERE encuesta_id = :id";
            $stmtOpciones = $this->conn->prepare($queryOpciones);
            $stmtOpciones->bindParam(":id", $id);
            $stmtOpciones->execute();
            $encuesta['opciones'] = $stmtOpciones->fetchAll(PDO::FETCH_ASSOC);
        }
        return $encuesta;
    }

    public function votar($opcion_id) {
        $query = "UPDATE opciones SET votos = votos + 1 WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $opcion_id);
        return $stmt->execute();
    }
    public function eliminar($id) {
        $query = "DELETE FROM encuestas WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}
?>