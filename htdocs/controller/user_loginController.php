<?php
	require_once('model/user.php');
	require_once('model/user_file.php');
	if (isset($_POST['password']) && isset($_POST['login'])) {
		$_SESSION['user'] = connectUser($_POST['login'], $_POST['password']);
		$_SESSION['user_picture'] = getUserProfilePic((int) $_SESSION['user']['id']);
		header('Location: index.php?action=list_announce');
	}
?>

<?php require_once('view/loginForm.php'); ?>
<?php 
	$results = getAllUsers();
	require_once('view/userAccountList.php');
?>