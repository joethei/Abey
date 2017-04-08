<?php
require_once 'sys/settings.php';
require_once 'sys/functions/general.php';
returnHeader("Login");
$user = $_POST['username'];
$password = $_POST['password'];
$count = $_POST['count'] + 1;

if ($user!=null && $password!=null) {
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_DB);
	$mysqli -> set_charset("UTF8");
	
	$user = $mysqli -> real_escape_string($user);
	$password = $mysqli -> real_escape_string($password);

	$query = 'SELECT id, name, mail, isAdmin FROM Users WHERE name="' . $user . '" and pass="' . md5($password) . '"';
	
	$result = $mysqli -> query($query);
	$record = $result -> fetch_object();
	
	if ($result -> num_rows > 0) {
		$_SESSION['user_id'] = $record -> id;
		$_SESSION['user_name'] = $record -> name;
		$_SESSION['user_mail'] = $record -> mail;
		$_SESSION['user_isAdmin'] = $record -> isAdmin;
		header("Location: index.php");	
	}
	elseif ($count < 5) {
		header("Location: login.php?wrong=$count");
	}
	else {
		header("Location: http://wrongpassword.com");
	}
	
	$mysqli -> close();
}
?>