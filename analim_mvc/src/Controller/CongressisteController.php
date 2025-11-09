<?php
require_once __DIR__ . '/../config/Database.php';
require_once  __DIR__ . '/../Repository/SessionRepository.php';
require_once  __DIR__ . '/../Repository/AuthRepository.php';
require_once  __DIR__ . '/../Repository/InscriptionRepository.php';
require_once  __DIR__ . '/../Classe/Session.php';
require_once  __DIR__ . '/../Classe/Congressiste.php';
require_once  __DIR__ . '/../Classe/InscriptionSession.php';

class CongressisteController {
    private $inscriptionRepo;

    public function __construct() {
        $db = (new Database())->getConnection();
        $this->inscriptionRepo = new InscriptionRepository($db);
    }

    public function list() {
    $lesParticipations = [];
    if(isset($_SESSION['id_congressiste'])){
        $id_congressiste = $_SESSION['id_congressiste'];
        $lesParticipations = $this->inscriptionRepo->getInscriptions($id_congressiste);
    }
    include_once __DIR__.'/../views/session/listInscription.php';
}

}