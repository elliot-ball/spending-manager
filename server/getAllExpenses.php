<?php include_once('mysql_connect.php'); ?>
<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Load $query with the desired query
  $query = "SELECT expenses.id, name, amount, date, description
            FROM expenses, categories
            WHERE expenses.category_id = categories.id
            ";
            // ORDER BY date DESC";
// Perform database query
// result is a rescource, a collection of databse rows
  $result = $connection->query($query);
// test if there was a query error
  if (!$result) {
    die("Database query failed. Error: " . mysqli_error($connection));
  }
  // $date = strtotime($rs["date"]);
  // $date = date( 'Y-m-d H:i:s', $date );
  $outp = "[";
  while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    
    if ($outp != "[") {$outp .= ",";}
      // convert mySql date to uk date format
      // $date = DateTime::createFromFormat('Y-m-d H:i:s', $rs["date"]);
      // $dateToBeInserted = $date->format('d/m/Y');
      $date = DateTime::createFromFormat('Y-m-d H:i:s', $rs["date"]);
      $outp .= '{"id":"'  . $rs["id"] . '",';
      $outp .= '"name":"'   . $rs["name"]        . '",';
      $outp .= '"amount":"'   . $rs["amount"]        . '",';
      $outp .= '"date":"'   . $date->format('d/m/Y') . '",';
      $outp .= '"description":"'. $rs["description"]     . '"}'; 
	}
	$outp .="]";
  echo $outp;
 ?>