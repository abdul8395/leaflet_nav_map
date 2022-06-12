<?php
include("connection.php");

$query = "SELECT * FROM `example_addresses` where type='business'";
$result = mysqli_query($conn, $query) or die('Error querying database.');
$myArray = array();
while($row = mysqli_fetch_assoc($result)){
  $myArray[] = $row;
}
echo json_encode($myArray);
mysqli_close($conn);

?>