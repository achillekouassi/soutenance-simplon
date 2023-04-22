<?php
// Inclusion du fichier identifier.php qui contient des fonctions de sécurité
require_once('identifier.php');
// Inclusion du fichier connexiondb.php qui permet la connexion à la base de données
    require_once('connexiondb.php');
// Préparation de la requête SQL d'update						 
$modifier = $pdo->prepare("UPDATE depot SET action = :action WHERE idDepot=:idDepot");
// Liaison de la variable $idDepot avec le paramètre :idDepot de la requête SQL						
$modifier->bindParam(':idDepot', $idDepot, PDO::PARAM_INT);
// Liaison de la variable $action avec le paramètre :action de la requête SQL					
$modifier->bindParam(':action', $action, PDO::PARAM_STR);
// Exécution de la requête SQL					
$modifier->execute();
				
						 	
?>
