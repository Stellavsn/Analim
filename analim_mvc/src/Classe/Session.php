<?php
class Session {
    private ?int $id_session;
    private string $description;
    private string $date_heure;
    private float $prix_session;

    public function __construct(?int $id_session, string $description, string $date_heure, float $prix_session) {        $this -> id_session = $id_session;
        $this -> description = $description;
        $this -> date_heure = $date_heure;
        $this -> prix_session = $prix_session;
    }

    public function toArray(): array {
        return [
            'id_session' => $this->id_session,
            'description' => $this->description,
            'date_heure' => $this->date_heure,
            'prix_session' => $this->prix_session,
        ];
    }

    // Getters
    public function getIdSession(): int {
        return $this->id_session;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function getDateHeure(): string {
        return $this->date_heure;
    }

    public function getPrixSession(): float {
        return $this->prix_session;
    }

    // Setters
    public function setIdSession(int $id_session): void {
        $this->id_session = $id_session;
    }

    public function setDescription(string $description): void {
        $this->description = $description;
    }

    public function setDateHeure(string $date_heure): void {
        $this->date_heure = $date_heure;
    }

    public function setPrixSession(float $prix_session): void {
        $this->prix_session = $prix_session;
    }
}

?>