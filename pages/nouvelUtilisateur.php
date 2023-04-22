<?php

// Inclusion des fichiers nécessaires
require_once("connexiondb.php");
require_once("../les_fonctions/fonctions.php");

// Définition d'un tableau pour stocker les erreurs de validation
$validationErrors = array();

// Vérification si la requête est de type POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Récupération des données du formulaire
    $login = $_POST['login'];
    $pwd1 = $_POST['pwd1'];
    $pwd2 = $_POST['pwd2'];
    $email = $_POST['email'];

    // Validation du champ login
    if (isset($login)) {
        $filtredLogin = filter_var($login, FILTER_SANITIZE_STRING);

        if (strlen($filtredLogin) < 4) {
            $validationErrors[] = "Erreur!!! Le login doit contenir au moins 4 caratères";
        }
    }

    // Validation des champs mot de passe
    if (isset($pwd1) && isset($pwd2)) {

        if (empty($pwd1)) {
            $validationErrors[] = "Erreur!!! Le mot ne doit pas etre vide";
        }

        if (md5($pwd1) !== md5($pwd2)) {
            $validationErrors[] = "Erreur!!! les deux mot de passe ne sont pas identiques";

        }
    }

    // Validation du champ email
    if (isset($email)) {
        $filtredEmail = filter_var($login, FILTER_SANITIZE_EMAIL);

        if ($filtredEmail != true) {
            $validationErrors[] = "Erreur!!! Email  non valid";

        }
    }

    // Si aucune erreur de validation n'est détectée, on insère l'utilisateur dans la base de données
    if (empty($validationErrors)) {
        if (rechercher_par_login($login) == 0 & rechercher_par_email($email) == 0) {
            $requete = $pdo->prepare("INSERT INTO utilisateur(login,email,pwd,role,etat) 
                                        VALUES(:plogin,:pemail,:ppwd,:prole,:petat)");

            $requete->execute(array('plogin' => $login,
                'pemail' => $email,
                'ppwd' => md5($pwd1),
                'prole' => 'VISITEUR',
                'petat' => 0));

            // Affichage d'un message de succès
            $success_msg = "Félicitation, votre compte est crée, mais temporairement inactif jusqu'a activation par l'admin";
        } else {
            if (rechercher_par_login($login) > 0) {
                $validationErrors[] = 'Désolé le login exsite deja';
            }
            if (rechercher_par_email($email) > 0) {
                $validationErrors[] = 'Désolé cet email exsite deja';
            }
        }

    }

}

?>
<?php 
    // Inclusion de l'en-tête de la page
    include('../includes/header.php') 
?>

<div class="container col-md-6 col-md-offset-3">
    <h1 class="text-center"> Création d'un nouveau compte utilisateur</h1>

    <form class="form" method="post">

        <div class="input-container">
            <!-- Champ pour le nom d'utilisateur -->
            <input type="text"
                   required="required"
                   minlength="4"
                   title="Le login doit contenir au moins 4 caractères..."
                   name="login"
                   placeholder="Taper votre nom d'utilisateur"
                   autocomplete="off"
                   class="form-control">
        </div>

        <div class="input-container">
            <!-- Champ pour le mot de passe -->
            <input type="password"
                   required="required"
                   minlength="3"
                   title="Le Mot de passe doit contenir au moins 3 caractères..."
                   name="pwd1"
                   placeholder="Taper votre mot de passe"
                   autocomplete="new-password"
                   class="form-control">
        </div>

        <div class="input-container">
            <!-- Champ pour la confirmation du mot de passe -->
            <input type="password"
                   required="required"
                   minlength="3"
                   name="pwd2"
                   placeholder="retaper votre mot de passe pour le confirmer"
                   autocomplete="new-password"
                   class="form-control">
        </div>

        <div class="input-container">
            <!-- Champ pour l'adresse e-mail -->
            <input type="email"
                   required="required"
                   name="email"
                   placeholder="Taper votre email"
                   autocomplete="off"
                   class="form-control">
        </div>

        <!-- Bouton d'enregistrement -->
        <input type="submit" class="btn btn-primary" value="Enregistrer">
    </form>
    <br>

    <?php
        // Affichage des erreurs de validation
        if (isset($validationErrors) && !empty($validationErrors)) {
            foreach ($validationErrors as $error) {
                echo '<div class="alert alert-danger">' . $error . '</div>';
            }
        }

        // Affichage du message de succès
        if (isset($success_msg) && !empty($success_msg)) {
            echo '<div class="alert alert-success">' . $success_msg . '</div>';

            // Redirection automatique vers la page de connexion après 5 secondes
            header('refresh:5;url=login.php');
        }
    ?>

</div>

<?php 
    // Inclusion du pied de page de la page
    include('../includes/footer.php') 
?> 



