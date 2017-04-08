<?php
require_once 'sys/functions/general.php';
require_once 'sys/functions/fetchers.php';
returnHeader("Produkt bearbeiten");
checkUserIsOnline();

$id = $_GET['id'];
$product = fetch_product($id);
if(empty($id)){
	?>
	<div class="box error">
		Es muss eine Produkt-ID angegeben werden.
	</div>
	<?php
	}else if($product['user_id'] == $_SESSION['user_id'] || $_SESSION['user_isAdmin']){
	?>
	<form action="manage_products_edit_send.php" method="post" enctype="multipart/form-data">
		<input type="hidden" value="<?php echo $id ?>" name="id"/>
		Name: <input type="text" name="name" value="<?php echo $product['name'] ?>" required="required"/><br><br>
		Beschreibung: <input type="text" name="description" value="<?php echo $product['description'] ?>" required="required"/><br><br>
		Kategorie:
		<select name="cat">
			<option>Kategorie auswählen</option>
							<?php
							
							$cats = fetch_categories();
							
							$checked_cats = array($product['cat_id']);
							
							foreach ($cats as $this_cat) {
								echo '<option value="' . $this_cat['id'] . '"' . (in_array($this_cat['id'], $checked_cats) ? ' selected="selected"' : '') . '>' . $this_cat['name'] . '</option>';
							}
							
							?>
		</select><br><br>
		<?php
		if($_SESSION['user_isAdmin']){
			?>
			Benutzer:
			<select name="user">
			<option>Benutzer auswählen</option>
							<?php
							
							$users = fetch_users();
							
							$checked_users = array($product['user_id']);
							
							foreach ($users as $this_users) {
								echo '<option value="' . $this_users['id'] . '"' . (in_array($this_users['id'], $checked_users) ? ' selected="selected"' : '') . '>' . $this_users['name'] . '</option>';
							}
							
							?>
			</select><br><br>
			<?php
		}
		?>
		Preis (in Euro): <input type="number" name="price" value="<?php echo $product['price'] ?>" required="required"/><br><br>
		<input type="hidden" name="MAX_FILE_SIZE" value="100000" />
		Bild:
		<ul class="productlist">
		<li class="need-clearfix">
		<div class="prod_imgbox">
			<img src="sys/img/products/<?php echo $product['id'] ?>.png">
		</div>
		</li>
		<div>
			<input type="file" name="image" placeholder="Bild" id="image" accept=".png">
		</div>
		</ul>
		<input type="reset">
		<input type="submit">
	</form>
	<?php
	}else{
	?>
	<div class="box error">
		Du kannst keine fremden Produkte bearbeiten.
	</div>
	<?php
	}

returnFooter();
?>