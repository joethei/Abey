<?php
require_once 'sys/functions/general.php';
require_once 'sys/functions/fetchers.php';
returnHeader("Neues Produkt einstellen");
checkUserIsOnline();
returnFooter();
$name = $_POST['name'];
$description = $_POST['description'];
$cat = $_POST['cat'];
$price = $_POST['price'];
$user = $_SESSION['user_id'];

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_DB);
$mysqli -> set_charset("UTF8");
$query = "INSERT INTO Products (id, name, cat_id, user_id, description, price) values (null, '$name', '$cat', '$user', '$description', '$price')";
$stmt = $mysqli -> prepare($query);
$stmt -> execute();
$id = $stmt -> insert_id;

echo $id;
unlink("sys/img/products/$id.png");
move_uploaded_file($_FILES['image']['tmp_name'], "sys/img/products/$id.png");
header("Location: product.php?id=$id");
