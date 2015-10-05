<?php
	class ArticoliDb extends SQLite3{
		function __construct(){
			$this -> open("database", SQLITE3_OPEN_READWRITE | SQLITE3_OPEN_CREATE);
			$this -> exec("CREATE TABLE IF NOT EXISTS articoli (nome TEXT, prezzo REAL, descrizione TEXT, taglie TEXT)");
			$this -> exec("CREATE TABLE IF NOT EXISTS ordini (id INTEGER PRIMARY KEY, data INT, nome TEXT, email TEXT, branca TEXT, telefono INT, oggetti TEXT, totale REAL, pagamento TEXT, saldato INT, consegnato INT)");
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
			$now = date();
			$this -> exec("INSERT INTO ordini (data, nome, email, branca, telefono, oggetti, totale, pagamento, saldato, consegnato) VALUES ($now, '$nome', '$email', '$branca', '$telefono', '$oggetti', '$totale', '$pagamento', 0, 0");
			return $this -> lastInsertRowID();
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
			$this -> exec("INSERT INTO articoli VALUES ('$nome', $prezzo, '$descrizione', '$taglie_str')");
		}
		
		function removeItem($nome, $prezzo){
			$this -> exec("DELETE * FROM articolo WHERE nome='$nome'");
		}
		
		function getOrderUser($email){
			$this -> query("SELECT * FROM ordini WHERE $email='$email'");
		}
		
		function getItem(){
			return $this->query("SELECT * FROM articoli");
		}
	}
?>