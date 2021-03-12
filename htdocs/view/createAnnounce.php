<a href='index.php?action=list_announce'>Liste des annonces</a>
<h1>Créer une annonce</h1>

<form action='index.php?action=create_announce' method='POST' enctype='multipart/form-data'>
	titre : <input type='text' name='titre'/><br>
	prix : <input type='text' name='prix'/><br>
	<input type='hidden' name='creatorId' value='<?= $_SESSION['user']['id'] ?>'/>
	date de fin : <input type='text' name='endDate'/><br>
	image1 : <input type="file" name='image1'><br>
	image2 : <input type="file" name='image2'><br>
	image3 : <input type="file" name='image3'><br>
	description :<br> <textarea name='description'></textarea><br>
	<input type='submit' value='Créer une annonce'>
</form>