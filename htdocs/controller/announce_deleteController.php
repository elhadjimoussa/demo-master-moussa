<?php

if (!isset($_GET['announceId'])) {
	throw new Exception('missing announce id');
}

if (!isset($_SESSION['user'])) {
	throw new Exception('user not connected');
}

require_once('model/announce.php');
deleteAnnounce($_GET['announceId']);
header('Location: index.php?action=user_announce');