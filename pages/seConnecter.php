<?php
    session_start(); // Démarrer la session pour pouvoir stocker des données utilisateur
    
    require_once('connexiondb.php'); // Inclure le fichier de connexion à la base de données
    
    $login=isset($_POST['login'])?$_POST['login']:""; // Récupérer le login saisi dans le formulaire
    
    $pwd=isset($_POST['pwd'])?$_POST['pwd']:""; // Récupérer le mot de passe saisi dans le formulaire
    
    $requete="select iduser,login,email,role,etat 
                from utilisateur where login='$login' 
                and pwd='$pwd'"; // Requête SQL pour récupérer les informations de l'utilisateur correspondant au login et au mot de passe saisis
    
    $resultat=$pdo->query($requete); // Exécuter la requête
    
    if($user=$resultat->fetch()){ // Si un utilisateur est trouvé dans la base de données avec le login et le mot de passe saisis
       
        if($user['etat']==1){ // Si le compte de l'utilisateur est activé
            
            $_SESSION['user']=$user; // Stocker les informations de l'utilisateur dans la session
            header('location:../index.php'); // Rediriger l'utilisateur vers la page d'accueil
            
        }else{ // Si le compte de l'utilisateur est désactivé
            
            $_SESSION['erreurLogin']="<strong>Erreur!!</strong> Votre compte est désactivé.<br> Veuillez contacter l'administrateur"; // Stocker un message d'erreur dans la session
            header('location:login.php'); // Rediriger l'utilisateur vers la page de connexion
            
        }
        
    }else{ // Si aucun utilisateur n'est trouvé dans la base de données avec le login et le mot de passe saisis
        
        $_SESSION['erreurLogin']="<strong>Erreur!!</strong> Login ou mot de passe incorrecte!!!"; // Stocker un message d'erreur dans la session
        header('location:login.php'); // Rediriger l'utilisateur vers la page de connexion
        
    }
?>
