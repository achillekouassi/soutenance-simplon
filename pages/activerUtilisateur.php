<?php
    // Démarrage de la session pour vérifier si l'utilisateur est connecté
    session_start();
    if(isset($_SESSION['user'])){
        // Inclusion du fichier de connexion à la base de données
        require_once('connexiondb.php');

        // Récupération de l'identifiant de l'utilisateur à partir des paramètres GET de l'URL
        $idUser = isset($_GET['idUser']) ? $_GET['idUser'] : 0;

        // Récupération de l'état actuel de l'utilisateur à partir des paramètres GET de l'URL
        $etat = isset($_GET['etat']) ? $_GET['etat'] : 0;

        // Calcul du nouvel état de l'utilisateur en fonction de l'état actuel
        if ($etat == 1)
            $newEtat = 0;
        else
            $newEtat = 1;

        // Requête SQL pour mettre à jour l'état de l'utilisateur correspondant à l'identifiant récupéré
        $requete = "UPDATE utilisateur SET etat=? WHERE iduser=?";

        // Paramètres de la requête préparée
        $params = array($newEtat, $idUser);

        // Préparation de la requête
        $resultat = $pdo->prepare($requete);

        // Exécution de la requête avec les paramètres
        $resultat->execute($params);

        // Redirection vers la page d'affichage des utilisateurs
        header('location:utilisateurs.php');
    } else {
        // Redirection vers la page de connexion si l'utilisateur n'est pas connecté
        header('location:login.php');
    }
?>
