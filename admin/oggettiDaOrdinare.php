<?php
	require("../menu.php");
	$db = new ArticoliDb("..");

	$result = $db -> query("SELECT oggetto, taglia, sum(quantity)  FROM oggettiordinati, ordini WHERE ordini.id = oggettiordinati.id_ordine AND ordini.saldato=1 AND ordini.consegnato=0 GROUP BY oggetto, taglia");
	echo '<table class="table">
			  <thead>
				<tr>
			  	<th>Oggetto</th>
			  	<th>Taglia</th>
			  	<th>Quantità</th>
				</tr>
			  </thead>
			  <tbody>';
	while($row = $result->fetchArray()){
		echo "<tr>";
			echo "<td>".$row[0]."</td>";
			echo "<td>".$row[1]."</td>";
			echo "<td>".$row[2]."</td>";
		echo "</tr>";
	}
	echo "	</tbody>
	</table>";
?>