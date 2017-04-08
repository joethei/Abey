<?php
	
	$name = (isset($_POST['name']) ? $_POST['name'] : '');
	
	$cats = (isset($_POST['cats']) ? $_POST['cats'] : '');
	
	header('Location: search.php?search&name=' . $name . '&cats=' . json_encode($cats));
	
?>
