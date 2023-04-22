<?php
  // Inclusion des fichiers d'identification et de connexion à la base de données
require_once('identifier.php');
require_once("connexiondb.php");

// Récupération des paramètres de la requête GET
$etudiant=isset($_GET['etudiant'])?$_GET['etudiant']:"";
$niveau=isset($_GET['niveau'])?$_GET['niveau']:"all";
$size=isset($_GET['size'])?$_GET['size']:6;
$page=isset($_GET['page'])?$_GET['page']:1;

// Calcul de l'offset pour la pagination
$offset=($page-1)*$size;

// Construction de la requête SQL en fonction des paramètres récupérés
if($niveau=="all"){
    $requete="select * from depot
            where etudiant like '%$etudiant%'
            limit $size
            offset $offset";

    $requeteCount="select count(*) countD from depot
            where etudiant like '%$etudiant%'";
}else{
     $requete="select * from depot
            where etudiant like '%$etudiant%'
            and niveau='$niveau'
            limit $size
            offset $offset";

    $requeteCount="select count(*) countD from depot
            where etudiant like '%$etudiant%'
            and niveau='$niveau'";
}

// Exécution des requêtes SQL pour récupérer les résultats et le nombre total de résultats
$resultatD=$pdo->query($requete);
$resultatCount=$pdo->query($requeteCount);

// Récupération du nombre total de résultats
$tabCount=$resultatCount->fetch();
$nbrDepot=$tabCount['countD'];

// Calcul du nombre de pages nécessaires pour la pagination
$reste=$nbrDepot % $size;
if($reste===0)
    $nbrPage=$nbrDepot/$size;
else
    $nbrPage=floor($nbrDepot/$size)+1;
?>

<!-- // Inclure le header et le menu dans la page -->
<?php include('../includes/header.php') ?>
<?php include('../includes/menu.php') ?>

<nav style="margin-left:250px">
<!-- Formulaire pour rechercher un étudiant -->
			<form action="#">   
            
				<div class="form-group">
					<input type="text" name="etudiant"  placeholder="Nom et prenoms" value="<?php echo $etudiant ?>" style=" margin-left: 200px; margin-top:15px">
					
				</div>

			</form>         
<!-- Formulaire pour filtrer la liste des dépôts -->
 <form method="get" action="depot.php" class="form-inline">

<?php if ($_SESSION['user']['role']=='ADMIN') {?>
    <!-- Actions réservées à l'administrateur -->
<?php } ?>                 

</form>
		
		</nav>
            



<section id="content" >
<!-- Liste des dépôts -->
            <div class="panel panel-primary" >
                <div class="panel-heading">Liste des etudiants (<?php echo $nbrDepot ?> depot)</div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>N°</th><th>Depot</th><th>Etudiant</th><th>Telephone</th><th>Domicile</th><th>Objet</th><th>Filiere</th><th>Niveau</th>
                                <?php if ($_SESSION['user']['role']== 'ADMIN') {?>
                                	<!-- Actions réservées à l'administrateur -->
                                    <th>Actions</th>
                                <?php }?>
                            </tr>
                        </thead>
                        
                        <tbody>
                            <?php while($depot=$resultatD->fetch()){ ?>
                                <tr>
                                    <td><?php echo $depot['idDepot'] ?> </td>
                                    <td><?php echo $depot['datedepot'] ?> </td>                                     
                                    <td><?php echo $depot['etudiant'] ?> </td> 
                                    <td><?php echo $depot['telephone'] ?> </td> 
                                    <td><?php echo $depot['domicile'] ?> </td> 
                                    <td><?php echo $depot['objet'] ?> </td> 
                                    <td><?php echo $depot['filiere'] ?> </td> 
                                    <td><?php echo $depot['niveau'] ?> </td> 
                                    
                                    
                                     <?php if ($_SESSION['user']['role']== 'ADMIN') {?>
                                        <!-- Actions réservées à l'administrateur -->
                                        <td>
                                             <!-- <?php echo $depot['action'] ?> -->
                                             <?php 
                                             if($depot['action']=='Accepter'){ echo '<a class="btn btn-success">Accepter</a>';}
                                             
                                             elseif($depot['action']=='Rejeter'){ echo '<a class="btn btn-danger">Rejeter</a>';}
                                             else{ echo '<a class="btn btn-primary" href="test.php?idDepot='.$depot["idDepot"].'">En attente</a>';} 
                                           
                                             ?>
                                            
                                                
                                           
                                        </td>
                                    <?php }?>
                                    
                                </tr>
                            <?PHP } ?>
                       </tbody>
                    </table>
                <div>
                    			<!-- Pagination -->
                    <ul class="pagination">
                        <?php for($i=1;$i<=$nbrPage;$i++){ ?>
                            <li class="<?php if($i==$page) echo 'active' ?>"> 
            <a href="depot.php?page=<?php echo $i;?>&etudiant=<?php echo $etudiant ?>&niveau=<?php echo $niveau ?>">
                                    <?php echo $i; ?>
                                </a> 
                             </li>
                        <?php } ?>
                    </ul>
                </div>
                </div>
            </div>
        </div>
<?php include('../includes/footer.php') ?>