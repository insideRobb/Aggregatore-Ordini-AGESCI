<?php 

	$page = "http://www.stellaalpina.com/index.php?id=385&no_cache=1&tx_ttproducts_pi1%5Bcat%5D=57";
	$html = file_get_contents($page);
	echo $html;
?>