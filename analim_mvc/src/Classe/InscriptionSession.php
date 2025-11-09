<?php
require_once 'Congressiste.php';
require_once 'Session.php';

class InscriptionSession {
    private Congressiste $congressiste;
    private Session $session;

    public function __construct(Congressiste $congressiste, Session $session) {
        $this->congressiste = $congressiste;
        $this->session = $session;
    }

    // Getters
    public function getCongressiste(): Congressiste {
        return $this->congressiste;
    }

    public function getSession(): Session {
        return $this->session;
    }

    // Setters
    public function setCongressiste(Congressiste $congressiste): void {
        $this->congressiste = $congressiste;
    }

    public function setSession(Session $session): void {
        $this->session = $session;
    }
}
?>
