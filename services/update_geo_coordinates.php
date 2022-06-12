<?php
include("connection.php");
    $data=$_REQUEST['data'];
    $lat=$data['lat'];
    // echo $lat;
    // print_r($data);
    $lng=$data['lng'];
    $address=$data['address'];
    
$query = "UPDATE `example_addresses` SET `lat`='$lat',`long`='$lng' WHERE `Street_Address_of_Doctors_Business`='$address'";
// echo $query;
// exit();
$result = mysqli_query($conn, $query) or die('Error querying database.');

echo json_encode($result);
mysqli_close($conn);

?>