<?php
require_once 'sys/functions/general.php';
require_once 'sys/functions/fetchers.php';
returnHeader("Produkt bearbeiten");
checkUserIsOnline();
$id = $_POST['id'];
$name = $_POST['name'];
$description = $_POST['description'];
$cat = $_POST['cat'];
$price = $_POST['price'];
$user = $_POST['user'];

if(!empty($user)){
	$user_id = $user;
}else{
	$user_id = $_SESSION['user_id'];
}

if(!empty($_POST['image'])) {
    header("Location: ");
    return;
}

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_DB);
$mysqli -> set_charset("UTF8");
$query = "UPDATE Products SET name='$name', cat_id='$cat', user_id='$user_id', description='$description', price='$price' WHERE id=$id";
$stmt = $mysqli -> prepare($query);
$stmt -> execute();

move_uploaded_file($_FILES['image']['tmp_name'], "sys/img/products/$id.png");
returnFooter();
header("Location: product.php?id=$id");