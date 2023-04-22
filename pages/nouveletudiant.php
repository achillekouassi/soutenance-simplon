<?php 
    require_once('identifier.php'); //inclure le fichier d'identification pour vérifier si l'utilisateur est connecté
?>
<?php include('../includes/header.php') ?> <!--inclure l'en-tête de la page-->
<?php include('../includes/menu.php') ?> <!--inclure le menu-->
<?php include('../includes/nav.php') ?> <!--inclure la navigation-->

<div class="nouveau">
    <div class="container" style="margin-left:245px; width: 83%; margin-top:-60px; height:100vh">
        <div class="panel panel-primary margetop60">
            <div class="panel-heading">Veuillez saisir les données de l'etudiant</div>
            <div class="panel-body">
                <form method="post" action="insertetudiant.php" class="form">
                    <!-- Formulaire pour ajouter un nouvel étudiant -->

                    <div class="form-group">
                        <label for="datedepot">Date de depot:</label>
                        <input type="date" name="datedepot" class="form-control"/> <!-- champ pour saisir la date de dépôt -->
                    </div>

                    <div class="form-group">
                        <label for="etudiant">Nom et prenoms:</label>
                        <input type="text" name="etudiant" placeholder="Nom et prenoms" class="form-control"/> <!-- champ pour saisir le nom et le prénom de l'étudiant -->
                    </div>

                    <div class="form-group">
                        <label for="telephone">Telephone:</label>
                        <input type="text" name="telephone" placeholder="telephone" class="form-control"/> <!-- champ pour saisir le numéro de téléphone de l'étudiant -->
                    </div>

                    <div class="form-group">
                        <label for="domicile">Domicile:</label>
                        <input type="text" name="domicile" placeholder="domicile" class="form-control"/> <!-- champ pour saisir le domicile de l'étudiant -->
                    </div>

                    <div class="form-group">
                        <label for="objet">Objet de demande:</label>
                        <input type="text" name="objet" placeholder="objet de demande" class="form-control"/> <!-- champ pour saisir l'objet de la demande -->
                    </div>

                    <div class="form-group">
                        <label for="filiere">Filiere:</label>
                        <input type="text" name="filiere" placeholder="filiere" class="form-control"/> <!-- champ pour saisir la filière de l'étudiant -->
                    </div>

                    <div class="form-group">
                        <label for="niveau">Niveau:</label>
                        <select name="niveau" class="form-control" id="niveau"> <!-- champ pour choisir le niveau d'étude de l'étudiant -->
                            <option value="qualification">Qualification</option>
                            <option value="technicien">Technicien</option>
                            <option value="specialise" selected>Technicien Spécialisé</option>
                            <option value="licence">Licence</option>
                            <option value="master">Master</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success">
                        <span class="glyphicon glyphicon-save"></span>
                        Enregistrer <!-- bouton pour enregistrer les données de l'étudiant -->
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
 <?php include('../includes/footer.php') ?>