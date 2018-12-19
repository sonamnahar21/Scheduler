<?php
include_once('../connection.php');

if(isset($_POST["id"]))
{
  $query = "UPDATE availability SET ".$_POST["column_name"]."='".$_POST["value"]."' WHERE id = '".$_POST["id"]."'";
    if(mysqli_query($conn, $query))
    {
    echo 'Data Updated';
    }
}
?>
