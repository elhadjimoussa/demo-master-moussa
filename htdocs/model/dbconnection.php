<?php
function connectToDb() {
	try {
		return new PDO('mysql:host=localhost:3306;dbname=test', 'root', '', [PDO::ATTR_ERRMODE => PDO:: ERRMODE_EXCEPTION]);
	} catch (Exception $e) {
		die($e->getMessage());
	}
}