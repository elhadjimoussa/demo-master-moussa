<?php

	if (empty($_SESSION['user'])) {
		throw new Exception('user not connected !');
	}
	
	require_once('model/user_file.php');
	require_once('view/profile.php');