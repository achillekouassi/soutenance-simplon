 <?php 
// Inclure le fichier identifier.php qui contient les instructions de sécurité pour identifier l'utilisateur
require_once('identifier.php');

// Inclure le fichier connexiondb.php qui permet d'établir une connexion à la base de données
require_once("connexiondb.php");

// Sélectionner tous les dépôts en attente d'analyse
$analyse = "SELECT * FROM depot WHERE action = 'En attente'";

// Sélectionner tous les dépôts acceptés
$accepte = "SELECT * FROM depot WHERE action = 'Accepter'";

// Inclure le fichier accepter.php qui contient les instructions pour accepter un dépôt
require("accepter.php");

// Exécuter la requête pour sélectionner les dépôts en attente d'analyse
$resultat_analyse = $pdo->query($analyse);

// Exécuter la requête pour sélectionner les dépôts acceptés
$resultat_accepte = $pdo->query($accepte);
?>
?>
<?php include('../includes/header.php') ?>

		<!-- Cette section affiche une liste d'étudiants dans un tableau -->
<div class="panel panel-primary">
    <div class="panel-heading">Liste des étudiants</div>
    <div class="panel-body">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>N°</th><th>Dépôt</th><th>Etudiant</th><th>Téléphone</th><th>Domicile</th><th>Objet</th><th>Filière</th><th>Niveau</th>
                    <?php if ($_SESSION['user']['role']== 'ADMIN') {?>
                        <th>Actions</th>
                    <?php }?>
                </tr>
            </thead>
            
            <tbody>
                <?php while($depot=$resultat_accepte->fetch()){?>
                    <!-- Cette section affiche les données de chaque étudiant dans une ligne du tableau -->
                    <tr>
                        <td><?php echo $depot['idDepot']?></td>
                        <td><?php echo $depot['datedepot']?></td>
                        <td><?php echo $depot['etudiant']?></td>                                     
                        <td><?php echo $depot['telephone']?></td>                                     
                        <td><?php echo $depot['domicile']?></td>
                        <td><?php echo $depot['objet']?></td>
                        <td><?php echo $depot['filiere']?></td>
                        <td><?php echo $depot['niveau']?></td>
                        <td><?php echo $depot['action']?></td>                                    
                    </tr>
                <?php } ?>
            </tbody>
        </table>
		
		<!-- Ce lien permet de retourner à la page d'analyse -->
		<a href='analyse.php'>Retour</a>
		
        <?php include('../includes/footer.php') ?>
    </div>
</div>
