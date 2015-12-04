<?php
	require("../menu.php");
	
	$db = new ArticoliDb("..");
	$id = $_GET["id"];
	$mail = $_GET["mail"];
	$result = $db -> getOrderData($id);
	if($result == NULL)
		echo "ORDINE NON TROVATO";
	else{
		$row = $result -> fetchArray();
		if($row["email"] != $mail){
			echo "ERRORE: l'ID di quell'ordine non corrisponde alla mail inserita.";
		}
		else{
		$name = $row["nome"];
		$phone = $row["telefono"];
		$pagamento = $row["pagamento"];
		$saldato = ($row["saldato"]==1) ? "SI":"NO";
		$consegnato = ($row["consegnato"]==1) ? "SI":"NO";
		$branca = $row["branca"];
		$items = $db->getOrderItem($id);
	
?>
<title> Ricevuta Ordini </title>
</head>
<body>
<div class="container">
	<div style="
	margin: auto;
	width: 60%;
	padding: 10px;">
	<img src="header.jpg"/></div>
  <h2>Ricevuta Ordine Uniformi # <?php echo $id; ?></h2>
  <h4><?php echo "Nome: <b>".$name."</b> - eMail: <b>".$mail."</b> - Telefono: <b>".$phone."</b> - Branca: <b>".$branca."</b><br/><br/> Modalità Pagamento: <b>".$pagamento."</b> - Saldato: <b>".$saldato."</b> - Consegnato: <b>".$consegnato; ?></b></h4>
  <table class="table table-hover">
	<thead>
	  <tr>
		<th>Articolo</th>
		<th>Taglia</th>
		<th>Quantità</th>
		<th>Prezzo (per unità)</th>
	  </tr>
	</thead>
	<tbody>
	<?php
		while($item = $items -> fetchArray())  {
			echo "<tr>";
			echo "<td>".$item["oggetto"]."</td>";
			echo "<td>".$item["taglia"]."</td>";
			echo "<td>".$item["quantity"]."</td>";
			$prezzo = $db -> getPrice($item["oggetto"], $item["taglia"]);
			echo "<td>€ ".number_format((float)($db->getPrice($item["oggetto"])), 2, ',', '')."</td>";
			echo "</tr>";
		}
		if($costoGestioneOrdine != 0){
			echo "<tr>";
			echo "<td>Costo Gestione Ordine</td>";
			echo "<td>-</td>";
			echo "<td>-</td>";
			echo "<td>€ ".number_format((float)$costoGestioneOrdine, 2, ',', '')."</td>";
			echo "</tr>";
		}
	?>
	<tr>
		<td></td>
		<td></td>
		<td><h4>TOTALE:</h4></td>
		<td><h4><?php echo "€ ".number_format((float)$row["totale"], 2, ',', '');?></h4></td>
	</tr>
	</tbody>
  </table>
  <div id="footer" class="for-print">
  _________________RICEVUTA PER CAPO_________________
  	<h2>Ricevuta Ordine Uniformi # <?php echo $id; ?></h2>
  	<h4><?php echo "Nome: <b>".$name."</b> - eMail: <b>".$mail."</b> - Telefono: <b>".$phone."</b> - Branca: <b>".$branca."</b><br/><br/> Modalità Pagamento: <b>".$pagamento."</b> - Saldato: <b>".$saldato."</b> - Consegnato: <b>".$consegnato; ?></b></h4>
<h5>Totale: <h4><?php echo "€ ".number_format((float)$row["totale"], 2, ',', '');?></h4></h5>
  </div>
	</div>
	
	</body>
	</html>
<?php }} ?>	