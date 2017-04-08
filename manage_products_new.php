<?php
require_once 'sys/functions/general.php';
require_once 'sys/functions/fetchers.php';
returnHeader("Neues Produkt einstellen");
checkUserIsOnline();
	?>
	<form action="manage_products_new_send.php" method="post" enctype="multipart/form-data" class="dropzone">
		<input type="text" name="name" placeholder="Produktname" required="required"/><br>
		<input type="text" name="description" placeholder="Produktbeschreibung" required="required"/><br>
		<select name="cat">
			<option disabled="disabled">Kategorie auswählen</option>
							<?php
							
							$cats = fetch_categories();
							
							foreach ($cats as $this_cat) {
                                $checked_cats = null;
                                echo '<option value="' . $this_cat['id'] . '"' . (in_array($this_cat['id'], $checked_cats) ? ' selected="selected"' : '') . '>' . $this_cat['name'] . '</option>';
							}
							
							?>
		</select><br>
		<input type="number" name="price" placeholder="Preis in €" required="required"/><br>
		<input type="hidden" name="MAX_FILE_SIZE" value="100000" />
		<input type="file" name="image" placeholder="Bild" required="required" id="image" accept=".png"/>
		<input type="submit" value="Neues Produkt einstellen">
	</form>
	<?php
returnFooter();
?>