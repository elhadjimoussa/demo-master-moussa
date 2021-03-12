<?php

	require_once('dbconnection.php');
	
	function getAnnounce($id) {
		$connection = connectToDb();
		$query = $connection->prepare('SELECT * FROM announce WHERE id = :id');
		$query->execute(array('id' => $id));
		$result = $query->fetch();
		$query->closeCursor();
		if(empty($result)) {
			throw new Exception('Annonce inexistante');
		}
		return $result;
	}
	
	function deleteAnnounce($id) {
		$connection = connectToDb();
		$query = $connection->prepare('DELETE FROM announce WHERE id = :id');
		$query->execute(array('id' => $id));
		$query->closeCursor();
	}
	
	function editAnnounce(int $id, string $titre, float $prix, string $endDate, string $description) {
		$connection = connectToDb();
		$query = $connection->prepare('UPDATE announce SET titre = :titre, prix = :prix, description = :description, end_date = :end_date WHERE id = :id');
		$query->execute(array('id' => $id, 'titre' => $titre, 'prix' => $prix, 'description' => $description, 'end_date' => $endDate));
		$query->closeCursor();
	}
	
	function getUserAnnounces($userId) {
		$connection = connectToDb();
		$query = $connection->prepare('SELECT * FROM announce WHERE creator_id = :userId');
		$query->execute(array('userId' => $userId));
		return $query->fetchAll();
	}
	
	function getAllAnnounces() {
		$connection = connectToDb();
		$query = $connection->prepare('SELECT * FROM announce');
		$query->execute();
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}
	
	function createAnnounce(
			string $titre,
			float $prix,
			int $creatorId,
			string $date,
			string $description,
			string $image1,
			string $image2,
			string $image3
	) {
		$connection = connectToDb();

		$connection->beginTransaction();
		try {
			// Petit "hack" car on ne connait pas l'id de l'annonce qu'on va créer.
			// On va donc le récupérer via la variable "AUTO_INCREMENT" stockée dans mysql
			// Conseil pour éviter ce genre de hack : vous pouvez garder la maitrise de vos ids si vous les insérez vous-même.
			// (Et donc le champ en bdd n'est plus "auto_increment")
			// Vous pouvez vous assurer de leur unicité en passant par https://www.php.net/manual/fr/function.uniqid.php par example.
			$query = $connection->prepare('
				SELECT `AUTO_INCREMENT`
				FROM  INFORMATION_SCHEMA.TABLES
				WHERE TABLE_SCHEMA = :dbname
				AND TABLE_NAME = :tablename');
			
			$query->execute(array('dbname' => 'test', 'tablename' => 'announce'));
			$nextAnnounceId = $query->fetch()['AUTO_INCREMENT'];

			$query = $connection->prepare(
				'INSERT INTO announce (creator_id, titre, description, prix, end_date) VALUES(:creatorId, :titre, :description, :prix, :date)'
			);
			
			$query->execute(
				array(
				'creatorId' => $creatorId, 
				'titre' => $titre, 
				'description' => $description, 
				'prix' => $prix,
				'date' => $date
				)
			);
			
			$query = $connection->prepare('INSERT INTO announce_file (announce_id, filename) VALUES(:announceId, :filename)');
			$query->execute(array('announceId' => $nextAnnounceId, 'filename' => $image1));
			$query = $connection->prepare('INSERT INTO announce_file (announce_id, filename) VALUES(:announceId, :filename)');
			$query->execute(array('announceId' => $nextAnnounceId, 'filename' => $image2));
			$query = $connection->prepare('INSERT INTO announce_file (announce_id, filename) VALUES(:announceId, :filename)');
			$query->execute(array('announceId' => $nextAnnounceId, 'filename' => $image3));
			$connection->commit();
		} catch (Exception $e) {
			$connection->rollback();
			unlink($GLOBALS['filesDirectory'].$image1);
			unlink($GLOBALS['filesDirectory'].$image2);
			unlink($GLOBALS['filesDirectory'].$image3);
			throw $e;
		}
	}