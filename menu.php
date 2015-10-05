<? require("ArticoliDb.php"); 
  function convertArrayToString($array){
    $strSeparator = "__,__";
    $str = "";
    for($i=0; $i<count($array); $i++) {
      $str = $str.$array[$i].$strSeparator;	
    }
    return $str;
  }
  
  function convertStringToArray($string){
    $strSeparator = "__,__";
    $array = explode($strSeparator, $string);
    return $array;
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Gestione Ordini Uniformi</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
