<?php
include_once('./connection.php');
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    echo $_POST["id"];
    $sql = "UPDATE availability SET name = '".$_POST["name"]."',
            location = '".$_POST["location"]."', date= '".$_POST["date"]."',
            start_time = '".$_POST["starttime"]."',end_time = '".$_POST["endtime"]."',
            break_time = '".$_POST["breaktime"]."',status = '".$_POST["status"]."',
            is_approved_by_admin = 'Yes'
            WHERE id = '".$_POST["id"]."'";

    if ($conn->query($sql) === TRUE) {
        echo "Record Updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>