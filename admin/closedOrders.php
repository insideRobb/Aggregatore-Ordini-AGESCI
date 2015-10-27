<?php
//ordini (id INTEGER PRIMARY KEY UNIQUE, data INT, nome TEXT, email TEXT, branca TEXT, telefono INT, totale REAL, pagamento TEXT, saldato INT, consegnato INT)
require("../menu.php");
$db = new ArticoliDb("..");
$orderedItems = $db -> getAllOrderItem();
$ordiniConclusi = $db -> query("SELECT * FROM ordini WHERE saldato = 1 AND consegnato = 1 ORDER BY id");
?>
	<div class="container">
	  <h2>Ordini già consegnati</h2>
	  <p>Ordini conclusi che possono essere rimossi dalla base</p>            
	  <table class="table table-striped">
		<thead>
		  <tr>
			<th>ID</th>
			<th>Data</th>
			<th>Nome</th>
			<th>eMail</th>
			<th>Branca</th>
			<th>Telefono</th>
			<th>Totale</th>
			<th>Pagamento</th>
			<th></th>
		  </tr>
		</thead>
		<tbody>
			<form action="deleteOrders.php" method="POST">
<?
while($row = $ordiniConclusi -> fetchArray()){
	?>
	
		  <tr>
			<td><?php echo $row["id"]?></td>
			<td><?php echo $row["data"]?></td>
			<td><?php echo $row["nome"]?></td>
			<td><?php echo $row["email"]?></td>
			<td><?php echo $row["branca"]?></td>
			<td><?php echo $row["telefono"]?></td>
			<td><?php echo $row["totale"]?></td>
			<td><?php echo $row["pagamento"]?></td>

			<td>
				<div class="checkbox" style="position:relative; top:-10px;">
					<?php echo '<input type="checkbox" name="id-'.$row["id"].'" value="'.$row["id"].'">';?>
				</div>
			</td>
		  </tr>
<?
}
?>
		<input type="submit" name="delete" value="CANCELLA DEFINITIVAMENTE ORDINE"/>
			</form>
		</tbody>
	  </table>
	</div>
