<a href='index.php?action=create_announce'>Créer une annonce</a><br>
<a href='index.php?action=list_announce'>Toutes les annonces</a><br>
<a href='index.php?action=user_profile'>Mon profil</a>
<h1>Mes annonces</h1>

<table>
<?php
	foreach ($announces as $announce) {
		echo '<tr>';
		echo '<td>'.$announce['titre'].'</td>';
		echo '<td><a href=\'index.php?action=edit_announce&announceId='.$announce['id'].'\'>Edit</a></td>';
		echo '<td><a href=\'index.php?action=delete_announce&announceId='.$announce['id'].'\'>Delete</a></td>';
		echo '</tr>';
	}
?>
</table>