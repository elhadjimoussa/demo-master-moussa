<h1> Editer l'annonce</h1>

<form action='index.php?action=edit_announce' method='POST'>
	<input type='hidden' name='announceId' value='<?= $announce['id'] ?>'/>
	titre : <input type='text' name='titre' value='<?= $announce['titre'] ?>'/><br>
	prix : <input type='text' name='prix' value='<?= $announce['prix'] ?>'/><br>
	date de fin : <input type='text' name='endDate' value='<?= $announce['end_date'] ?>'/><br>
	description :<br> <textarea name='description'><?= $announce['description'] ?></textarea><br>
	<input type='submit' value='Editer'>
</form>