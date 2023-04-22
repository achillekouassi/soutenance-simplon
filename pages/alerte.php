<?php
 // On inclut le fichier qui contient les identifiants de connexion à la base de données
    require_once('identifier.php');
    
// On récupère le message passé en paramètre dans l'URL, ou on affiche "Erreur" par défaut
    $message=isset($_GET['message'])?$_GET['message']:"Erreur";
// On récupère l'URL de redirection passée en paramètre dans l'URL, ou on redirige vers "index.php" par défaut
    $url=isset($_GET['url'])?$_GET['url']:"index.php";
    
?>
 <!-- On inclut le header HTML commun à toutes les pages du site -->
<?php include('../includes/header.php')?>

           
                <div class="alert alert-danger">
                
                    <h4><?php echo $message ?></h4> 
                                      
                </div>
                
                <br><br>
                
                <div class="alert alert-info">
                
                    <h4>Vous serez redireger dans 3 secondes</h4>
                    
                   	<?php  header("refresh:5;url=$url"); ?>
                   	
                </div>
        
        </div>  
 <!-- On inclut le footer HTML commun à toutes les pages du site  -->
        <?php include('../includes/footer.php')?>