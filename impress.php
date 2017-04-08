<?php
require_once 'sys/functions/general.php';
returnHeader("Impressum", "Über");

echo file_get_contents("http://joethei.de/impress.php");

returnFooter();
?>