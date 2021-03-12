<?php
	
	function assertUploadedFileIsValid(
		array $uploadedFile,
		string $expectedMimeType,
		int $maxSize
	) {
		if ($uploadedFile['type'] !== $expectedMimeType) {
			throw new Exception(
				"Invalid mimetype for uploaded file ! Uploaded type is {$uploadedFile['type']}. Expected type is : $expectedMimeType"
			);
		}

		if ($uploadedFile['size'] > $maxSize) {
			throw new Exception(
				"Invalid size for uploaded file ! Uploaded size is {$uploadedFile['size']} is : $maxSize"
			);	
		}	
	}