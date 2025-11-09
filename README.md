# Analim
Projet de BTS SIO 2

# Gestion de Sessions et Inscriptions de Congrès

## 📋 Description du Projet

Application web développée en PHP natif suivant l'architecture MVC (Model-View-Controller) pour la gestion de sessions de congrès et l'inscription aux sessions des congressistes.

## 🎯 Objectifs

Réalisation de deux tâches principales :

### T1.3 - Gestion des Sessions
Système complet de gestion des sessions de congrès permettant :
- ✅ Création de nouvelles sessions via formulaire
- ✅ Modification des sessions existantes
- ✅ Suppression de sessions
- ✅ Affichage de la liste complète des sessions

### T2.3 - Inscription à une Session
Gestion des inscriptions des congressistes avec :
- ✅ Inscription d'un congressiste à une session
- ✅ Annulation d'inscription

## 🛠️ Technologies Utilisées

- **Backend** : PHP natif (sans framework)
- **Architecture** : MVC (Model-View-Controller)
- **Base de données** : MySQL via phpMyAdmin
- **Frontend** : HTML, CSS

## 📁 Structure du Projet

```
src/
├── index.php                          # Point d'entrée de l'application
├── Classe/                            # Classes métier (entités)
│   ├── Congressiste.php              # Entité Congressiste
│   ├── InscriptionSession.php        # Entité Inscription
│   └── Session.php                   # Entité Session
├── config/
│   └── Database.php                  # Configuration et connexion BDD
├── Controller/                        # Contrôleurs (logique applicative)
│   ├── AuthController.php            # Gestion authentification
│   ├── CongressisteController.php    # Gestion des congressistes
│   ├── HomeController.php            # Page d'accueil
│   └── SessionController.php         # Gestion des sessions (T1.3 & T2.3)
├── Repository/
│   ├── AuthRepository.php            # Requêtes authentification
│   ├── InscriptionRepository.php     # Requêtes inscriptions au session
│   └── SessionRepository.php         # Requêtes sessions
└── views/                            
    ├── layout.php                    # Template principal
    ├── auth/
    │   ├── login.php                 # Formulaire connexion
    │   └── register.php              # Formulaire inscription
    ├── home/
    │   └── index.php                 # Page d'accueil
    └── session/
        ├── form.php                  # Formulaire création session
        ├── edit.php                  # Page modification session
        ├── list.php                  # Liste des sessions
        └── listInscription.php       # Liste des inscriptions des congressistes aux sessions
```
## 🔧 Fonctionnalités Détaillées

### Gestion des Sessions (T1.3)

#### Création
- Formulaire avec validation côté serveur
- Vérification des champs obligatoires
- Contrôle des dates par demi journée

#### Modification
- Récupération des données existantes
- Mise à jour avec validation
- Vérification des conflits potentiels

#### Suppression
- Confirmation avant suppression

#### Liste
- Affichage des sessions
- Tri par date et heure

### Inscription aux Sessions (T2.3)

#### Inscription
- Inscription du congressiste connecté
- Vérification de la disponibilité (capacité)
- Vérification que le congressiste n'est pas déjà inscrit
- Contrôle : inscription possible uniquement si aucune facture créée

#### Annulation
- Suppression de l'inscription
- 
## 🔐 Règles de Gestion

1. Une session peut accueillir un nombre limité de congressistes (capacité)
2. Un congressiste ne peut s'inscrire qu'une seule fois à une session
3. **Règle critique** : Aucune modification d'inscription n'est autorisée après création de la facture
4. Les dates de session doivent être cohérentes (début avant fin)

## 🧪 Tests

Pour tester l'application :
1. Créer plusieurs sessions avec différentes dates
2. Inscrire des congressistes aux sessions
3. Tenter une annulation avant création de facture (doit réussir)
4. Créer une facture pour une inscription
5. Tenter une annulation après création de facture (doit échouer)

## 📝 Architecture MVC

### Models
Gèrent la logique métier et l'accès aux données :
- Requêtes SQL préparées (protection contre injections SQL)
- Validation des données
- Règles métier

### Controllers
Gèrent la logique de l'application :
- Réception des requêtes
- Appel des models appropriés
- Transmission des données aux vues

### Views
Affichage de l'interface utilisateur :
- Séparation présentation/logique
- Templating PHP natif
- Formulaires HTML

## 🤝 Contribution

Ce projet a été développé dans un contexte pédagogique/professionnel.

## 👨‍💻 Auteur

[Votre Nom]

## 📄 Licence

[Type de licence]

## 📞 Contact

Pour toute question concernant ce projet, n'hésitez pas à me contacter.

---

**Note pour les recruteurs** : Ce projet démontre la maîtrise du PHP natif, de l'architecture MVC, de la gestion de base de données MySQL et l'application de règles métier complexes.
