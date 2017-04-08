<?php
	require_once('sys/functions/general.php');
	require_once ('sys/functions/fetchers.php');
	
	returnHeader('Startseite');
?>

<div class="box info">
	Diese Seite ist in keiner Weise dazu gedacht ebay nachzuahmen, dies ist ein Schulprojekt und nur als Referenz gedacht.
	Wenn du wirklich etwas kaufen möchtest nutze <a href="http://ebay.com">ebay</a>.
</div>

<h1>Willkommen bei Abey!</h1>

<h3>Vorschläge für dich:</h3>

<ul class="productlist">

<?php

	$products = fetch_random_products(5);
	
	foreach ($products as $this_product) {
		?>
		
		<li class="need-clearfix">
			<div class="prod_imgbox">
				<a href="product.php?id=<?php echo $this_product['id'] ?>">
					<img src="sys/img/products/<?php echo $this_product['id'] ?>.png">
				</a>
			</div>
			<div class="prod_detailbox">
				<a class="prod-name" href="product.php?id=<?php echo $this_product['id'] ?>"><?php echo $this_product['name'] ?></a>
				<span class="prod-price"><?php echo number_format($this_product['price'], 2, ',', '.') ?> €</span>
				
				<div class="prod-infos">
					<?php
						echo 'von <a href=\'search.php?search&user=' . $this_product['user_id'] . '\'>' . $this_product['user_name'] . '</a> / ';
						echo 'in <a href=\'search.php?search&cats=["' . $this_product['cat_id'] . '"]\'>' . $this_product['cat_name'] . '</a>'?>
				</div>
				<div class="prod-desc"><?php echo $this_product['description'] ?></div>
			</div>
		</li>
		
		
		<?php
	}
	?>
	
</ul>

<?php
returnFooter();
?>