<?php
include_once('../connection.php');
if(isset($_POST["id"]))
{
 $query = "DELETE FROM availability WHERE id = '".$_POST["id"]."'";
 if(mysqli_query($conn, $query))
 {
  echo 'Data Deleted';
 }
}
?>