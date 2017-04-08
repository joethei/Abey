<?php
require_once 'sys/functions/general.php';
require_once 'sys/functions/fetchers.php';
returnHeader("Profil bearbeiten", "Profil");
checkUserIsOnline();

$user = fetch_user($_SESSION['user_id']);

$name = $user['name'];
$mail = $user['mail'];
$pass = $user['pass'];
$id = $user['id'];

$error = $_GET['er'];
if($error == "pw"){
	?>
	<div class="box error">
		Die Passwörter müssen identisch sein.
	</div>
	<?php
}
if($error == "ex"){
	?>
	<div class="box error">
		Dieser Benutzername und/oder diese E-Mail Adresse ist bereits vergeben.
	</div>
	<?php
}
if($error == "email"){
	?>
	<div class="box error">
		Diese E-Mail Adresse scheint nicht gültig zu sein.
	</div>
	<?php
}
if($error == "em"){
	?>
	<div class="box error">
		Alle Daten müssen ausgefüllt sein.
	</div>
	<?php
}
if($error == "suc"){
		$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_DB);
		$mysqli -> set_charset("UTF8");
	
		$user = $mysqli -> real_escape_string($user);
		$password = $mysqli -> real_escape_string($password);
	
		$query = 'SELECT id, name, mail, isAdmin FROM Users WHERE name="' . $user . '"';
	
		$result = $mysqli -> query($query);
		$record = $result -> fetch_object();
		$_SESSION['user_id'] = $record -> id;
		$_SESSION['user_name'] = $record -> name;
		$_SESSION['user_mail'] = $record -> mail;
		$_SESSION['user_isAdmin'] = $record -> isAdmin;
		
	?>
	<div class="box info">
		Dein Profil wurde geupdatet.
	</div>
	<?php
}

?>
<a href="manage_users_delete.php?id='<?php echo $id ?>'" class="button"><i class="fa fa-remove"></i> Profil löschen</a>
<br><br>
<form action="profile_send.php" method="post">
	Benutzernamen ändern:<input type="text" name="username" value="<?php echo $name ?>" required="required"><br><br>
	E-Mail Adresse ändern:<input type="text" name="e-mail" value="<?php echo $mail ?>" required="required"><br><br>
	Passwort ändern:
	<input type="password" name="password" value="<?php echo $pass ?>" required="required"><br>
	<input type="password" name="password-again" value="<?php echo $pass ?>" required="required"><br>
	<input type="submit"><input type="reset">
</form>
<?php
returnFooter();
?>