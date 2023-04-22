<?php
session_start(); // Démarre une session
if (isset($_SESSION['erreurLogin'])) // Vérifie si la variable de session 'erreurLogin' est définie
    $erreurLogin = $_SESSION['erreurLogin']; // Affecte la valeur de la variable de session 'erreurLogin' à la variable locale $erreurLogin
else {
    $erreurLogin = ""; // Initialise la variable locale $erreurLogin à une chaîne vide si la variable de session 'erreurLogin' n'est pas définie
}
session_destroy(); // Détruit la session en cours

include('../includes/header.php'); // Inclut le fichier d'en-tête

// Crée un formulaire de connexion
?>
<div class="container col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
    <div class="panel panel-primary margetop60">
        <div class="panel-heading">Se connecter :</div>
        <div class="panel-body">
            <form method="post" action="seConnecter.php" class="form">

                <?php if (!empty($erreurLogin)) { ?>
                    <div class="alert alert-danger">
                        <?php echo $erreurLogin ?> <!-- Affiche un message d'erreur si la variable $erreurLogin n'est pas vide -->
                    </div>
                <?php } ?>

                <div class="form-group">
                    <label for="login">Login :</label>
                    <input type="text" name="login" placeholder="Login"
                           class="form-control" autocomplete="off"/>
                </div>

                <div class="form-group">
                    <label for="pwd">Mot de passe :</label>
                    <input type="password" name="pwd"
                           placeholder="Mot de passe" class="form-control"/>
                </div>

                <button type="submit" class="btn btn-success">
                    <span class="glyphicon glyphicon-log-in"></span>
                    Se connecter
                </button>
                <p class="text-right">
                    <a href="InitialiserPwd.php">Mot de passe Oublié</a> <!-- Lien pour réinitialiser le mot de passe -->
                    &nbsp &nbsp
                    <a href="nouvelUtilisateur.php">Créer un compte</a> <!-- Lien pour créer un nouveau compte utilisateur -->
                </p>
            </form>
        </div>
    </div>
</div>
<?php include('../includes/footer.php') ?> <!-- Inclut le fichier de pied de page --> 
