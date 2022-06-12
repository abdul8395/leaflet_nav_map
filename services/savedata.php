<?php
include("connection.php");
    $data=$_REQUEST['data'];
    $lat=$data['drawlat'];
    $lng=$data['drawlng'];
    $Location_Name=$data['Location_Name'];
    // $datetime = date('Y-m-d H:i:s');
    
$query = "INSERT INTO `all_data` (`lat`, `lng`, `location_name`) VALUES ('$lat', '$lng', '$Location_Name')";
// echo $query;
// exit();
$result = mysqli_query($conn, $query) or die('Error querying database.');

echo json_encode($result);
mysqli_close($conn);

?>