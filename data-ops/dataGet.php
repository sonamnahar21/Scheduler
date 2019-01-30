<?php
include_once('./connection.php');
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    $inputData =  $_GET["id"];   //to get data from ajax 
    $result_array = array();
    $sql = "SELECT * from availability where id =  '".$inputData."' ";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            array_push($result_array, $row);
        }
        echo json_encode($result_array);
    } else {
       echo "0 results";
    }
}
else if($_SERVER['REQUEST_METHOD'] == 'GETALL'){
    $result_array = array();
    $sql = "SELECT * from availability";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            array_push($result_array, $row);
        }
        echo json_encode($result_array);
    } else {
       echo "0 results";
    }
}
?>