<?php
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../Repository/AuthRepository.php';

class AuthController {
    private $authRepo;
    
    public function __construct() {
        $db = (new Database())->getConnection();
        $this->authRepo = new AuthRepository($db);
    }
    
    /**
     * Affiche le formulaire de connexion
     */
    public function loginForm() {
        $error = '';
        require_once __DIR__ . '/../views/auth/login.php';
    }
    
    /**
     * Traite la connexion
     */
    public function login() {
        $error = '';
        
        // Récupération des données du formulaire
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        
        // Validation des champs
        if (empty($email) || empty($password)) {
            $error = "Veuillez remplir tous les champs";
            require_once __DIR__ . '/../views/auth/login.php';
            return;
        }
        
        // Recherche de l'utilisateur
        $user = $this->authRepo->findByEmail($email);
        
        // Vérification de l'utilisateur et du mot de passe
        if (!$user) {
            $error = "Email ou mot de passe incorrect";
            require_once __DIR__ . '/../views/auth/login.php';
            return;
        }
        
        if (!password_verify($password, $user->password)) {
            $error = "Email ou mot de passe incorrect";
            require_once __DIR__ . '/../views/auth/login.php';
            return;
        }
        
        // Connexion réussie - Création de la session
        $_SESSION['id_congressiste'] = $user->id_congressiste;
        $_SESSION['nom'] = $user->nom;
        $_SESSION['prenom'] = $user->prenom;
        $_SESSION['email'] = $user->email;
        
        // Redirection
        header("Location: index.php?c=session&a=list");
        exit();
    }
    
    /**
     * Affiche le formulaire d'inscription
     */
    public function registerForm() {
        $error = '';
        $success = '';
        require_once __DIR__ . '/../views/auth/register.php';
    }
    
    /**
     * Traite l'inscription
     */
    public function register() {
        $error = '';
        $success = '';
        
        // Récupération des données du formulaire
        $nom = trim($_POST['nom'] ?? '');
        $prenom = trim($_POST['prenom'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        
        // Validation des champs
        if (empty($nom) || empty($prenom) || empty($email) || empty($password)) {
            $error = "Veuillez remplir tous les champs obligatoires";
            require_once __DIR__ . '/../views/auth/register.php';
            return;
        }
             
        
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        // Création du compte
        if ($this->authRepo->register($nom, $prenom, $email, $hashedPassword)) {
            $success = "Inscription réussie ! Vous pouvez maintenant vous connecter.";
        } else {
            $error = "Une erreur est survenue lors de l'inscription";
        }
        
        require_once __DIR__ . '/../views/auth/register.php';
    }
    
    /**
     * Déconnexion
     */
    public function logout() {
        // Destruction de toutes les variables de session
        $_SESSION = array();
        
        // Destruction de la session
        session_destroy();
        
        // Redirection vers la page de connexion
        header("Location: index.php?c=auth&a=loginForm");
        exit();
    }
}
?>