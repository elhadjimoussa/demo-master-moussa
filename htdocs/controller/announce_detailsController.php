<?php

require('model/announce.php');

if (!isset($_GET['announceId'])) {
	throw new Exception('missing announce id');
}

if (!isset($_SESSION['user'])) {
	throw new Exception('user not connected');
}

$announce = getAnnounce($_GET['announceId']);

require_once('view/detailsAnnounce.php');