<?php 

// TODO:
// add more stat queries
// get all data into array
// make the angular fetch the data


 ?>
<?php include_once('mysql_connect.php'); ?>
<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Load $query with the desired query
// Percent of income spent this month
  $query = "SELECT ROUND(SUM(amount) / (income / 12) * 100) as thisMonthPercentOfIncomeSpent, SUM(amount) as amountSpent 
            FROM expenses, users 
            WHERE MONTH(date) = MONTH(CURDATE()) 
            LIMIT 0,1; ";
// Average daily spend this month
  $query.= "SELECT ROUND(SUM(amount) / DAYOFMONTH(CURDATE()), 2) as thisMonthAverageDaySpend 
            FROM expenses 
            WHERE MONTH(date) = MONTH(CURDATE()) 
            LIMIT 0,1;";
// TODO: Average daily spend for previous month

// Perform database query
// result is a rescource, a collection of databse rows
  $result = $connection->multi_query($query);
  $result = $connection->store_result();
// test if there was a query error
  if (!$result) {
    die("Database query failed. Error: " . mysqli_error($connection));
  }
  // $date = strtotime($rs["date"]);
  // $date = date( 'Y-m-d H:i:s', $date );
  $outp = "[";
  while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    
    if ($outp != "[") {$outp .= ",";}
      $outp .= '{"thisMonthPercentOfIncomeSpent":"'  . $rs["thisMonthPercentOfIncomeSpent"] . '",';
      $outp .= '"thisMonthAverageDaySpend":"'. $rs["thisMonthAverageDaySpend"]     . '"}'; 
	}
	$outp .="]";
  echo $outp;
 ?>