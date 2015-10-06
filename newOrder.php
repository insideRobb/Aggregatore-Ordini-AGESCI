<?php
	require("menu.php");
	$db = new ArticoliDb();
	//$db -> addItem("camicia", 24.5, "descrizione camicia", ["S", "M", "L"]);
	//$db -> addItem("pantaloni", 27.5, "decrizione Pantaloni", ["XS", "M", "XL"]);
?>
<body onload="print_row()">
<div class="container form-group">
	
	<!--<ul class="nav nav-pills">
	  <li role="presentation"><a href="index.php">Home</a></li>
	  <li role="presentation" class="active"><a href="#">Nuovo Ordine</a></li>
	  <li role="presentation"><a href="#">Stato Ordine</a></li>
	  <li role="presentation"><a href="#">Amministrazione</a></li>
	</ul>-->

	  <h2>Ordina i tuoi prodotti</h2>
	  <p>Dati Utente</p>            
	  <table class="table">
		<thead>
		  <tr>
			<th>Articolo</th>
			<th>Descrizione</th>
			<th>Taglie Disponibili</th>
			<th>Prezzo</th>
			<th>Quantità</th>
			<th></th>
		  </tr>
		</thead>
		<tbody>
		</tbody>
	  </table>
			
		
	<div id="total"></div>
</div>
</body>
</html>

<script>
<?php
	$item = $db -> getItem();
	$rows = array();
	while($row = $item -> fetchArray()){
		$row["taglie"] = convertStringToArray($row["taglie"]);
		$rows[$row["nome"]]=$row;
	}
	echo "var db=".json_encode($rows).";";
?>
var row_count = 0;
function print_row(){
	var row = $("<tr></tr>");
	var tdnome = $("<td></td>");
	select_nome = $("<select></select>");
	select_nome.addClass("form-control");
	select_nome.attr("onchange", "item_selected(this)");
	select_nome.append($("<option disabled selected></option>").text("Scegli un articolo"));
	for(var i in db){
		var option = $("<option></option>");
		option.append(db[i].nome);
		select_nome.append(option);
	}
	tdnome.append(select_nome);
	row.append(tdnome);
	row.append('<td id="td_descr"></td><td id="td_taglie"></td><td id="td_prezzo"></td><td id="td_quantity"></td><td id="td_button"></td>');
	$("tbody").append(row);
}

function item_selected(item){
	//Assegno id univoco alla riga
	$("tr").attr("id", row_count);
	row_count++;	
	
	//Cerco elemento nel JSON_db
	for(var elemento in db){
		if(db[elemento].nome == item.nome)
			break;
	}
	//Mostro la descrizione
	var descrizione = $("#td_descr");
	descrizione.text(db[elemento].descrizione);
	
	//Mostro le taglie
	var td_taglie = $("#td_taglie");
	var select_taglie = $("<select></select>");
	select_taglie.addClass("form-control");
	var taglie = db[elemento].taglie;
	taglie.forEach(function(x){
		var option = $("<option></option>");
		option.append(x);
		select_taglie.append(option);
	});
	td_taglie.html(select_taglie);
	
	//Mostro il prezzo
	$("#td_prezzo").text(db[elemento].prezzo);
	
	//Costruisco la lista di scelta quantita'
	var quantity = $("#td_quantity");
	var select_quantity = $("<select></select>");
	select_quantity.addClass("form-control");
	select_quantity.attr("onchange", "showTotal(item)");
	for(var i = 1; i<10; i++){
		var option = $("<option></option>");
		option.append(i);
		select_quantity.append(option);
	}
	quantity.append(select_quantity);
	
	//Mostro primo totale
	$("#td_button").html('<button type="button" class="btn btn-success" onclick="updateTotal(this)">Aggiungi</button>');
	
}
function updateTotal() {
	var total = 0;
	print_row();
}
</script>