<?php
require_once 'sys/functions/general.php';
require_once 'sys/functions/fetchers.php';
returnHeader("Benutzerverwaltung");
checkUserIsOnline();
?>
	
	<h1>Benutzerverwaltung</h1>

	<?php
	if ($_SESSION['user_isAdmin']){
		$users = fetch_users();
		echo count($users) . ' registrierte Benutzer.';
		?>
		<br><br>
		<ul class="userlist">
		<?php
		foreach ($users as $this_users) {
		?>	
		<li class="need-clearfix">
			<div class="userlist_user-name">
				<a class="user-name" href="search.php?search&user=<?php echo $this_users['id'] ?>"><?php echo $this_users['name']?></a>
				<?php echo $this_users['mail']?>
				<?php echo $this_users['registered']?>
				<?php
				if($this_users['isAdmin']){
					echo "Admin !!!";
				}
				?>
				<a class="button" href="manage_users_delete.php?id=<?php echo $this_users['id'] ?>"><i class="fa fa-remove fa-fw"></i></a>
			</div>
		</li>
		<br>
		<?php
	}
	?>
		</ul>
		<?php
		
	}else{
		?>
		<div class="box error">
			Du kannst keine Benutzer bearbeiten weil du kein Admin bist.
		</div>
		<?php
	}
	?>
	<?php

returnFooter();
?>