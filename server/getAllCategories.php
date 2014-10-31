<?php include_once('mysql_connect.php'); ?>
<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Load $query with the desired query
  $query = "SELECT id, name
            FROM categories";
// Perform database query
// result is a rescource, a collection of databse rows
  $result = $connection->query($query);
// test if there was a query error
  if (!$result) {
    die("Database query failed. Error: " . mysqli_error($connection));
  }

  $outp = "[";
	while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
	    if ($outp != "[") {$outp .= ",";}
	    $outp .= '{"id":"'  . $rs["id"] . '",';
	    $outp .= '"name":"'. $rs["name"]     . '"}'; 
	}
	$outp .="]";
  echo $outp;
 ?>