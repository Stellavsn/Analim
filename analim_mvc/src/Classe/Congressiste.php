<?php
class Congressiste {
    private int $id_congressiste;
    private string $nom;
    private string $prenom;
    private string $email;
    private string $password;

    public function __construct($id_congressiste, $nom, $prenom, $email){
        $this -> id_congressiste = $id_congressiste;
        $this -> nom = $nom;
        $this -> prenom = $prenom;
        $this -> email = $email;
    }

    // Getters
    public function getIdCongressiste(): int {
        return $this->id_congressiste;
    }

    public function getNom(): string {
        return $this->nom;
    }

    public function getPrenom(): string {
        return $this->prenom;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getPassword(): string {
        return $this->password;
    }

    // Setters
    public function setIdCongressiste(int $id_congressiste): void {
        $this->id_congressiste = $id_congressiste;
    }

    public function setNom(string $nom): void {
        $this->nom = $nom;
    }

    public function setPrenom(string $prenom): void {
        $this->prenom = $prenom;
    }

    public function setEmail(string $email): void {
        $this->email = $email;
    }

    public function setPassword(string $password): void {
    $this->password = password_hash($password, PASSWORD_DEFAULT);
    }
}
?>