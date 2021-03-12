<?php

	require_once('model/dbconnection.php');
	
	function getUserProfilePic(int $userId) {
		$connection = connectToDb();
		$query = $connection->prepare('SELECT * FROM user_file WHERE user_id = :id');
		$query->execute(array('id' => $userId));
		$result = $query->fetch(PDO::FETCH_ASSOC);
		$query->closeCursor();
		return $result;
	}
	
	function deleteFile($id) {
		$connection = connectToDb();
		$query = $connection->prepare('DELETE FROM user_file WHERE id = :id');
		$query->execute(array('id' => $id));
		$query->closeCursor();
	}