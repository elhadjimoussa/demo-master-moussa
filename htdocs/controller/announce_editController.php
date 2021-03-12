<?php

if (!isset($_SESSION['user'])) {
	throw new Exception('user not connected');
}

require('model/announce.php');

if (isset($_GET['announceId'])) {
	$announce = getAnnounce($_GET['announceId']);
	require('view/editAnnounce.php');
} elseif (isset($_POST['announceId'])) {
	// ici comme d'hab quand on reçoit des données depuius le client,
	// on devrait passer par une étape de validation avant l'insert en bdd.
	editAnnounce(
		(int) $_POST['announceId'],
		$_POST['titre'],
		(float) $_POST['prix'],
		$_POST['endDate'],
		$_POST['description']
	);
	header('Location: index.php?action=list_announce');
}

else {
	throw new Exception('missing announce id');
}