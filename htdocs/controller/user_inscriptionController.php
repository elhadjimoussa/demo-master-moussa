<?php

require_once('utils/password.php');
require_once('utils/files.php');
require_once('model/user.php');

	if (isset($_POST['login'])) {
		assertPasswordMatchVerif($_POST['password'], $_POST['verifPassword']);
		if (isset($_FILES['photo'])) {
			assertUploadedFileIsValid(
				$_FILES['photo'],
				'image/png',
				'100000'
			);
		} else {
			throw new Exception('Missing photo file');
		}
		
		move_uploaded_file($_FILES['photo']['tmp_name'], $GLOBALS['filesDirectory'].$_FILES['photo']['name']);

		try {
			$user = createUser(
				$_POST['login'],
				$_POST['email'],
				$_POST['password'],
				$_POST['description'],
				$_FILES['photo']['name']
			);
		} catch(Exception $e) {
			unlink($filesDirectory.$_FILES['photo']['name']);
			throw $e;
		}
		$_SESSION['user'] = $user;
		$_SESSION['user_picture'] = $_FILES['photo']['name'];
		
		header('Location: index.php?action=list_announce');
	}

	require_once('view/inscriptionForm.php');