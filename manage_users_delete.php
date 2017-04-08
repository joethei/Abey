<?php
require_once 'sys/functions/general.php';
require_once 'sys/functions/fetchers.php';
require_once 'sys/settings.php';
returnHeader("Benutzer löschen");
checkUserIsOnline();
$id = $_GET['id'];
if(empty($id)){
	?>
	<div class="box error">
		Es muss schon eine Benutzer-ID angegeben sein.
	</div>
	<?php
}else{
	$user = fetch_user($id);
	if($user['isAdmin']){
		?>
		<div class="box error">
			Du kannst keine Admin Accounts löschen.
		</div>
		<?php
	}else if($_SESSION['user_isAdmin'] || $user['id'] == $_SESSION['user_id']) {
		$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_DB);
		$mysqli -> set_charset("UTF8");
		$query = "DELETE FROM Users WHERE ID=$id";
		$stmt = $mysqli -> prepare($query);
		$stmt -> execute();
		$query2 = "DELETE FROM Products WHERE user_id=$id";
		$products = fetch_products($id);
		foreach($products as $this_product) {
			include 'manage_products_delete.php?id=$this_product["id"]';
		}
		$stmt2 = $mysqli -> prepare($query2);
		$stmt2 -> execute();
		if($user['id'] == $_SESSION['user_id']) {
			session_destroy();	
		}
		header("Location: manage_users.php");
	}else{
		?>
		<div class="box error">
			Du kannst keine fremden Accounts löschen.
		</div>
		<?php
	}
}
returnFooter();
?>