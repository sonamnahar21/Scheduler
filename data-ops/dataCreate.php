<?php
include_once('./connection.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $sql = "INSERT INTO availability (name,location,date,start_time, end_time,break_time,status,created) VALUES 
            ('".$_POST["name"]."',
            '".$_POST["location"]."','".$_POST["date"]."', 
            '".$_POST["starttime"]."' , '".$_POST["endtime"]."' ,
            '".$_POST["breaktime"]."','".$_POST["status"]."','".$_POST["created"]."')";
    
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>