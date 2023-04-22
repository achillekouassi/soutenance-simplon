<?php
    require_once('identifier.php'); // inclusion du fichier identifier.php qui contient la vérification de l'authentification de l'utilisateur
    require_once('connexiondb.php'); // inclusion du fichier connexiondb.php qui permet la connexion à la base de données
    
    // récupération des données du formulaire
    $datedepot=isset($_POST['datedepot'])?$_POST['datedepot']:"";
    $etudiant=isset($_POST['etudiant'])?strtoupper($_POST['etudiant']):"";
    $telephone=isset($_POST['telephone'])?strtoupper($_POST['telephone']):"";
    $domicile=isset($_POST['domicile'])?strtoupper($_POST['domicile']):"";
    $objet=isset($_POST['objet'])?strtoupper($_POST['objet']):"";
    $filiere=isset($_POST['filiere'])?strtoupper($_POST['filiere']):"";
    $niveau=isset($_POST['niveau'])?strtoupper($_POST['niveau']):"";
    $action=isset($_POST['action'])?strtoupper($_POST['action']):"En attente";
    
    // requête d'insertion dans la table depot
    $requete="insert into depot(datedepot,etudiant,telephone,domicile,objet,filiere,niveau,action) values(?,?,?,?,?,?,?,?)";
    $params=array($datedepot,$etudiant,$telephone,$domicile,$objet,$filiere,$niveau,$action);
    $resultat=$pdo->prepare($requete);
    $resultat->execute($params);
    
    header('location:depot.php'); // redirection vers la page depot.php
?>
