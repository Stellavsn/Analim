<?php
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../Classe/Session.php';
require_once __DIR__ . '/../Classe/Congressiste.php';
require_once __DIR__ . '/../Classe/InscriptionSession.php';

class SessionRepository {
    private PDO $conn;
    public function __construct($db) {
        $this-> conn = $db;
    }

    /**
     * Convertit un créneau (matin/apres-midi) en heure fixe
     */
    private function creneau($creneau): string {
        return ($creneau === 'matin') ? '08:00:00' : '14:00:00';
    }

    /**
     * Extrait le créneau depuis une date_heure
     */
    public function getCreneauFromDateTime($date_heure): string {
        $heure = date('H:i:s', strtotime($date_heure));
        return ($heure === '08:00:00') ? 'matin' : 'apres-midi';
    }

    /** 
     * Créneau avec heure fixe
     */
    public function create($description, $date, $creneau, $prix): bool {
        $heure = $this->creneau($creneau);
        $date_heure = $date . ' ' . $heure;
        
        $sql = "INSERT INTO session VALUES(NULL,?,?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(1, $description);
        $stmt->bindValue(2, $date_heure);
        $stmt->bindValue(3, $prix);
        return $stmt->execute();
    }

    /**
     * Vérifie si un créneau est déjà pris
     */
    public function isCreneauDisponible($date, $creneau): bool {
        $heure = $this->creneau($creneau);
        $date_heure = $date . ' ' . $heure;
        
        $sql = "SELECT id_session FROM session WHERE date_heure = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(1, $date_heure);
        $stmt->execute();
        
        return $stmt->rowCount() === 0;
    }

    public function findAll() : array {
        $sql = "SELECT session.id_session, description, date_heure, prix_session FROM session ORDER BY date_heure ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $lesSessions = $stmt->fetchAll(PDO::FETCH_OBJ);

        $sessions = [];
        foreach($lesSessions as $s){
        $session = new Session($s->id_session, $s->description, $s->date_heure, $s->prix_session);
        $sessions[] = $session->toArray();
        }
        return $sessions;
    }

    public function getSessionById(int $id_session): ?Session{
        $sql = "SELECT id_session, description, date_heure, prix_session FROM session WHERE id_session = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(1, $id_session);
        $stmt->execute();
        $s = $stmt->fetch(PDO::FETCH_OBJ);

        return new Session($s->id_session, $s->description, $s->date_heure, $s->prix_session);    }

    public function delete(int $id_session){
        $sql = 'DELETE FROM session WHERE id_session = ?';
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(1,$id_session);
        return $stmt->execute();
    }

    public function update($id_session, $description, $date, $creneau, $prix): bool {
        $heure = $this->creneau($creneau);
        $date_heure = $date . ' ' . $heure;
        
        $sql = 'UPDATE session SET description = ?, date_heure = ?, prix_session = ? WHERE id_session = ?';
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(1, $description);
        $stmt->bindValue(2, $date_heure);
        $stmt->bindValue(3, $prix);
        $stmt->bindValue(4, $id_session);
        return $stmt->execute();
    }
}
?>