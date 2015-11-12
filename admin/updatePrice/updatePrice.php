<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>	
	function avvio(){
		$(".bgColor4").each(function() {
			var name = $(this).find(".listitemText").find("a").text();
			var description = $(this).find(".listitem_subheader").find("em").text();
			var price = $(this).find("strong").text().replace('EUR ','');
			var taglie = [];
			var getTaglie = $(this).find("select").find("option");
			getTaglie.each(function(){
				taglie.push($(this).text());
			});
			//alert(name+description+price+taglie);
			var senddata = "item="+name+"&descrizione="+description+"&prezzo="+price+"&taglie="+taglie.join(", ");
			alert(senddata);
			//$.post("autoAddItem.php", {data: data});
			$.ajax({
				type:"POST", 
				url:"autoAddItem.php",
				data: senddata});
			});
		$(".bgColor5").each(function() {
			var name = $(this).find(".listitemText").find("a").text();
			var description = $(this).find(".listitem_subheader").find("em").text();
			var price = $(this).find("strong").text().replace('EUR ','');
			var taglie = [];
			var getTaglie = $(this).find("select").find("option");
			getTaglie.each(function(){
				taglie.push($(this).text());
			});
			//alert(name+description+price+taglie);
			var senddata = "item="+name+"&descrizione="+description+"&prezzo="+price+"&taglie="+taglie.join(", ");
			alert(senddata);
			//$.post("autoAddItem.php", {data: data});
			$.ajax({
				type:"POST", 
				url:"autoAddItem.php",
				data: senddata});
			});
	};
	window.onload = avvio;
</script>
</head>
<body>
<div id="main"></div>
<?php 
	$page = "http://www.stellaalpina.com/index.php?id=385&no_cache=1&tx_ttproducts_pi1%5Bcat%5D=48";
	$html = file_get_contents($page);
	echo $html;
?>

</body>
</html>