<?php
require_once('connexiondb.php'); // On importe la connexion à la base de données

require_once('../les_fonctions/fonctions.php'); // On importe les fonctions utiles pour ce script

if (isset($_POST['email'])) // Si le formulaire a été soumis avec un email
    $email = $_POST['email'];
else
    $email = ""; // Sinon, on met email à une chaîne vide

$user = rechercher_user_par_email($email); // On recherche l'utilisateur correspondant à l'email

if ($user != null) { // Si un utilisateur est trouvé
    $id = $user['iduser'];
    $requete = $pdo->prepare("update utilisateur set pwd=MD5('0000') where iduser=$id"); // On modifie le mot de passe de l'utilisateur avec un mot de passe temporaire "0000"
    $requete->execute();

    $to = $user['email']; // On récupère l'email de l'utilisateur

    $objet = "Initialisation de  votre mot de passe"; // On définit l'objet du mail

    $content = "Votre nouveau mot de passe est 0000, veuillez le modifier à la prochaine ouverture de session"; // On définit le contenu du mail

    $entetes = "From: GesStag" . "\r\n" . "CC: gestionstagiaire2018@gmail.com"; // On définit les entêtes du mail

    mail($to, $objet, $content, $entetes); // On envoie le mail à l'utilisateur avec les informations définies précédemment

    $erreur = "non"; // On indique qu'il n'y a pas d'erreur

    $msg = "Un message contenant votre nouveau mot de passe a été envoyé sur votre adresse Email."; // On définit le message à afficher à l'utilisateur

} else { // Si aucun utilisateur n'est trouvé avec l'email fourni
    $erreur = "oui"; // On indique qu'il y a une erreur

    $msg = "<strong>Erreur!</strong> L'Email est incorrecte!!!"; // On définit le message à afficher à l'utilisateur

}

?>
<?php include('../includes/header.php') ?> // inclusion du fichier header.php

<div class="container col-md-6 col-md-offset-3">
    <br>
    <div class="panel panel-primary ">
        <div class="panel-heading">Initiliser votre mot de passe</div>
        <div class="panel-body">
            <form method="post" class="form">

                <div class="form-group">
                    <label class="control-label">
                        Veuillez saisir votre email de récuperation
                    </label>

                    <input type="email" name="email" class="form-control"/>
                </div>

                <button type="submit" class="btn btn-success">Initialiser le mot de passe</button>

            </form>
        </div>
    </div>


    <div class="text-center">

        <?php

        if ($erreur == "oui") { // si une erreur est survenue

            echo '<div class="alert alert-danger">' . $msg . '</div>'; // afficher un message d'erreur

            header("refresh:3;url=initialiserPwd.php"); // rediriger l'utilisateur vers la page d'initialisation du mot de passe

            exit(); // arrêter l'exécution du script
        } else if ($erreur == "non") { // sinon, si aucune erreur n'est survenue

            echo '<div class="alert alert-success">' . $msg . '</div>'; // afficher un message de succès

            header("refresh:3;url=login.php"); // rediriger l'utilisateur vers la page de connexion

            exit(); // arrêter l'exécution du script
        }

        ?>

    </div>


</div>
<?php include('../includes/footer.php') ?> // inclusion du fichier footer.php
