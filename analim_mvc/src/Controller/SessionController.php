<?php
require_once __DIR__ . '/../config/Database.php';
require_once  __DIR__ . '/../Repository/SessionRepository.php';
require_once  __DIR__ . '/../Repository/AuthRepository.php';
require_once  __DIR__ . '/../Repository/InscriptionRepository.php';
require_once  __DIR__ . '/../Classe/Session.php';

class SessionController {
    private $sessionRepo;

    public function __construct() {
        $db = (new Database())->getConnection();
        $this->sessionRepo = new SessionRepository($db);
    }

    public function list() {
    // Préparer le repo d'inscription
    $db = (new Database())->getConnection();
    $inscriptionRepo = new InscriptionRepository($db);

    // Récupération de l'ID du congressiste connecté
    $id_congressiste = null;
    if (!empty($_SESSION['email'])) {
        $stmt = $db->prepare("SELECT id_congressiste FROM congressiste WHERE email = ?");
        $stmt->bindValue(1, $_SESSION['email']);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_OBJ);
        if ($user) {
            $id_congressiste = $user->id_congressiste;
        }
    }

    // Récupération des sessions
    $sessions = $this->sessionRepo->findAll();

    // Inclusion de la vue **après** avoir défini toutes les variables
    include __DIR__."/../views/session/list.php";  
}


    public function addForm() {
        include __DIR__ . '/../views/session/form.php';
    }

    public function add() {
        $date = $_POST['date'];
        $creneau = $_POST['creneau']; 
        $description = $_POST['description'];
        $prix = $_POST['prix_session'];
        
        // Vérifier si le créneau est disponible
        if (!$this->sessionRepo->isCreneauDisponible($date, $creneau)) {
            $_SESSION['error'] = "Une session existe déjà pour ce créneau.";
            header('Location: index.php?c=session&a=addForm');
            exit();
        }
        
        $this->sessionRepo->creneau($description, $date, $creneau, $prix);
        $_SESSION['success'] = "Session créée avec succès.";
        header('Location: index.php?c=session&a=list');
    }

    public function editForm() {
        $id = $_GET['id'];
        $session = $this->sessionRepo->getSessionById($id);
        
        // Extraire la date et le créneau
        $date = date('Y-m-d', strtotime($session->getDateHeure()));
        $creneau = $this->sessionRepo->getCreneauFromDateTime($session->getDateHeure());
        
        include  __DIR__ . '/../views/session/edit.php';
    }
    
    public function edit() {
        $id_session = $_POST['id_session'];
        $date = $_POST['date'];
        $creneau = $_POST['creneau'];
        $description = $_POST['description'];
        $prix = $_POST['prix_session'];
        
        // Vérifier si le créneau est disponible (sauf si c'est la même session)
        $sessionActuelle = $this->sessionRepo->getSessionById($id_session);
        $dateActuelle = date('Y-m-d', strtotime($sessionActuelle->getDateHeure()));
        $creneauActuel = $this->sessionRepo->getCreneauFromDateTime($sessionActuelle->getDateHeure());
        
        // Si date ou créneau a changé, vérifier la disponibilité
        if ($date != $dateActuelle || $creneau != $creneauActuel) {
            if (!$this->sessionRepo->isCreneauDisponible($date, $creneau)) {
                $_SESSION['error'] = "Ce créneau est déjà occupé.";
                header('Location: index.php?c=session&a=editForm&id=' . $id_session);
                exit();
            }
        }
        
        $this->sessionRepo->update($id_session, $description, $date, $creneau, $prix);
        $_SESSION['success'] = "Session modifiée avec succès.";
        header('Location: index.php?c=session&a=list');
    }

    public function delete() {
        $id = $_GET['id'];
        $this->sessionRepo->delete($id);
        header('Location: index.php?c=session&a=list');
    }

    public function inscrire() {
    $id_session = $_GET['id'] ?? null;
    $id_congressiste = $_SESSION['id_congressiste'] ?? null;

    if (!$id_session || !$id_congressiste) {
        die("Erreur : session ou utilisateur non défini.");
    }

    $inscriptionRepo = new InscriptionRepository((new Database())->getConnection());

    // Vérifie si le congressiste n’est pas déjà inscrit sur la même demi-journée
    $sessionRepo = new SessionRepository((new Database())->getConnection());
    $session = $sessionRepo->getSessionById($id_session);

    if ($inscriptionRepo->estInscrit($id_congressiste, $id_session)) {
        die("Vous êtes déjà inscrit à une session ce jour-là sur la même demi-journée.");
    }

    $inscriptionRepo->inscrire($id_congressiste, $id_session);
    header("Location: index.php?c=session&a=list");
    exit();
    }

    public function desinscrire() {
        $id_session = $_GET['id'] ?? null;
        $id_congressiste = $_SESSION['id_congressiste'] ?? null;

        if ($id_session && $id_congressiste) {
            $db = (new Database())->getConnection();
            $repo = new InscriptionRepository($db);
            $repo->desinscrire($id_congressiste, $id_session);
        }

        header("Location: index.php?c=session&a=list");
        exit();
    }

}
