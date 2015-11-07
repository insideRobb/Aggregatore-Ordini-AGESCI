<?
	require("../menu.php");
	$db = new ArticoliDb("..");
	$orderIDS = $db -> getOrdersData();
	while($order = $orderIDS -> fetchArray() ){
		$id = $order["id"];
		if ( isset( $_POST["id-".$id] ) ){
			$db -> exec("UPDATE ordini SET saldato=1 WHERE id='$id'");
			echo "L'ordine ".$id." è stato impostato pagato <br/>";
		}
	}
	echo 'Torna a <a href="seeOrders.php">gestione ordini</a>';
?>