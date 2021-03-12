<a href='index.php?action=create_announce'>Créer une annonce</a>
<a href='index.php?action=user_announce'>Mes annonces</a><br>
<a href='index.php?action=user_profile'>Mon profil</a>
<h1>Liste des annonces</h1>

<?php
	foreach ($announces as $announce) {
		echo '<a href=\'index.php?action=announce_detail&announceId='.$announce['id'].'\'>'.$announce['titre'].'</a><br>';
	}
?>