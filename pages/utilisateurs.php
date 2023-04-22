<?php
    // Inclusion des fichiers nécessaires
    require_once('role.php');
    require_once("connexiondb.php");

    // Récupération des paramètres GET
    $login=isset($_GET['login'])?$_GET['login']:"";
    $size=isset($_GET['size'])?$_GET['size']:3;
    $page=isset($_GET['page'])?$_GET['page']:1;
    $offset=($page-1)*$size;
   
    // Requêtes SQL
    $requeteUser="select * from utilisateur where login like '%$login%' limit $size offset $offset";
    $requeteCount="select count(*) countUser from utilisateur";
   
    // Exécution des requêtes
    $resultatUser=$pdo->query($requeteUser);
    $resultatCount=$pdo->query($requeteCount);

    // Récupération du nombre d'utilisateurs
    $tabCount=$resultatCount->fetch();
    $nbrUser=$tabCount['countUser'];
    $reste=$nbrUser % $size;   
    if($reste===0) 
        $nbrPage=$nbrUser/$size;   
    else
        $nbrPage=floor($nbrUser/$size)+1;  
?>

<?php
    // Inclusion des fichiers nécessaires
    include('../includes/header.php');
    include('../includes/menu.php');
    include('../includes/nav.php');
?>

<div class="utilisateur">
    <div class="container" style="margin-left: 245px;">
        <div class="panel panel-primary">
            <div class="panel-heading">Liste des utilisateurs (<?php echo $nbrUser ?> utilisateurs)</div>
            <div class="panel-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>login</th> <th>Email</th> <th>Role</th> <th>Actions</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <?php while($user=$resultatUser->fetch()){ ?>
                            <tr class="<?php echo $user['etat']==1?'success':'danger'?>">
                                <td><?php echo $user['login'] ?> </td>
                                <td><?php echo $user['email'] ?> </td>
                                <td><?php echo $user['role'] ?> </td>  
                                <td>
                                    <a href="editerUtilisateur.php?idUser=<?php echo $user['iduser'] ?>">
                                        <span class="glyphicon glyphicon-edit"></span>
                                    </a>
                                    &nbsp;&nbsp;
                                    <a onclick="return confirm('Etes vous sur de vouloir supprimer cet utilisateur')"
                                        href="supprimerUtilisateur.php?idUser=<?php echo $user['iduser'] ?>">
                                            <span class="glyphicon glyphicon-trash"></span>
                                    </a>
                                    &nbsp;&nbsp;
                                    <a href="activerUtilisateur.php?idUser=<?php echo $user['iduser'] ?>&etat=<?php echo $user['etat']  ?>">  
                                        <?php  
                                            if($user['etat']==1)
                                                echo '<span class="glyphicon glyphicon-remove"></span>';
                                            else 
                                                echo '<span class="glyphicon glyphicon-ok"></span>';
                                        ?>
                                    </a>
                                </td>       
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                    
               <!-- Cette section affiche la pagination -->
<div>
    <ul class="pagination">
        <?php for($i=1;$i<=$nbrPage;$i++){ ?>
            <li class="<?php if($i==$page) echo 'active' ?>"> 
                <a href="utilisateurs.php?page=<?php echo $i;?>&login=<?php echo $login ?>">
                    <?php echo $i; ?>
                </a> 
            </li>
        <?php } ?>
    </ul>
</div>
<!-- Fin de la section pagination -->

<!-- Inclusion du pied de page -->
<?php include('../includes/footer.php') ?>
<!-- Fin de l'inclusion du pied de page -->
