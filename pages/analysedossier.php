<?php 
// Inclure les fichiers nécessaires
require_once('identifier.php');
require_once('connexiondb.php');

// Définir les requêtes SQL
$analyse="select * from depot WHERE action = 'En attente'";
$rejete="select * from depot WHERE action = 'Rejeter'";

// Inclure le fichier qui gère la logique de rejet
require("rejeter.php");

// Exécuter les requêtes SQL et stocker les résultats dans des variables
$resultat_analyse=$pdo->query($analyse);
$resultat_rejete=$pdo->query($rejete);
?>

<?php include('../includes/header.php') ?>

<div class="panel panel-primary">
    <div class="panel-heading">Liste des étudiants</div>
    <div class="panel-body">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>N°</th><th>Dépôt</th><th>Étudiant</th><th>Téléphone</th><th>Domicile</th><th>Objet</th><th>Filière</th><th>Niveau</th>
                    <?php if ($_SESSION['user']['role']== 'ADMIN') {?>
                    	<th>Actions</th>
                    <?php }?>
                </tr>
            </thead>
            <tbody>
                <?php 
                // Boucle pour afficher les résultats de la requête "Rejeter"
                while($depot=$resultat_rejete->fetch()){
                ?>
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
        <a href='analyse.php'>Retour</a>
    </div>
</div>

<?php include('../includes/footer.php') ?>
