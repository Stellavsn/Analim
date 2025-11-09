<?php
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../Classe/Session.php';
require_once __DIR__ . '/../Classe/Congressiste.php';
require_once __DIR__ . '/../Classe/InscriptionSession.php';

class AuthRepository {
    private PDO $conn;
    public function __construct(PDO $db) {
        $this->conn = $db;
    }

    public function findByEmail(string $email): ?object {
        $sql = "SELECT id_congressiste, nom, prenom, email, password FROM congressiste WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(1, $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ) ?: null;
    }

    public function register(string $nom, string $prenom, string $email, string $password): bool {
        $sql = "INSERT INTO congressiste (nom, prenom, email, password) VALUES ( ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(1, $nom);
        $stmt->bindValue(2, $prenom);
        $stmt->bindValue(3, $email);
        $stmt->bindValue(4, $password);

        return $stmt->execute();
    }
}
?>
