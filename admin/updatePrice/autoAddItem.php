<?php 
require("../../menu.php");
$db = new ArticoliDb("../..");
$taglie = explode(",", $_POST["taglie"]);
$db -> addItem($_POST["item"], str_replace(",", ".", $_POST["prezzo"]), str_replace("'", "%27", $_POST["descrizione"]), $taglie);
?>