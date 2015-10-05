<?php
	require("menu.php");
	$db = new ArticoliDb();
	/*$db -> query("INSERT INTO articoli VALUES ('camicia', 24.5, 'descrizione', 'taglie')");
	$db -> query("INSERT INTO articoli VALUES ('camicia1', 124.5, '1descrizione', '1taglie')");*/
?>
<body>
<div class="container">
	
	<ul class="nav nav-pills">
	  <li role="presentation"><a href="index.php">Home</a></li>
	  <li role="presentation" class="active"><a href="#">Nuovo Ordine</a></li>
	  <li role="presentation"><a href="#">Stato Ordine</a></li>
	  <li role="presentation"><a href="#">Amministrazione</a></li>
	</ul>
	
	<form method="post" name="modulo" class="form-inline" role="form">
	<table class="table table-condensed">
		<thead>
			<tr>
				<th data-field="nome">Oggetto</th>
				<th data-field="descrizione">Descrizione</th>
				<th data-field="taglie">Taglia</th>
				<th data-field="prezzo">Prezzo</th>
			</tr>
			<?
				$result = $db -> getItem();
				while($row = $result -> fetchArray()){
					echo "<tr>";
						echo "<th>".$row[0]."</th>";
						echo "<th>".$row[2]."</th>";
						$taglie =  convertStringToArray($row[3]);
						echo '<th> <select class="form-control" id="sel1" name="'.$row['nome'].'">';
						for($i=0; $i < count($taglie); $i++){
								echo "<option>".$taglie[$i]."</option>";
						}
						echo "</select>";
						echo "<th>".$row[3]."</th>";
						echo "<th>".$row[1]."</th>";
					echo "</tr>";
				}	
			?>
		</thead>
	</table>
	
	<input type="button" value="Invia" onClick="Modulo()">
</form>
</div>
</body>
</html>