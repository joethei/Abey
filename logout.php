<?php
require_once 'sys/functions/general.php';
returnHeader("Logout");
session_destroy();
header("Location: index.php");
?>
Du wurdest erfolgreich ausgelogt.
<?php
returnFooter();
?>