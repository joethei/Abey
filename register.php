<?php
require_once 'sys/functions/general.php';
returnHeader('Registrieren', 'Profil');
$error = $_GET['er'];
if($error == "use"){
	?>
	<div class="box error">Dieser Benutzername oder diese E-Mail ist bereits vergeben.</div>
	<?php
}
if($error == "pw"){
	?>
	<div class="box error">Die beiden Passwörter sollten schon identisch sein.</div>
	<?php
}
?>
<form action="register_send.php" method="post">
	<input type="text" name="username" placeholder="Dein gewünschter Benutzername" required="required"><br>
	<input type="email" name="email" placeholder="Deine E-Mail Adresse" required="required"><br>
	<input type="password" name="password" placeholder="Dein gewünschtes Passwort" required="required"><br>
	<input type="password" name="password_again" placeholder="Wiederhole dein Passwort" required="required"><br>
	<input type="submit" value="Registrieren">
</form>
<?php
returnFooter();
?>