<?php
     session_start(); // Démarrer la session pour pouvoir vérifier si l'utilisateur est connecté
    if(isset($_SESSION['user'])){ // Si l'utilisateur est connecté
        
            require_once('connexiondb.php'); // Inclure le fichier de connexion à la base de données
            
            $idUser=isset($_GET['idUser'])?$_GET['idUser']:0; // Récupérer l'identifiant de l'utilisateur à supprimer
            
            $requete="delete from utilisateur where idUser=?"; // Requête SQL pour supprimer l'utilisateur correspondant à l'identifiant
            
            $params=array($idUser); // Tableau de paramètres pour la requête préparée
            
            $resultat=$pdo->prepare($requete); // Préparer la requête
            
            $resultat->execute($params); // Exécuter la requête avec les paramètres
            
            header('location:utilisateurs.php'); // Rediriger l'utilisateur vers la liste des utilisateurs   
            
     }else { // Si l'utilisateur n'est pas connecté, le rediriger vers la page de connexion
                header('location:login.php');
        }
    
?>
