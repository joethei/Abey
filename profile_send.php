<?php
require_once 'sys/functions/general.php';
require_once 'sys/functions/fetchers.php';

checkUserIsOnline();

$username = $_POST['username'];
$mail = $_POST['e-mail'];
$password = $_POST['password'];
$password_again = $_POST['password-again'];
$id = $_SESSION['user_id'];

if($username != null && $username == $_SESSION['user_name']){
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_DB);
	$mysqli -> set_charset("UTF8");
}
if($password != null && $password_again != null){
	if($password == $password_again){
		
	}else{
		header("Location: profile.php?er=pw");
	}
}

if($username != null && $mail != null && $password != null && $password_again != null){
	if($password != $password_again){
		header("Location: profile.php?er=pw");
	}
	if(!filter_var($mail, FILTER_VALIDATE_EMAIL)){
		header("Location: profile.php?er=email");
	}
	if($username == $_SESSION['user_name']){
		$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_DB);
		$mysqli -> set_charset("UTF8");
		$query = "SELECT * FROM Users WHERE name='$username'";
		$result = $mysqli -> query($query);
		if(mysqli_num_rows($result) > 2){
			header("Location: profile.php?er=ex");
		}else{
			$query = "UPDATE Users SET name='$username', pass='$password', mail='$mail' WHERE id='$id'";
			$stmt = $mysqli -> prepare($query);
			$stmt -> execute();
			session_destroy();
			header("Location: profile.php?er=suc");
		}
	}else{
		$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_DB);
		$mysqli -> set_charset("UTF8");
		$query = "SELECT * FROM Users WHERE name='$username";
		$result = $mysqli -> query($query);
		if(mysqli_num_rows($result) > 1){
			header("Location: profile.php?er=ex");
		}else{
			$query = "UPDATE Users SET name='$username', pass='$password', mail='$mail' WHERE id='$id'";
			$stmt = $mysqli -> prepare($query);
			$stmt -> execute();
			session_destroy();
			header("Location: profile.php?er=suc");
		}
	}
}
?>