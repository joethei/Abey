<?php
require_once 'sys/functions/general.php';
require_once 'sys/functions/fetchers.php';
returnHeader("Kategorie anlegen");
checkUserIsOnline();
if($_SESSION['user_isAdmin']){
	?>
	<form action="categories_new_send.php" method="post" enctype="multipart/form-data">
		Name: <input type="text" name="name" required="required" /><br><br>
		<input type="hidden" name="MAX_FILE_SIZE" value="100000" />
		Bild: <input type="file" name="image" placeholder="Bild" required="required" id="image"/><br><br>
		<input type="reset" />
		<input type="submit" />
	</form>
	<?php
}else{
	?>
	<div class="box error">
		Du bist kein Admin !
	</div>
	<?php
}
returnFooter();
?>