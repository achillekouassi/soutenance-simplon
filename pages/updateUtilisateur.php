<?php
    require_once('identifier.php'); // Inclut le fichier qui vérifie l'authentification de l'utilisateur

    require_once('connexiondb.php'); // Inclut le fichier qui se connecte à la base de données

    $iduser=isset($_POST['iduser'])?$_POST['iduser']:0; // Récupère l'ID de l'utilisateur à partir de la requête POST ou initialisation à 0

    $login=isset($_POST['login'])?$_POST['login']:""; // Récupère le login de l'utilisateur à partir de la requête POST

    $email=isset($_POST['email'])?strtoupper($_POST['email']):""; // Récupère l'e-mail de l'utilisateur à partir de la requête POST et le convertit en majuscules (si renseigné)

    $requete="update utilisateur set login=?,email=? where iduser=?"; // Requête SQL pour mettre à jour le login et l'e-mail de l'utilisateur

    $params=array($login,$email,$iduser); // Paramètres à passer à la requête SQL

    $resultat=$pdo->prepare($requete); // Prépare la requête SQL

    $resultat->execute($params); // Exécute la requête SQL avec les paramètres

    header('location:login.php'); // Redirige l'utilisateur vers la page de connexion
?>
