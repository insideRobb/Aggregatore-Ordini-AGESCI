<?php
	require("menu.php");
	$db = new ArticoliDb();
	//$db -> addItem("camicia", 24.5, "descrizione camicia", ["S", "M", "L"]);
	//$db -> addItem("pantaloni", 27.5, "pantaloni camicia", ["XS", "M", "XL"]);
?>
<body>
<div class="container">
	
	<ul class="nav nav-pills">
	  <li role="presentation"><a href="index.php">Home</a></li>
	  <li role="presentation" class="active"><a href="#">Nuovo Ordine</a></li>
	  <li role="presentation"><a href="#">Stato Ordine</a></li>
	  <li role="presentation"><a href="#">Amministrazione</a></li>
	</ul>
	
	<form method="post" name="modulo" class="form-inline" role="form" action="sendOrder.php">
	<table class="table table-condensed">
		<thead>
			<tr>
				<th data-field="nome">Oggetto</th>
				<th data-field="descrizione">Descrizione</th>
				<th data-field="taglie">Taglia</th>
				<th data-field="prezzo">Prezzo Unitario</th>
				<th data-field="quantity">Quantità</th>
			</tr>
			<?
				$result = $db -> getItem();
				while($row = $result -> fetchArray()){
					
					echo "<tr>";
						echo "<th>".$row[1]."</th>"; //Nome
						echo "<th>".$row[2]."</th>"; //Descrizione
						$taglie =  convertStringToArray($row[3]);
						echo '<th> <select class="form-control" id="sel1" name="'."taglia".$row['id'].'">';
						for($i=0; $i < count($taglie)-1; $i++){
								echo "<option>".$taglie[$i]."</option>";
						}
						echo "</select></th>";//Taglia
						echo "<th>".$row[4]."</th>"; //Prezzo
						//echo "<th>".$row[4]."</th>";
						echo '<th><select class="form-control" id="sel1" name="quantity'.$row['id'].'" onchange="updateTotal()">';
						for($i=0; $i < 9; $i++){
								echo "<option>".$i."</option>";
						}
					echo "</tr>";
				}	
			?>
		</thead>
	</table>
	<div class="row" >
		<div class="col-sm-4">
		  <label for="ex3">Nome</label>
		  <input class="form-control" id="ex3" type="text" placeholder="Nome del Ragazzo">
		</div>
		<div class="col-sm-4">
		  <label for="ex3">eMail</label>
		  <input class="form-control" id="ex3" type="text">
		</div>
		<div class="col-sm-4">
		  <label for="ex3">Telefono</label>
		  <input class="form-control" id="ex3" type="text">
		</div>
	</div>
	<div class="row">
		<div class="col-sm-4"> 
			<label for="sel1">Branca</label>
			<select class="form-control" id="sel1">
			  <option>Cerchio</option>
			  <option>Reparto</option>
			  <option>Clan</option>
			</select>
		</div>
		<div class="col-sm-4"> 
			<label for="sel1">Metodo Pagamento</label>
			<select class="form-control" id="sel1">
			  <option>Bonifico</option>
			  <option>Contanti</option>
			</select>
		</div>
		<div class="col-sm-4"> 
		<input type="submit" value="Invia">
		</div>
	</div>
</form>
<div id="total"></div>
</div>
</body>
</html>

<script>
function updateTotal() {
	var total = 0;
	<?php
		$items = $db -> getItem();
		while($row = $items -> fetchArray()){
			echo "if(document.modulo.quantity".$row['id'].".value != 0){".PHP_EOL;
			echo "	total +=".$row["prezzo"]."* document.modulo.quantity".$row["id"].".value;}".PHP_EOL;
		}
	?>
	document.getElementById("total").innerHTML = total;
}
</script>