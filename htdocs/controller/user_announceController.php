<?php

if(!isset($_SESSION['user'])) {
	$_SESSION['error'] = 403;
	throw new Exception('user not connected !');
}
require_once('model/announce.php');
$announces = getUserAnnounces($_SESSION['user']['id']);
require_once('view/listMyAnnounces.php');