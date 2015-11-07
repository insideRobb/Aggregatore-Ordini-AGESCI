<?php
	$id = $_GET["id"];
	
	require("../menu.php");
	$db = new ArticoliDb("..");
	
	$result = $db -> query("SELECT * FROM oggettiordinati WHERE id_ordine='$id'");
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
			echo "<td>".$row[1]."</td>";
			echo "<td>".$row[2]."</td>";
			echo "<td>".$row[3]."</td>";
		echo "</tr>";
	}
	echo "	</tbody>
    </table>";
?>