<?php
include("connection.php");
    $data=$_REQUEST['data'];
    $lat=$data['drawlat'];
    $lng=$data['drawlng'];
    $cityaddress=$data['cityaddress'];
    $datetime = date('Y-m-d H:i:s');
    
$query = "INSERT INTO `example_addresses` (`Timestamp`, `lat`, `lng`, `cityaddress`) VALUES ('$datetime', '$lat', '$lng', '$cityaddress')";
// echo $query;
// exit();
$result = mysqli_query($conn, $query) or die('Error querying database.');

echo json_encode($result);
mysqli_close($conn);

?>