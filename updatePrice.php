<?php
set_time_limit(0) ;
	$page = "http://www.stellaalpina.com/index.php?id=385&no_cache=1&tx_ttproducts_pi1%5Bcat%5D=57";
	$page = file_get_contents($page);
	$nocomment = "/<!--(.|\n)*?-->/";
	$page = preg_replace($nocomment, '', $page);
	$pattern = "/bgColor[45](.|\n)*?<h3><a[^>]*>([^<]*)(.|\n)*?<em>([^<]*)(.|\n)*?<strong>EUR ([^<]*)(.|\n)*?(<select(.|\n)*?\/select>)/";
	$select = "/<option[^>]*>([^<]*)<\/option>/";
	preg_match_all($pattern, $page, $matches, PREG_SET_ORDER);
	var_dump($matches);
	for($i=0; $i < count($matches); $i++){
		$name = $matches[$i][1];
		$description = $matches[$i][2];
		$price = $matches[$i][3];
		preg_match_all($select, $matches[$i][4], $sels, PREG_SET_ORDER);
		$sizes = "";
		for($j = 0; $j < count($sels); $j++){
			$sizes .= $matches[$j][1];
			if($j < count($sels) - 1) $sizes .= ', ';
		}
		// echo $name.PHP_EOL;
		// echo $description.PHP_EOL;
		// echo $price.PHP_EOL;
		// echo $sizes.PHP_EOL;
	}
	
?>