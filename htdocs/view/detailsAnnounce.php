<a href='index.php?action=list_announce'>Back to list announces</a>

<?php	
	echo '<h1>'.$announce['titre'].'</h1>';
	echo 'Prix : '.$announce['prix'].'€ <br>';
	echo 'End date : '.$announce['end_date'].'<br>';
	echo $announce['description'].'<br>';
?>