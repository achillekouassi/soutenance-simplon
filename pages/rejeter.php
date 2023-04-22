<?php
require_once('identifier.php');
require_once('connexiondb.php');

// Vérifier si le formulaire a été soumis
if(isset($_POST['rejeter']))
{
	// Récupérer les valeurs des champs du formulaire
	echo $idDepot=$_POST['idDepot'];	
	echo $datedepot=$_POST['datedepot'];	
	echo $etudiant=$_POST['etudiant'];	
	echo $telephone=$_POST['telephone'];	
	echo $domicile=$_POST['domicile'];	
	echo $objet=$_POST['objet'];	
	echo $filiere=$_POST['filiere'];	
	echo $niveau=$_POST['niveau'];		
	echo $action=$_POST['action'];	
}

// Mettre à jour la base de données avec la nouvelle valeur de l'action
$modifier = $pdo->prepare("UPDATE depot SET action = :action WHERE idDepot=:idDepot");						
$modifier->bindParam(':idDepot', $idDepot, PDO::PARAM_INT);					
$modifier->bindParam(':action', $action, PDO::PARAM_STR);					
$modifier->execute();
?> 