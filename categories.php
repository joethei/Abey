<?php
require_once ('sys/functions/general.php');
require_once ('sys/functions/fetchers.php');

returnHeader("Alle Kategorien");

?>

<h1>Alle Kategorien</h1>

<ul class='catlist'>
	<?php
	$cats = fetch_categories();
					
	foreach($cats as $this_cat){
		?>
			<li>
				<a href='search.php?search&cats=["<?php echo $this_cat['id'] ?>"]'>
				<div class="cat_img"><img src="sys/img/categories/<?php echo $this_cat['id'] ?>.png"></div>
				<div class="cat_text"><?php echo $this_cat['name'] ?></div>
				</a>
			</li>
		<?php
		}
		?>
</ul>

<?php

returnFooter();
?>