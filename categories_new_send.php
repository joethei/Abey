<?php
require_once 'sys/functions/general.php';
require_once 'sys/functions/fetchers.php';
returnHeader("Neue Kategorie anlegen");
checkUserIsOnline();

if($_SESSION['user_isAdmin']){
	$name = $_POST['name'];
	
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_DB);
	$mysqli -> set_charset("UTF8");
	$query = "INSERT INTO Categories (id, name) values (null, '$name')";
	$stmt = $mysqli -> prepare($query);
	$stmt -> execute();
	$id = $stmt -> insert_id;

	echo $id;
	move_uploaded_file($_FILES['image']['tmp_name'], "sys/img/categories/$id.png");
	header("Location: index.php");
}else{
	?>
	<div class="box error">
		Du bist kein Admin !
	</div>
	<?php
}

returnFooter();
?>