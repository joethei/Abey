<?php
require_once 'sys/functions/general.php';
returnHeader('Login', 'Profil');
$count = $_GET['wrong'];
if(isset($_GET['wrong'])){
	?>
	<div class="box error">Du hast noch <?php echo 5 - $count?> Versuche.</div>
	<?php
}
$w = $_GET['w'];
if($w == "reg"){
	?>
	<div class="box info">
		Du bist nun registriert, bitte loge dich nun mit deinen Daten ein.
	</div>
	<?php
}
if($w == "login"){
	?>
	<div class="box error">
		Du musst dich anmelden um fortzufahren.
	</div>
	<?php
}
?>
<form action="login_send.php" method="post">
	<input type="text" name="username" placeholder="Dein Benutzername" required="required"/><br>
	<input type="password" name="password" placeholder="Dein Passwort" required="required"><br>
	<input type="hidden" name="count" value="<?php echo $count ?>">
	<input type="submit" value="Login">
</form>
<?php
returnFooter();
?>