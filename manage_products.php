<?php
require_once 'sys/functions/general.php';
require_once 'sys/functions/fetchers.php';

checkUserIsOnline();

returnHeader('Produktverwaltung');
?>
	
	<h1>Produktverwaltung</h1>
	
	<?php
	if ($_SESSION['user_isAdmin']){
		$products = fetch_products('', '', '', false);
	}else{
		$search_user = $_SESSION['user_name'];
		$products = fetch_products('', '', $_SESSION['user_id'], false);
	}
	
	echo count($products) . ' registrierte Produkte von ';
	
	if (!empty($search_user))
		echo '<b>' . $search_user . '</b>';
	else
		echo '<b><em>allen Nutzern</em></b>';
	
	?>
	
	<ul class="productlist">
	
	<?php
	
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
				<a class="button" href="manage_products_delete.php?id=<?php echo $this_product['id'] ?>"><i class="fa fa-remove fa-fw"></i></a>
				<a class="button" href="manage_products_edit.php?id=<?php echo $this_product['id'] ?>">Bearbeiten</a>
				<div class="prod-infos">
					<?php
					if(empty($search_user)){
						echo 'von <a href=\'search.php?search&user=' . $this_product['user_id'] . '\'>' . $this_product['user_name'] . '</a> / ';
					}
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