<?php

	if (empty($_SESSION['user'])) {
		throw new Exception('user not connected !');
	}
	
	require_once('model/user.php');
	require_once('utils/password.php');
	require_once('utils/files.php');
	
	if (isset($_POST['login'])) {
		assertPasswordMatchVerif($_POST['password'], $_POST['verifPassword']);
		
		if (isset($_FILES['photo'])) {
			assertUploadedFileIsValid(
				$_FILES['photo'],
				'image/png',
				'100000'
			);
			move_uploaded_file($_FILES['photo']['tmp_name'], $GLOBALS['filesDirectory'].$_FILES['photo']['name']);
			$filename = $_FILES['photo']['name'];
		} else {
			$filename = null;
		}
		$user = updateUser(
			$_POST['id'],
			$_POST['login'],
			$_POST['email'],
			$_POST['password'],
			$_POST['description'],
			$filename
		);
		$_SESSION['user'] = $user;
		
		//Idéalement, vérifier que l'image qu'on va supprimer 
		//n'est pas utilisée ailleurs avant de supprimer le fichier.
		unlink($GLOBALS['filesDirectory'].$_SESSION['user_picture']);
		$_SESSION['user_picture'] = $filename;
		
		header('Location: index.php?action=list_announce');
	}
	
	require_once('view/editProfile.php');