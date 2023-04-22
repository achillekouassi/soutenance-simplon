<?php

require_once ('identifier.php'); // Inclut le fichier qui vérifie l'authentification de l'utilisateur

require_once ('connexiondb.php'); // Inclut le fichier qui se connecte à la base de données

$iduser=$_SESSION['user']['iduser']; // Récupère l'ID de l'utilisateur connecté à partir de la session

$oldpwd=isset($_POST['oldpwd'])?$_POST['oldpwd']:""; // Récupère l'ancien mot de passe à partir de la requête POST

$newpwd=isset($_POST['newpwd'])?$_POST['newpwd']:""; // Récupère le nouveau mot de passe à partir de la requête POST

$requete="select * from utilisateur where iduser=$iduser and pwd=MD5('$oldpwd') "; // Requête SQL pour vérifier si l'ancien mot de passe est correct

$resultat=$pdo->prepare($requete); // Prépare la requête SQL

$resultat->execute(); // Exécute la requête SQL

$msg=""; // Initialisation du message à afficher à l'utilisateur

$interval=3; // Temps avant redirection vers une autre page

$url="login.php"; // Page vers laquelle rediriger l'utilisateur

if($resultat->fetch()) { // Si l'ancien mot de passe est correct
    $requete = "update utilisateur set pwd=MD5(?) where iduser=?"; // Requête SQL pour mettre à jour le mot de passe de l'utilisateur
    $params = array($newpwd, $iduser); // Paramètres à passer à la requête SQL
    $resultat = $pdo->prepare($requete); // Prépare la requête SQL
    $resultat->execute($params); // Exécute la requête SQL avec les paramètres

    $msg="<div class='alert alert-success' >
                <strong>Félicitation!</strong> Votre mot de passe est modifié avec succés
           </div>"; // Message de succès à afficher à l'utilisateur

}else{ // Si l'ancien mot de passe est incorrect
    $msg="<div class='alert alert-danger' >
            <strong>Erreur!</strong> L'ancien mot de passe est incorrect !!!!
           </div>"; // Message d'erreur à afficher à l'utilisateur
    $url=$_SERVER['HTTP_REFERER']; // Redirige l'utilisateur vers la page précédente
}

?>

<?php include('../includes/header.php') ?> // Inclut le fichier qui contient l'en-tête de la page HTML

<div class="container">
    <br><br>
    <?php
        echo  $msg; // Affiche le message à l'utilisateur
        header("refresh:$interval;url=$url"); // Redirige l'utilisateur vers la page spécifiée après le temps spécifié
    ?>
</div>

<?php include('../includes/footer.php') ?> // Inclut le fichier qui contient le pied de page de la page HTML
