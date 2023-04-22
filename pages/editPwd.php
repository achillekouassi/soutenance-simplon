<?php
require_once('identifier.php');
?>

<?php include('../includes/header.php') ?>

<div class="container editpwd-page">
    <h1 class="text-center">Changement de mot de passe</h1>

    <!-- Affichage du nom d'utilisateur -->
    <h2 class="text-center"> Compte :<?php echo $_SESSION['user']['login'] ?>    </h2>

    <!-- Formulaire de changement de mot de passe -->
    <form class="form-horizontal" method="post" action="updatePwd.php">

        <!-- ***************** Début Ancien mot de passe  ***************** -->

        <!-- Champ pour entrer l'ancien mot de passe -->
        <div class="input-container">
            <input class="form-control oldpwd"
                   type="password"
                   name="oldpwd"
                   autocomplete="new-password"
                   placeholder="Taper votre Ancien Mot de passe"
                   required>
            <!-- Bouton pour afficher ou masquer l'ancien mot de passe -->
            <i class="fa fa-eye fa-2x show-old-pwd clickable"></i>
        </div>

        <!-- ***************** Fin Ancien mot de passe ***************** -->

        <!--  *****************Début Nouveau  mot de passe  ***************** -->

        <!-- Champ pour entrer le nouveau mot de passe -->
        <div class="input-container">
            <input minlength=4
                    class="form-control newpwd"
                    type="password"
                    name="newpwd"
                    autocomplete="new-password"
                    placeholder="Taper votre Nouveau Mot de passe"
                    required>
            <!-- Bouton pour afficher ou masquer le nouveau mot de passe -->
            <i class="fa fa-eye fa-2x show-new-pwd clickable"></i>

        </div>

        <!--  *****************  Fin Nouveau  mot de passe   ***************** -->

        <!--  ***************** start submit field  ***************** -->

        <!-- Bouton pour soumettre le formulaire -->
        <input
                type="submit"
                value="Enregistrer"
                class="btn btn-primary btn-block"/>

        <!--   ***************** end submit field  ***************** -->

    </form>
</div>

<?php include('../includes/footer.php') ?>
