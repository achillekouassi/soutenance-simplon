<?php

    require_once('identifier.php');
    require_once('connexiondb.php');

    $id=isset($_GET['id'])?$_GET['id']:0; // Récupération de l'identifiant de l'utilisateur depuis l'URL.

    $requete="select * from utilisateur where iduser=$id";  // Requête SQL pour sélectionner l'utilisateur correspondant à l'identifiant.

    $resultat=$pdo->query($requete); // Exécution de la requête
    $utilisateur=$resultat->fetch();  // Récupération du premier (et unique) utilisateur trouvé.
    
    // $login=$utilisateur['login'];
    // $email=$utilisateur['email'];

?>
<?php include('../includes/header.php') ?>
<?php include('../includes/menu.php') ?>


    
        <div class="container" style="margin-left:245px; width:1045px;" >
                       
             <div class="panel panel-primary margetop60">
                <div class="panel-heading">Edition de l'utilisateur :</div>
                <div class="panel-body">
                    <form method="post" action="updateUtilisateur.php" class="form">
						<div class="form-group">
                           <!-- L'ID de l'utilisateur est envoyé via POST, donc nous n'avons pas besoin d'afficher le champ ID à l'utilisateur. -->
                            <input type="hidden" name="iduser" class="form-control" >
                        </div>
                        <div class="form-group">
                             <label for="nom">Login :</label>
                            <input type="text" name="login" placeholder="Login" class="form-control"/>
                        </div>
                        <div class="form-group">
                             <label for="prenom">Email :</label>
                            <input type="email" name="email" placeholder="email" class="form-control"
                                   />
                        </div>

				        <button type="submit" class="btn btn-success">
                            <span class="glyphicon glyphicon-save"></span>
                            Enregistrer
                        </button>

                        <a href="editPwd.php">Changer le mot de passe</a>
                      
					</form>
                </div>
            </div>   
        </div>      
 <?php include('../includes/footer.php') ?>
