<?php
	require("ArticoliDb.php");
	require("mail_config.php");
	$db = new ArticoliDb(".");
	$items = json_decode(urldecode($_POST["items"]), true);
	$totale = $_POST["totale"];
	if (isset($_POST['name']))
		$name = $_POST["name"]; else $name = "undefined";
	if (isset($_POST['mail']))
		$mail = $_POST["mail"]; else $mail = "undefined";
	if (isset($_POST['phone']))
		$phone = $_POST["phone"]; else $phone = "undefined";
	if (isset($_POST['pagamento']))
		$pagamento = $_POST['pagamento']; else $pagamento = "undefined";
	if (isset($_POST['branca']))
		$branca = $_POST['branca']; else $branca = "undefined";

	$idOrdine = $db -> addOrder($name, $mail, $phone, $items, $totale, $pagamento, $branca);
   	$url = "saveOrder.php?mail=" . $mail . "&id=" . $idOrdine;
   	header ("Location: $url");
   	exit(0);
?>