Available accounts : <br>
<?php
	foreach($results as $result) {
		echo $result['login'] . ' / ' . $result['password'] . '<br>';
	}
?>