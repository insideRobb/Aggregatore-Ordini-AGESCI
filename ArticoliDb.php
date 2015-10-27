<?php
	class ArticoliDb extends SQLite3{
		function __construct($dir){
			$this -> open($dir."/database.db", SQLITE3_OPEN_READWRITE | SQLITE3_OPEN_CREATE, "password");
			$this -> exec("CREATE TABLE IF NOT EXISTS articoli (nome TEXT PRIMARY KEY UNIQUE, descrizione REAL, taglie TEXT, prezzo INT)");
			$this -> exec("CREATE TABLE IF NOT EXISTS ordini (id INTEGER PRIMARY KEY UNIQUE, data INT, nome TEXT, email TEXT, branca TEXT, telefono INT, totale REAL, pagamento TEXT, saldato INT, consegnato INT)");
			$this -> exec("CREATE TABLE IF NOT EXISTS oggettiordinati (id_ordine INT, oggetto TEXT, taglia TEXT, quantity INT)");
		}

		function convertArrayToString($array){
			$strSeparator = "__,__";
			$str = "";
			foreach ($array as $oggetto) {
				$str = $str.$oggetto.$strSeparator;	
			}
			return str;
		}
		
		function convertStringToArray($str){
			$strSeparator = "__,__";
			$arr = explode($strSeparator, $str);
			return $arr;
		}
		
		function addOrder($nome, $email, $telefono, $oggetti, $totale, $pagamento, $branca){
			$now = date("d.m.y");
			$this -> exec("INSERT INTO ordini (data, nome, email, branca, telefono, totale, pagamento, saldato, consegnato) VALUES ('$now', '$nome', '$email', '$branca', '$telefono', '$totale', '$pagamento', 0, 0)");
			$idOrdine = $this -> lastInsertRowID();
			for($i=0; $i<count($oggetti); $i++){
				$item = $oggetti[$i]['item'];
				$taglia = $oggetti[$i]['taglia'];
				$quantity = $oggetti[$i]['quantity'];
				$this->exec("INSERT INTO oggettiordinati VALUES ('$idOrdine','$item', '$taglia', '$quantity')");
			}
			return $idOrdine;
		}
		
		function setPaid($id){
			$ordine = $this -> query("SELECT * FROM ordini WHERE id=$id");
			if($dati = $ordine -> fetchArray() )
				$this -> exec("UPDATE ordini SET $saldato=1 WHERE id=$id");
				return $dati;
			return NULL;
		}
		
		function setDelivered($id){
			$ordine = $this -> query("SELECT * FROM ordini WHERE id=$id");
			if($dati = $ordine -> fetchArray()){
				$this -> exec("UPDATE ordini SET $consegnato=1 WHERE id=$id");
				return $dati;
			}
			return NULL;
		}
		
		function addItem($nome, $prezzo, $descrizione, $taglie){
			$taglie_str = convertArrayToString($taglie);
			
			$this -> exec("INSERT INTO articoli (nome, prezzo, descrizione, taglie) VALUES ('$nome', '$prezzo', '$descrizione', '$taglie_str')");
		}
		
		function removeItem($id){
			$this -> exec("DELETE * FROM articolo WHERE nome='$id'");
		}
		
		function getOrderUser($email){
			$this -> query("SELECT * FROM ordini WHERE $email='$email'");
		}
		
		function getItem(){
			return $this->query("SELECT * FROM articoli");
		}
		
		function getPrice($item){
			$result = $this->query("SELECT prezzo FROM articoli WHERE nome='$item'");
			$dato = $result -> fetchArray();
			return $dato[0];
		}
		
		function getOrdersData(){
			$result = $this ->query("SELECT * FROM ordini");
			if ($result != NULL) return $result;
			else return NULL;
		}
		function getOrderItem($id){
			return $this -> query("SELECT * FROM oggettiordinati WHERE id_ordine='$id'");
		}
		
		function getOrderData($id){
			return $this -> query("SELECT * FROM ordini WHERE id='$id'");
		}
		function getAllOrderItem(){
			return $this -> query("SELECT * FROM oggettiordinati");
		}
	}
?>