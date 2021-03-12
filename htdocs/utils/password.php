<?php

	function assertPasswordMatchVerif($password, $verif) {
		if ($password !== $verif) {
			throw new Exception('password and verif don\'t match !');
		}
	}