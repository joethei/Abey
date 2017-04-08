<?php
require_once 'sys/functions/general.php';
require_once 'sys/functions/fetchers.php';

function returnError() {
	returnHeader('Produkt nicht gefunden');
	?>
	<div class="box error">
		<b>Das Produkt konnte leider nicht gefunden werden.</b>
	</div>
	<?php
	returnFooter();
}
checkUserIsOnline();
//TODO: remove automatic email sending without buying stuff
$id = $_GET['id'];
$this_product = fetch_product($id);
if($id != null || !$this_product = fetch_product($id)){
	if($_SESSION['user_name'] == null)
		return;

	if()
	returnHeader("Kaufe " . $this_product['name']);
	?>
	Du hast das Produkt <?php echo $this_product['name'] ?> von <?php echo $this_product['user_name'] ?> gekauft.
	<?php
	$headers = 'From: Abey Kleinanzeigen <system@abey.cf>' . "\n" .
    'Reply-To: Abey Kleinanzeigen <reply@abey.cf>' . "\n";
	$headers .= "MIME-Version: 1.0" . "\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\n";
	
	//zum Käufer
	$user_buy = fetch_user($_SESSION['user_id']);
	$to_buy = $user_buy['mail'];
	$subject_buy = "Dein Kauf bei Abey";
	$message_buy = '<!DOCTYPE html>
	<html>
	Du hast das Produkt <strong>' . $this_product['name'] . '</strong> von ' . $this_product['user_name'] . ' für ' . $this_product['price'] . '€ gekauft
	</html>';
	$msg_buy = wordwrap($message_buy,70);
	mail($to_buy, $subject_buy, $msg_buy, $headers);
	
	//zum Verkäufer
	$user_sell = fetch_user($this_product['user_id']);
	$to_sell = $user_sell['mail'];
	$subject_sell = "Du musst ein neues Produkt bei Abey versenden.";
	$message_sell = '<!DOCTYPE html>
	<html>
	Du musst dein Produkt <strong>' . $this_product['name'] . '</strong> an ' . $_SESSION['user_name'] . ' versenden.
	</html>';
	$msg_sell = wordwrap($message_sell, 70);
	mail($to_sell, $subject_sell, $msg_sell, $headers);
	?>
	<div class="box info">
		Diese Seite ist in keiner Weise dazu gedacht ebay nachzuahmen, dies ist ein Schulprojekt und nur als Referenz gedacht.
		Wenn du wirklich etwas kaufen möchtest nutze <a href="http://ebay.com">ebay</a>.
	</div>
	<?php
	returnFooter();
}else{
	returnError();
}
?>