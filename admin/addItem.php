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

<b>!!!ATTENTO: ESEGUI QUERY IN DB</b><br/>
<b>articoli</b>(nome TEXT PRIMARY KEY UNIQUE, descrizione REAL, taglie TEXT, prezzo INT)<br/>
<b>ordini</b> (id INTEGER PRIMARY KEY UNIQUE, data INT, nome TEXT, email TEXT, branca TEXT, telefono INT, totale REAL, pagamento TEXT, saldato INT, consegnato INT)<br/>
<b>oggettiordinati</b> (id_ordine INT, oggetto TEXT, taglia TEXT, quantity INT, FOREIGN KEY(id_ordine) REFERENCES ordine(id), FOREIGN KEY(oggetto) REFERENCES articoli(nome))<br/>
<form action="" method="POST">
	Query: <input type="text" name="item2"><br/>
	<input type="submit" name="submit2" value="INVIA"/>
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
if(isset($_POST["submit2"])){
	$result = $db -> query($_POST["item2"]);
	echo "<table>";
	while($row = $result -> fetchArray()){
		echo "<tr>";
		for($i=0; $i < count($row)/2; $i++){
			if($row[$i] == "")
				echo "<td>-</td>";
			else
				echo "<td>| ".$row[$i]." </td>";
		}
		echo "</tr>";
	}
	echo "</table>";
}


?>
	