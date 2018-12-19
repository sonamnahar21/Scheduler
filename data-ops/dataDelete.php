<?php
include_once('./connection.php');
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    //DELETE FROM `availability` WHERE 0
    echo $_POST["id"];
    $sql = "DELETE FROM availability WHERE id = '".$_POST["id"]."'";

    if ($conn->query($sql) === TRUE) {
        echo "Record Deleted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>