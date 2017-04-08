<?php
require_once 'sys/functions/general.php';
require_once 'sys/functions/fetchers.php';
require_once 'sys/settings.php';
returnHeader("Produkt löschen");
checkUserIsOnline();
$id = $_GET['id'];
if(empty($id)){
	?>
	<div class="box error">
		Es muss schon eine Produkt-ID angegeben sein.
	</div>
	<?php
}else{
	$product = fetch_product($id);
	if($product['user_id'] == $_SESSION['user_id'] || $_SESSION['user_isAdmin']){
		$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_DB);
		$mysqli -> set_charset("UTF8");
		$query = "DELETE FROM Products WHERE ID='$id'";
		$stmt = $mysqli -> prepare($query);
		$stmt -> execute();
		unlink("sys/img/products/$id.png");
		header("Location: index.php");
	}else{
		?>
		<div class="box error">
			Du kannst keine fremden Produkte bearbeiten.
		</div>
		<?php
	}
}
returnFooter();
?>