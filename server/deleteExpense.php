<?php include_once('mysql_connect.php'); ?>
<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

  $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    @$id = $request->id;
// Load $query with the desired query
  $query = "DELETE FROM expenses 
            WHERE expenses.id = ".$id.";";
// Perform database query
// result is a rescource, a collection of databse rows
  $result = $connection->query($query);
// test if there was a query error
  if (!$result) {
    die("Database query failed. Error: " . mysqli_error($connection));
  }
 ?>