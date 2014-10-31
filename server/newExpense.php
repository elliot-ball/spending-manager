<?php include_once('mysql_connect.php'); ?>
<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

  $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    @$categoryId = $request->categoryId;
    @$amount = $request->amount;
    @$date = $request->date;
    @$description = $request->description;
// Load $query with the desired query
  $query = "INSERT INTO expenses (
            id ,
            category_id ,
            amount ,
            date ,
            description
            )
            VALUES (
            NULL ,  '".$categoryId."',  '".$amount."',  '".$date."',  '".$description."'
            );";
// Perform database query
// result is a rescource, a collection of databse rows
  $result = $connection->query($query);
// test if there was a query error
  if (!$result) {
    die("Database query failed. Error: " . mysqli_error($connection));
  }

 //  $outp = "[";
	// while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
	//     if ($outp != "[") {$outp .= ",";}
	//     $outp .= '{"id":"'  . $rs["id"] . '",';
	//     $outp .= '"name":"'. $rs["name"]     . '"}'; 
	// }
	// $outp .="]";
 //  echo $outp;
 ?>