<?php
require_once('model/user.php');

session_start();
$_SESSION['error'] = 'Error';

// Cette variable est accessible partout dans le code via $GLOBALS['filesDirectory']
$filesDirectory = __DIR__.DIRECTORY_SEPARATOR.'files'.DIRECTORY_SEPARATOR;

try {
	if(isset($_GET['action'])) {
		switch($_GET['action']) {
			case 'list_announce':
				require_once('controller/announce_listAnnounceController.php');
				break;
			case 'announce_detail':
				require_once('controller/announce_detailsController.php');
				break;
			case 'create_announce':
				require_once('controller/announce_createAnnounceController.php');
				break;
			case 'login':
				require_once('controller/user_loginController.php');
				break;
			case 'user_announce':
				require_once('controller/user_announceController.php');
				break;
			case 'edit_announce':
				require_once('controller/announce_editController.php');
				break;
			case 'delete_announce':
				require_once('controller/announce_deleteController.php');
				break;
			case 'inscription':
				require_once('controller/user_inscriptionController.php');
				break;
			case 'user_profile':
				require_once('controller/user_profileController.php');
				break;
			case 'edit_profile':
				require_once('controller/user_editProfileController.php');
				break;
			case 'download_file':
				require_once('controller/file_downloadController.php');
				break;
			default:
				$_SESSION['error'] = 404;
				throw new Exception('unknown action \''.$_GET['action'].'\'');
				break;
		}
	} else {
		require('controller/user_loginController.php');
	}
} catch (Exception $e) {
	header('Location: error.php?message='.urlencode($e->getMessage()));
}