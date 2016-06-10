<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "demo";


function debug($d){
echo "<pre>";
print_r($d);
echo "</pre>";
}

function getOrderByColumn($column){
     switch($column) {
  	  case 0:
  	  	$columnValue = 'id';
  	  	break;
  	  case 1:
  	  	$columnValue = 'first_name';
  	  	break;
      case 1:
  	  	$columnValue = 'last_name';
  	  	break;
  	  default:
  	  	$columnValue = 'id';
  	}
  	return $columnValue;
}
?>