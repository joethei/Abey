<?php
require_once 'sys/functions/general.php';
require_once 'sys/functions/fetchers.php';
$id = (isset($_GET['id']) ? $_GET['id'] : 0);

function returnError() {
	returnHeader('Produkt nicht gefunden');
	?>
	<div class="box box-error">
		<b>Produkt nicht gefunden</b><br>
		Das Produkt konnte leider nicht gefunden werden.
	</div>
	<?php
}

if ($id == 0) {
	returnError();
}
else {
	if (!$this_product = fetch_product($id)) {
		returnError();
	}
	else {
		returnHeader($this_product['name']);
		?>
		
		<div class="product_details">
			<div class="prod_imgbox">
				<img src="sys/img/products/<?php echo $this_product['id'] ?>.png">
			</div>
			<div class="prod_detailbox">
				<span class="prod-name"><?php echo $this_product['name'] ?></span>
				<span class="prod-price"><?php echo number_format($this_product['price'], 2, ',', '.') ?> €</span>
				
				<div class="prod-infos">
					<?php
						echo 'von <a href=\'search.php?search&user=' . $this_product['user_id'] . '\'>' . $this_product['user_name'] . '</a> / ';
						echo 'in <a href=\'search.php?search&cats=["' . $this_product['cat_id'] . '"]\'>' . $this_product['cat_name'] . '</a>'?>
				</div>
				<div class="prod-desc"><?php echo $this_product['description'] ?></div>
			</div>
			<a href="buy.php?id=<?php echo $id ?>"><button class="prod-buy">
				<i class="fa fa-shopping-cart fa-fw"></i>Kaufen
			</button></a>
		</div>
		
		<?php
	}
}

returnFooter();

?>
