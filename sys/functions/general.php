<?php
	
	session_start();
	
	require_once('sys/settings.php');
	require_once('sys/functions/fetchers.php');
	
	function checkUserIsOnline($redirect = true) {
		if(!$_SESSION['user_name'] == "") return false;
		if (!$_SESSION['user_name']) {
			if ($redirect) header('Location: login.php?w=login');
			return false;
		}
		else {
			return true;
		}
	}
	
	function filter($data){
		return trim(htmlspecialchars($data));
	}
	
	function returnHeader($this_sitename, $this_menuEntryName = '') {
				
		if ($this_menuEntryName == '')
			$this_menuEntryName = $this_sitename;
		
		$user_name = (isset($_SESSION['user_name']) ? $_SESSION['user_name'] : '');
		?>
		<!DOCTYPE html>
		<html>
		<head>
			
			<!--
				Smart developers always view source :)
				
				(c) Alexander Regier, Johannes Theiner 2015
				
				made with love in germany.
			-->
			
			<title><?php echo $this_sitename . ' - ' . BRAND?></title>
			
			<meta charset="utf-8">
			<meta name="author" content="Alexander Regier & Johannes Theiner">
			<!--<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">-->
			<?php
			if(($this_sitename == 'Impressum')) {
				?>
				<meta name="robots" content="noindex">
				<?php
			}
			?>
			<link rel="author" href="humans.txt">
			
			<link rel="stylesheet" href="sys/css/style.css">
			<link rel="stylesheet" href="sys/css/font-awesome.min.css">
			<link rel="icon" type="image/png" href="sys/img/logo.png">
		
		</head>
		<body>
			<header>
				<noscript>
					<div class="box error">
						Du hast kein Javascript aktiviert, bitte aktiviere es.
					</div>
				</noscript>
				<div class="header-inner">
					<a href="index.php"><div class="header-logo">
						<img src="sys/img/logo.png">
					</div></a>
					<nav>
						<ul>
							<li<?php echo ($this_menuEntryName == 'Startseite' ? ' class="active"' : '') ?>><a href="index.php"><i class="fa fa-home fa-fw"></i> Startseite</a></li>
							<li<?php echo ($this_menuEntryName == 'Suchen' ? ' class="active"' : '') ?>><a href="search.php"><i class="fa fa-search fa-fw"></i> Suchen</a></li>
							<li<?php echo ($this_menuEntryName == 'Alle Kategorien' ? ' class="active"' : '') ?>><a href="categories.php"><i class="fa fa-globe fa-fw"></i> Kategorien</a></li>
							<li<?php echo ($this_menuEntryName == 'Über' ? ' class="active"' : '') ?>><a href="about.php"><i class="fa fa-pencil fa-fw"></i> Über</a></li>
							<li class="userli<?php echo ($this_menuEntryName == 'Profil' ? ' active' : '') ?>">
								
								<?php
								if ($user_name == '') {
									?>
									<a href="#"><i class="fa fa-user fa-fw"></i> Nicht angemeldet</a>
									<ul>
										<li><a href='login.php'><i class='fa fa-user fa-fw'></i>Login</a></li>
										<li><a href='register.php'><i class="fa fa-user-plus fa-fw"></i>Registrieren</a></li>
									</ul>
									<?php
								}
								else {
									?>
									<a href="#"><i class="fa fa-user fa-fw"></i> <?php echo $user_name ?></a>
									<ul>
										<li><a href="manage_products_new.php"><i class="fa fa-plus-circle fa-fw"></i> Neues Produkt einstellen</a></li>
										<li><a href="manage_products.php"><i class="fa fa-dashboard fa-fw"></i> Produkte bearbeiten</a></li>
										<?php
										if($_SESSION['user_isAdmin']){
											?>
											<li><a href="categories_new.php"><i class="fa fa-plus fa-fw"></i> Kategorie anlegen</a></li>
											<li><a href="manage_users.php"><i class="fa fa-users"></i> Benutzer bearbeiten</a></li>
											<?php
										}
										?>
										<li><a href="profile.php"><i class="fa fa-cogs fa-fw"></i> Profil bearbeiten</a></li>
										<li><a href="settings.php"><i class="fa fa-cog fa-fw"></i> Einstellungen</a></li>
										<li><a href="logout.php"><i class=" fa fa-lock fa-fw"></i> Logout</a></li>
									</ul>
									<?php
								}
								?>
							</li>
						</ul>
					</nav>
				</div>
			</header>
			
			<section class="page-container need-clearfix">
			
				<section class="sitebar-left">
					<form class="sitebar-search" action="search_send.php" method="post">
						<h2>Schnellsuche</h2>
						
						<label>
							Was suchst du?
							<input type="text" name="name" required="required" placeholder="zB. Kinderwagen" value="<?php echo (isset($_GET['name']) ? $_GET['name'] : '') ?>">
						</label>
						
						<select name="cats[]" multiple="multiple">
							<option>Alle Kategorien</option>
							
							<?php
							
							$cats = fetch_categories();
							
							if (isset($_GET['cats']))
								$checked_cats = json_decode($_GET['cats']);
							else
								$checked_cats = array();
							
							foreach ($cats as $this_cat) {
								echo '<option value="' . $this_cat['id'] . '"' . (in_array($this_cat['id'], $checked_cats) ? ' selected="selected"' : '') . '>' . $this_cat['name'] . '</option>';
							}
							
							?>
							
						</select>
						
						<button>Suchen</button>
					</form>
				</section>
				
				<section class="page-content">
					<div class="content-inner">
		<?php
	}
	
function returnFooter() {
	?>
					</div>
				</section>
			</section>
			<footer>
				<div class="footer-inner">
					<?php
					date_default_timezone_set('Europe/Berlin');
					$date = date("Y");
					$oldDate = 2015;
					if ($oldDate == $date)
						$dateOutput = $date;
					else
						$dateOutput = $oldDate . '-' . $date;
					?>
						<a href='impress.php'>&copy; <?php echo $dateOutput ?> Abey Kleinanzeigen</a>
				</div>
			</footer>
			<script src="sys/js/jquery-1.11.2.min.js"></script>
			<script src="sys/js/general.js"></script>
		</body>
	</html>
	<?php
}
	
	
	
?>