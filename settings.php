<?php
require_once 'sys/functions/general.php';
require_once 'sys/functions/fetchers.php';
returnHeader("Einstellungen", "Profil");
checkUserIsOnline();

$user = fetch_user($_SESSION['user_id']);

$name = $user['name'];
$mail = $user['mail'];
$pass = $user['pass'];
$id = $user['id'];

?>

<?php
returnFooter();
?>