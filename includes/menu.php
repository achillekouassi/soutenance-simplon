
	<section id="sidebar">
		<div class="brand"><i class='bx bxs-smile icon'></i> Gest-Stagiaire</div>
		<ul class="side-menu">
			<li><a href="depot.php" class="active"><i class='bx bxs-dashboard icon' ></i> Dashboard</a></li>

				
			</li>
			<li><a href="depot.php"><i class="fa-solid fa-users"  style="margin-left:20px"></i><div style="margin-left:20px">Les Stagiaires</div></a></li>
			<li class="divider" data-text="table and forms">Table and forms</li>
			<?php if ($_SESSION['user']['role']=='ADMIN') {?>
			<li><a href="analyse.php"><i class="fa-solid fa-book" style="margin-left:20px"></i><div style="margin-left:20px">Les dossiers</div></a></li>
			<li><a href="Utilisateurs.php"><i class="fa-regular fa-user" style="margin-left:20px"></i><div style="margin-left:20px">Les utilisteurs</div></a></li>
			<li><a href="nouveletudiant.php"> <span class="glyphicon glyphicon-plus" style="margin-left:20px;"></span> <div style="margin-left:20px">Nouveau stagiaire</div></a></li>

			<?php }?>

			<li><a href="seDeconnecter.php"><i class="fa-solid fa-right-from-bracket" style="margin-left:20px"></i> <div style="margin-left:20px">Se deconnecter</div></a></li>
		</ul>
	</section>

	