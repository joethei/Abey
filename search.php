<?php
	require_once('sys/functions/general.php');
	require_once('sys/functions/fetchers.php');
	
	if (isset($_GET['search']))
		$pagetitle = 'Suchergebnisse';
	else
		$pagetitle = 'Suche';
	
	returnHeader($pagetitle, 'Suchen');
	
	?>
	
	<h1><?php echo $pagetitle ?></h1>
	
	<?php
	
	$search_name = (isset($_GET['name']) ? $_GET['name'] : '');
	
	$search_cats = (isset($_GET['cats']) ? json_decode($_GET['cats']) : array());
	
	$search_user = (isset($_GET['user']) ? $_GET['user'] : '');
	
	if (!$search_user == '')
		$search_own = ($_SESSION['user_name'] == $search_user ? true : false);
	else
		$search_own = false;
	
	?>
	
	<div class="search-topbar need-clearfix">
		<form action="search_send.php" method="post">
			<div class="option-group">
				Suchbegriff
				<input type="text" name="name" required="required" value="<?php echo (isset($_GET['name']) ? $_GET['name'] : '') ?>">
			</div>
			
			<div class="option-group">
				Kategorie
				<div class="search-cats">
					
					<label>
						<input type="checkbox" id="allcats" name="cats[]" value="0">Alle Kategorien
					</label>
					
					<?php
					
					$cats = fetch_categories();
					
					foreach ($cats as $this_cat) {
						?>
						<label>
							<input type="checkbox" name="cats[]" value="<?php echo $this_cat['id'] . '"' . (in_array($this_cat['id'], $search_cats) ? ' checked="checked"' : '') . '>' . $this_cat['name'] ?>
						</label>
						<?php
					}
					?>
					
				</div>
			</div>
			
			<div class="option-group">
				<button>Suchen</button>
			</div>
		</form>
	</div>
	
	<?php
	
	$products = fetch_products($search_name, $search_cats, $search_user);
	
	echo count($products) . ' Ergebnisse für <b>' . (empty($search_name) ? '<em>alles</em>' : $search_name) . '</b> in <b>';
	
	$search_cats_out = '';
	$a = 0;
	
	if (!empty($search_cats)) {
		foreach ($cats as $this_cat) {
			if (in_array($this_cat['id'], $search_cats)) {
				if ($a != 0) {
					$search_cats_out .= ', ';
				}
				$search_cats_out .= $this_cat['name'];
				$a++;
			}
		}
	}
	
	echo (empty($search_cats_out) ? '<em>überall</em>' : $search_cats_out) . '</b>';
	
	if (!empty($search_user)) {
		echo ' von <b>' . fetch_user($search_user)['name'] . '</b>';
	}
	
	?>
	
	<button type="button" onclick="$('#debug').slideToggle('fast');">Show/hide Debugging Infos</button>
	
	<div id="debug" style="display: none;">
		<textarea readonly="readonly" style="width: 100%; height: 500px">
			<?php echo json_encode($products, JSON_PRETTY_PRINT); ?>
		</textarea>
	</div>
	
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