<?php
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../Classe/Session.php';
require_once __DIR__ . '/../Classe/Congressiste.php';
require_once __DIR__ . '/../Classe/InscriptionSession.php';

class InscriptionRepository {
    private PDO $conn;
    
    public function __construct(PDO $db) {
        $this->conn = $db;
    }
    
    /**
     * Vérifie si le congressiste est inscrit à une session spécifique
     */
    public function estInscrit(int $id_congressiste, int $id_session): bool {
        $sql = "SELECT COUNT(*) as nb 
                FROM participation_session 
                WHERE id_congressiste = ? AND id_session = ?";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(1, $id_congressiste, PDO::PARAM_INT);
        $stmt->bindValue(2, $id_session, PDO::PARAM_INT);
        $stmt->execute();
        
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['nb'] > 0;
    }
    
    /**
     * Récupère toutes les inscriptions d'un congressiste
     */
    public function getInscriptions(int $id_congressiste): array {  
        $sql = "SELECT s.id_session, description, date_heure, prix_session FROM participation_session p INNER JOIN session s ON p.id_session = s.id_session WHERE id_congressiste = ?";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(1, $id_congressiste, PDO::PARAM_INT);
        $stmt->execute();
        
        $lesInscriptions = $stmt->fetchAll(PDO::FETCH_OBJ);
        $lesParticipations = [];
        
        foreach($lesInscriptions as $i) {
            $lesParticipations[] = new Session(
                $i->id_session, 
                $i->description, 
                $i->date_heure, 
                $i->prix_session
            );
        }
        
        return $lesParticipations;
    }
    
    /**
     * Inscrit un congressiste à une session
     */
    public function inscrire(int $id_congressiste, int $id_session): bool {
        $sql = "INSERT INTO participation_session (id_congressiste, id_session) 
                VALUES (?, ?)";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(1, $id_congressiste, PDO::PARAM_INT);
        $stmt->bindValue(2, $id_session, PDO::PARAM_INT);
        
        return $stmt->execute();
    }
    
    /**
     * Désinscrit un congressiste d'une session
     */
    public function desinscrire(int $id_congressiste, int $id_session): bool {
        $sql = "DELETE FROM participation_session 
                WHERE id_congressiste = ? AND id_session = ?";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(1, $id_congressiste, PDO::PARAM_INT);
        $stmt->bindValue(2, $id_session, PDO::PARAM_INT);
        
        return $stmt->execute();
    }
    
}
?>