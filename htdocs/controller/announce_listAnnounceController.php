<?php

if (empty($_SESSION['user'])) {
	throw new Exception('you are not connected !');
}

require_once('model/announce.php');

$announces = getAllAnnounces();
?>

<?php
	require_once('view/listAllAnnounces.php');
?>