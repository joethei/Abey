<?php
require_once 'sys/functions/fetchers.php';
require_once 'sys/functions/general.php';
returnHeader("Register");
$user = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$password_again = $_POST['password_again'];
$pass = md5($password);

if($user != null && $email != null && $password != null && $password_again != null){
	if($password == $password_again){
		$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_DB);
		$mysqli -> set_charset("UTF8");
		$query = "SELECT * FROM Users WHERE name='$user' OR email='$email'";
		$result = $mysqli -> query($query);
		if(mysqli_num_rows($result) > 0){
			header("Location: register.php?er=use");	
		}else{
			$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_DB);
			$mysqli -> set_charset("UTF8");
			$query = "INSERT INTO Users (name, pass, mail) values ('$user', '$pass', '$email');";
			$stmt = $mysqli -> prepare($query);
			$stmt -> execute();
			header("Location: login.php?w=reg");
		}
	}else{
		header("Location: register.php?er=pw");
	}
}else{
	header("Location: register.php");
}
?>