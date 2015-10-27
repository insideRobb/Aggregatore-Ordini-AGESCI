<?php 
require("../menu.php");
$db = new ArticoliDb("..");
?>

<b>AGGIUNGI ARTICOLI DISPONIBILI DA ACQUISTARE</b>
<form action="" method="POST">
	Nome: <input type="text" name="item"><br/>
	Descrizione: <input type="text" name="descrizione"/><br/>
	Taglie (S, M, ...): <input type"text" name="taglie"/><br/>
	Prezzo: <input type="text" name="prezzo"/><br/>
	<input type="submit" name="submit" value="INSERISCI"/>
</form>

<b>RIMUOVI ARTICOLO DA DISPONIBILI DA ACQUISTARE</b>
<form action="" method="POST">
	Nome: <input type="text" name="item1"><br/>
	<input type="submit" name="submit1" value="RIMUOVI"/>
</form>
<?php
if(isset($_POST["submit"])){
	$taglie = explode(",", $_POST["taglie"]);
	$db -> addItem($_POST["item"], str_replace(",", ".", $_POST["prezzo"]), str_replace("'", "%27", $_POST["descrizione"]), $taglie);
	echo $_POST["item"]." aggiunto correttamente";
}
if(isset($_POST["submit1"])){
	$db -> removeItem($_POST["item1"]);
	echo $_POST["item1"]." rimosso correttamente";
}


?>
	