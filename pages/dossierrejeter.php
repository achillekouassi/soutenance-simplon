<?php 
    require_once('identifier.php'); // inclure le fichier d'authentification
    require_once('connexiondb.php'); // inclure le fichier de connexion à la base de données
    
    // Requête pour sélectionner les dossiers en attente
    $analyse="select * from depot WHERE action = 'En attente'";
    
    // Requête pour sélectionner les dossiers rejetés
    $rejete="select * from depot WHERE action = 'REJETER'";
    
    require("rejeter.php"); // inclure le fichier pour le traitement des dossiers rejetés
    
    // Exécution des requêtes
    $resultat_analyse=$pdo->query($analyse);
    $resultat_rejete=$pdo->query($rejete);
?>

<?php include('../includes/header.php') ?> <!-- inclure le fichier header -->

<div class="panel panel-primary">
    <div class="panel-heading">Liste des étudiants</div>
    <div class="panel-body">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>N°</th><th>Depot</th><th>Etudiant</th><th>Telephone</th><th>Domicile</th><th>Objet</th><th>Filiere</th><th>Niveau</th>
                    
                    <!-- Si l'utilisateur connecté est un administrateur, afficher la colonne Actions -->
                    <?php if ($_SESSION['user']['role']== 'ADMIN') {?>
                        <th>Actions</th>
                    <?php }?>
                </tr>
            </thead>
            
            <tbody>
                <?php while($depot=$resultat_rejete->fetch()){?> <!-- Boucle pour afficher les dossiers rejetés -->
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
        
        <a href='analysedossier.php'>Retour</a> <!-- lien de retour -->
        <?php include('../includes/footer.php') ?> <!-- inclure le fichier footer -->
    </div>
</div>
