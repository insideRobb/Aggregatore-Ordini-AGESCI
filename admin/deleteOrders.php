<?
	require("../menu.php");
	$db = new ArticoliDb("..");
	$orderIDS = $db -> getOrdersData();
	while($order = $orderIDS -> fetchArray() ){
		$id = $order["id"];
		if ( isset( $_POST["id-".$id] ) ){
			$db -> exec("DELETE FROM ordini WHERE id='$id'");
			echo "L'ordine ".$id." è rimosso correttamente <br/>";
		}
	}
	echo 'Torna a <a href="seeOrders.php">gestione ordini</a>';
?>