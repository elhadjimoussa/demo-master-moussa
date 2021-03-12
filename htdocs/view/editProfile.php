<a href='index.php?action=create_announce'>Créer une annonce</a><br>
<a href='index.php?action=list_announce'>Toutes les annonces</a><br>
<a href='index.php?action=user_profile'>Mon profil</a>
<h1>Editer le profil</h1>

<form action='index.php?action=edit_profile' method='POST' enctype='multipart/form-data'>
	<input type='hidden' name='id' value='<?= $_SESSION['user']['id'] ?>'>
	Login : <input type='text' name='login' value='<?= $_SESSION['user']['login'] ?>'><br>
	Email : <input type='text' name='email' value='<?= $_SESSION['user']['email'] ?>'><br>
	Photo de profil : <input type='file' name='photo'><br>
	Password : <input type='password' name='password' value='<?= $_SESSION['user']['password'] ?>'><br>
	Vérif : <input type='password' name='verifPassword'><br>
	Description : <textarea name='description'><?= $_SESSION['user']['description'] ?></textarea><br>
	<input type="submit" value="Editer le profil">
</form> 