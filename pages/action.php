 <?php 
    require_once('identifier.php');
    require_once('connexiondb.php');

// Récupération de l'identifiant de dépôt à partir des paramètres GET de l'URL
	$idDepot=$_GET['idDepot'];
// Requête SQL pour sélectionner toutes les informations du dépôt correspondant à l'identifiant récupéré
    $analyse="select * from depot WHERE idDepot = '$idDepot'";
// Exécution de la requête
    $resultat=$pdo->query($analyse);
// Boucle pour récupérer les résultats et afficher un formulaire permettant de choisir une action
while($depot=$resultat->fetch()){?>
 <!-- Affichage du nom de l'étudiant concerné par le dépôt -->
Le dossier de : <?php echo $depot['etudiant']?>
<!-- Formulaire pour choisir une action -->
<form method='POST'>
<!-- Champ caché pour transmettre l'identifiant de dépôt -->
<input name="idDepot" hidden  type="text" value="<?php echo $depot['idDepot']?>"/>
 <!-- Champs cachés pour transmettre les autres informations du dépôt -->
<input name="datedepot" hidden type="text" value="<?php echo $depot['datedepot']?>"/>
<input name="etudiant" hidden  type="text" value="<?php echo $depot['etudiant']?>"/>
<input name="telephone" hidden type="text" value="<?php echo $depot['telephone']?>"/>
<input name="domicile" hidden type="text" value="<?php echo $depot['domicile']?>"/>
<input name="objet" hidden type="text" value="<?php echo $depot['objet']?>"/>
<input name="filiere" hidden type="text" value="<?php echo $depot['filiere']?>"/>
<input name="niveau" hidden type="text" value="<?php echo $depot['niveau']?>"/>
<label for="action" >Analyse</label>
<select name="action" id="" required>
<option value=""></option>
<option value="Accepter">Accepter</option>
<option value="Rejeter">Rejeter</option>
</select><br><br>
 <input type="submit" name="envoyer" value='Faire votre choix'><br>
	
</form>

<?php } ?>

<?php 
// Vérification si le formulaire a été soumis
if(isset($_POST['envoyer']))
{
// Récupération de l'identifiant de dépôt et de l'action choisie
 $idDepot=$_POST['idDepot'];
 $action=$_POST['action'];
// Requête SQL pour mettre à jour le champ "action" du dépôt correspondant à l'identifiant récupéré
$accepter = $pdo->prepare("UPDATE depot SET action = :action WHERE idDepot=:idDepot");	
// Liaison des valeurs aux paramètres de la requête préparée					
$accepter->bindParam(':idDepot', $idDepot, PDO::PARAM_INT);					
$accepter->bindParam(':action', $action, PDO::PARAM_STR);
// Exécution de la requête					
$accepter->execute();
// Redirection vers la page d'analyse
header("location:analyse.php");

}
?>
