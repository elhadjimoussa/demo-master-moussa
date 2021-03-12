<?php
require_once('dbconnection.php');

function createUser(
	string $login, 
	string $email, 
	string $password, 
	string $description,
	string $filename
) {
	$connection = connectToDb();
	
	$connection->beginTransaction();
	try {
		$query = $connection->prepare(
			'INSERT INTO user (login, password, date_inscription, email, description)
			VALUES(:login, :password, :date_inscription, :email, :description)'
		);
		$date = new Datetime();
		$query->execute(array(
			'login' => $login,
			'password' => $password,
			'date_inscription' => $date->format('Y-m-d H:i:s'),
			'email' => $email,
			'description' => $description)
		);
		
		$query = $connection->prepare('SELECT * FROM user WHERE login = :login AND password = :password');
		$query->execute(array('password' => $password, 'login' => $login));
		$user = $query->fetch(PDO::FETCH_ASSOC);
		
		$query = $connection->prepare('INSERT INTO user_file (user_id, path) VALUES(:userId, :path)');
		$query->execute(array('userId' => $user['id'], 'path' => $filename));
		
		$connection->commit();
	} catch (Exception $e) {
		$connection->rollback();
		throw $e;
	}
	
	return $user;
}

function updateUser(
	int $id, 
	string $login, 
	string $email, 
	string $password, 
	string $description,
	?string $filename // le ?string signifie que l'on s'attends soit à une string, soit à null
) {
	$connection = connectToDb();
	
	$connection->beginTransaction();
	try {
		//On update l'utilisateur
		$query = $connection->prepare(
			'UPDATE user 
			SET login = :login, password = :password, description =:description, email = :email 
			WHERE id = :id'
		);
		$query->execute(array(
			'login' => $login,
			'password' => $password,
			'email' => $email,
			'description' => $description,
			'id' => $id
		));
		
		//On update la photo de profil
		if (!empty($filename) {
			$query = $connection->prepare('UPDATE user_file SET path = :filename WHERE user_id = :userId');
			$query->execute(array('userId' => $id, 'filename' => $filename));
		}
		$connection->commit();
	} catch(Exception $e) {
		$connection->rollback();
		if (!empty($filename) {
			unlink($GLOBALS['filesDirectory'].$filename);
		}
		//Ne pas oublie de throw de nouveau l'exception, sinon le script continuera normalement.
		throw $e; 
	}
	
	return getUser($id);
}

function getAllUsers() {
	$connection = connectToDb();
	$query = $connection->prepare('SELECT login, password FROM user');
	$query->execute();
	$results = $query->fetchAll(PDO::FETCH_ASSOC);
	$query->closeCursor();
	return $results;
}

function getUser(int $userId) {
	$connection = connectToDb();
	$query = $connection->prepare('SELECT * FROM user WHERE id = :id');
	$query->execute(array('id' => $userId));
	$result = $query->fetch(PDO::FETCH_ASSOC);
	$query->closeCursor();
	return $result;
}

function connectUser($login, $password)
{
	$connection = connectToDb();
	$query = $connection->prepare('SELECT * FROM user WHERE login = :login AND password = :password');
	$query->execute(array('password' => $password, 'login' => $login));
	$results = $query->fetchAll(PDO::FETCH_ASSOC);
	$query->closeCursor();
	
	if(count($results) === 0) {
		throw new Exception('Invalid credentials.');
	}
	if(count($results > 1) {
		throw new Exception('Conflict in credentials.');
	}
	return $results[0];
}