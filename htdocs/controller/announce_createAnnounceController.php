<?php
	if (empty($_SESSION['user'])) {
		throw new Exception('user not connected !');
	}
	
	require_once('model/announce.php');
	
	if(isset($_POST['titre'])) {
		if(empty($_FILES['image1']) || empty($_FILES['image1']) || empty($_FILES['image1']) ) {
			throw new Exception('Missing image !');
		}
		
		// Evidemment, sur un vrai projet, faire les vérifications au prélable pour s'assurer que votre fichier est valide.
		move_uploaded_file($_FILES['image1']['tmp_name'], $GLOBALS['filesDirectory'].$_FILES['image1']['name']);
		move_uploaded_file($_FILES['image2']['tmp_name'], $GLOBALS['filesDirectory'].$_FILES['image2']['name']);
		move_uploaded_file($_FILES['image3']['tmp_name'], $GLOBALS['filesDirectory'].$_FILES['image3']['name']);
		
	
		createAnnounce(
			$_POST['titre'],
			(float) $_POST['prix'],
			(int) $_POST['creatorId'],
			$_POST['endDate'],
			$_POST['description'],
			$_FILES['image1']['name'],
			$_FILES['image2']['name'],
			$_FILES['image3']['name']
		);
		
		$subject = 'Nouvelle annonce créée !';
		
		// Vous assurer que votre serveur apache est configuré pour permettre l'envoi de mails. (fichier php.ini)
		mail(
			$_SESSION['user']['email'],
			'Nouvelle annonce créée !',
			$subject
		);
		
		header('Location: index.php?action=list_announce');
	}
?>

<?php require_once('view/createAnnounce.php'); ?>