<a href='index.php?action=list_announce'>Toutes les annonces</a><br>

<h1>My profile</h1>
<img src='<?= '/files/'.$_SESSION['user_picture'] ?>'/>
Login : <?= $_SESSION['user']['login'] ?><br>
Email : <?= $_SESSION['user']['email'] ?><br>
Password : ***** (never display passord, duh)<br>
Date d'inscription : <?= $_SESSION['user']['date_inscription'] ?> <br>
Description : <?= $_SESSION['user']['description'] ?><br>

<a href='index.php?action=edit_profile'>Editer le profile</a>