<?php 
// On inclut le fichier de connexion à la base de données
require_once('connexiondb.php');

// On récupère l'id du dépôt à traiter depuis l'URL
$idDepot=$_GET['idDepot'];

// On inclut le fichier d'identification de l'utilisateur
require_once('identifier.php');

// On affiche l'id du dépôt pour des raisons de débogage
echo  $idDepot=$_GET['idDepot'];
?>

<?php 
// On inclut les fichiers d'en-tête, de menu et de navigation
include('../includes/header.php');
include('../includes/menu.php');
include('../includes/nav.php');
?>

<?php 
// Si le formulaire a été soumis
if(isset($_POST['envoyer']))
{
    // On récupère les données du formulaire
    $idDepot=$_GET['idDepot'];
    $action=$_POST['action'];

    // On prépare la requête de mise à jour de l'action du dépôt
    $accepter = $pdo->prepare("UPDATE depot SET action = :action WHERE idDepot=:idDepot");

    // On lie les paramètres à la requête préparée
    $accepter->bindParam(':idDepot', $idDepot, PDO::PARAM_INT);					
    $accepter->bindParam(':action', $action, PDO::PARAM_STR);					
    $accepter->execute();

    // On redirige vers la page des dépôts
    header("location:depot.php");
}
?>


<div class="container" style="margin-left:250px; width: 1000px; margin-top:-50px">
                       
                       <!-- Panel pour le formulaire -->
                       <div class="panel panel-primary margetop60">
                           <div class="panel-heading">Veuillez saisir les données de l'etudiant
                           </div>
                   
                           <div class="panel-body">
                               <!-- Formulaire pour saisir les données -->
                               <form method="post" action="" class="form">
                   
                               <?php 	
                                   // Récupération des données du dépôt
                                   $analyse="select * from depot WHERE idDepot = '$idDepot'";
                                   $resultat=$pdo->query($analyse);
                   
                                   // Boucle pour récupérer chaque donnée
                                   while($depot=$resultat->fetch()){?>
                                   Le dossier de : <?php echo $depot['etudiant']?>
                   
                                   <!-- Récupération des données du dépôt -->
                                   <form method='POST'>
                                   <input name="idDepot" hidden  type="text" value="<?php echo $depot['idDepot']?>"/>
                                   <input name="datedepot" hidden type="text" value="<?php echo $depot['datedepot']?>"/>
                                   <input name="etudiant" hidden  type="text" value="<?php echo $depot['etudiant']?>"/>
                                   <input name="telephone" hidden type="text" value="<?php echo $depot['telephone']?>"/>
                                   <input name="domicile" hidden type="text" value="<?php echo $depot['domicile']?>"/>
                                   <input name="objet" hidden type="text" value="<?php echo $depot['objet']?>"/>
                                   <input name="filiere" hidden type="text" value="<?php echo $depot['filiere']?>"/>
                                   <input name="niveau" hidden type="text" value="<?php echo $depot['niveau']?>"/>
                   
                               <?php } ?>
                   
                               <!-- Champ pour sélectionner une action -->
                               <div class="form-group">
                                   <label for="action">Action:</label>
                                   <select name="action" class="form-control" id="action">
                                       <option value="">Choisir</option>
                                       <option value="Accepter">Accepter</option>
                                       <option value="Rejeter">Rejeter</option>
                                   </select>
                               </div>
                   
                               <!-- Bouton pour envoyer le formulaire -->
                               <button type="submit" name="envoyer" class="btn btn-success">
                                   <span class="glyphicon glyphicon-save"></span>
                                   Enregistrer
                               </button> 
                   
                               </form>
                           </div>
                       </div>
                       
                   </div>      
                   
                   <?php include('../includes/footer.php') ?>
                   