<?php 
// Inclusion des fichiers de configuration
require_once('identifier.php');
require_once('connexiondb.php');

// Requêtes SQL pour récupérer les dossiers en attente, acceptés et rejetés
$analyse="select * from depot WHERE action = 'En attente'";
$accepte="select * from depot WHERE action = 'Accepter'";
$rejete="select * from depot WHERE action = 'Rejeter'";

// Exécution des requêtes
$resultat_analyse=$pdo->query($analyse);
$resultat_accepte=$pdo->query($accepte);
$resultat_rejete=$pdo->query($rejete);

?>

<!-- Inclusion des fichiers d'en-tête, de menu et de navigation -->
<?php include('../includes/header.php') ?>
<?php include('../includes/menu.php') ?>
<?php include('../includes/nav.php') ?>


        <div class="analyse">
            
       
		 <div class="panel panel-primary " id="panel" style="margin-left:260px;">
                <div class="panel-heading" >Dossiers à analyser</div>
                <div class="panel-body">
                    <!-- Tableau pour afficher les dossiers en attente -->
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>N°</th><th>Depot</th><th>Etudiant</th><th>Telephone</th><th>Domicile</th><th>Objet</th><th>Filiere</th><th>Niveau</th>
                                <?php 
                                // Affichage de la colonne Actions pour les utilisateurs ayant le rôle ADMIN
                                if ($_SESSION['user']['role']== 'ADMIN') {?>
                                	<th>Actions</th>
                                <?php }?>
                            </tr>
                        </thead>
                        
                        <tbody>
                        <!--  Boucle pour afficher les dossiers en attente -->
                             <?php while($depot=$resultat_analyse->fetch()){?>
                                <tr>
                                     <td><?php echo $depot['idDepot']?> </td>
                                      <td><?php echo $depot['datedepot']?>  <input name="datedepot" hidden type="text" value="<?php echo $depot['datedepot']?>"/>  </td>
									 <td><?php echo $depot['etudiant']?>  <input name="etudiant" hidden type="text" value="<?php echo $depot['etudiant']?>"/> </td>
                                      <td><?php echo $depot['telephone']?>  <input name="telephone" hidden type="text" value="<?php echo $depot['telephone']?>"/> </td>
									  <td><?php echo $depot['domicile']?>  <input name="domicile" hidden type="text" value="<?php echo $depot['domicile']?>"/> </td>
									  <td><?php echo $depot['objet']?>  <input name="objet" hidden type="text" value="<?php echo $depot['objet']?>"/> </td>
                                      <td><?php echo $depot['filiere']?>  <input name="filiere" hidden type="text" value="<?php echo $depot['filiere']?>"/> </td>
                                      <td><?php echo $depot['niveau']?>  <input name="niveau" hidden type="text" value="<?php echo $depot['niveau']?>"/> </td>
                                    
                                    <td>
                                       <a href='test.php?idDepot=<?php echo $depot['idDepot']?>' class="btn btn-primary">Analyse de dossier</a>
                                    </td>
                                </tr>
                             <?php } ?>
                    </tbody>
                </table>	
		
                </div>
         </div>
        </div>
        
        <?php include('../includes/footer.php') ?>
        
