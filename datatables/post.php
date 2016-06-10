<?php
//Get Config File
require('db_config.php');
//Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

//Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

if(isset($_GET['order'][0]['dir'])) {
  		$orderDir = $_GET['order'][0]['dir'];
  	} else {
  		$orderDir = 'DESC';
}

  	/** Check sorting starts */
  	if(isset($_GET['order'][0]['column'])) {
  		$orderColumn = getOrderByColumn($_GET['order'][0]['column']);
  	} else {
  		$orderColumn = 'id';
  	}

$sql = "SELECT * FROM dataTables";
$result = $conn->query($sql);
$rowcount= $result->num_rows;

$resultFiltered = $rowcount;
$resultTotal = $rowcount;

$length =  $_GET['length'];
$offset = $_GET['start'];

$search = $_GET['search']['value'];
if(!empty($search)){
    $q = "SELECT * FROM dataTables WHERE first_name LIKE '%$search%' ORDER by $orderColumn $orderDir LIMIT $length OFFSET $offset";
}else{
    $q = "SELECT * FROM dataTables ORDER by $orderColumn $orderDir LIMIT $length OFFSET $offset";
}

$res = $conn->query($q);
$output = array(
  			"recordsTotal" => $resultTotal,
  			"recordsFiltered" => $resultFiltered,
  			"aaData" => array(),
  			"draw" => $_GET['draw']
);

if ($res->num_rows > 0) {
    //output data of each row
    while($row = $res->fetch_assoc()) {
        $output['aaData'][] = [
            $row['id'],
            $row['first_name'],
            $row['last_name'],
        ];
    }
} else {
    $output['aaData'] = [];
}

$conn->close();
echo json_encode( $output );

?>